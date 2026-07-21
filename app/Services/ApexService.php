<?php

namespace App\Services;

use App\Models\Onboarding;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

/**
 * Forwards completed onboarding submissions to the APEX Growth intake API
 * so the client appears in Apex's "New Clients".
 *
 * Contract:
 *   POST {APEX_API_URL}  (multipart/form-data)
 *   Header: X-Intake-Key: {APEX_API_KEY}
 *   201 {ok:true,id:n} · 401 invalid key · 422 {ok:false,errors:{...}}
 *
 * Transport fallbacks: some hosts run a WAF that rejects ANY multipart upload
 * before the application runs (HTTP 406), which silently kills every submission
 * carrying documents. If multipart is blocked we retry the same payload as
 * base64 inside a plain JSON body, and finally against APEX's non-/api alias
 * endpoint (for rules scoped to /api/*). APEX accepts all three.
 *
 * Gated behind APEX_ENABLED — a safe no-op when disabled.
 */
class ApexService
{
    /** Documents APEX expects, mapped to the local column holding the stored path. */
    private const DOCUMENTS = [
        'drivers_license'  => 'dl_path',
        'proof_of_address' => 'proof_address_path',
        'ssn_card'         => 'ssn_card_path',
    ];

    public static function enabled(): bool
    {
        return (bool) config('tycoon.apex.enabled')
            && ! empty(config('tycoon.apex.url'))
            && ! empty(config('tycoon.apex.key'));
    }

    /**
     * Push an onboarding client to APEX.
     * Returns ['synced'=>bool, 'note'=>string, 'status'=>int|null, 'errors'=>array].
     * Never throws.
     */
    public static function sendOnboarding(Onboarding $c): array
    {
        if (! self::enabled()) {
            return ['synced' => false, 'note' => 'apex: disabled', 'status' => null, 'errors' => []];
        }

        $fields = self::buildFields($c);
        $docs   = self::readDocuments($c);
        $url    = rtrim(config('tycoon.apex.url'), '/');

        // 1) multipart — the documented contract, unchanged.
        [$res, $err] = self::attempt('multipart', $url, $fields, $docs);
        if ($err === null && ! self::isBlocked($res)) {
            return self::interpret($res, 'multipart');
        }

        if (self::isBlocked($res)) {
            // 2) same endpoint, documents as base64 in JSON. A multipart WAF rule
            //    cannot match this, because there is no multipart body at all.
            Log::warning('APEX intake: multipart blocked (406) — retrying as base64 JSON', ['url' => $url]);
            [$res2, $err2] = self::attempt('json', $url, $fields, $docs);
            if ($err2 === null && ! self::isBlocked($res2)) {
                return self::interpret($res2, 'base64 JSON');
            }

            // 3) APEX's alias endpoint off the /api prefix, for rules scoped to /api/*.
            $alt = self::fallbackUrl($url);
            if ($alt !== null && $alt !== $url) {
                Log::warning('APEX intake: retrying on the non-/api endpoint', ['url' => $alt]);
                [$res3, $err3] = self::attempt('json', $alt, $fields, $docs);
                if ($err3 === null && ! self::isBlocked($res3)) {
                    return self::interpret($res3, 'base64 JSON @ alias');
                }
                $res = $res3 ?? $res2 ?? $res;
                $err = $err3 ?? $err2 ?? $err;
            } else {
                $res = $res2 ?? $res;
                $err = $err2 ?? $err;
            }
        }

        if ($err !== null) {
            return ['synced' => false, 'note' => 'apex: error — '.$err, 'status' => null, 'errors' => []];
        }

        return self::interpret($res, 'all transports blocked');
    }

    /* ------------------------------------------------------------------ */

    /** Text fields — 1:1 with the funnel data (empties dropped). */
    private static function buildFields(Onboarding $c): array
    {
        return array_filter([
            'first_name'                        => $c->first_name,
            'middle_name'                       => $c->middle_name,
            'last_name'                         => $c->last_name,
            'suffix'                            => $c->suffix,
            'email'                             => $c->email,
            'ssn'                               => $c->ssn ? preg_replace('/\D/', '', $c->ssn) : null,
            'date_of_birth'                     => optional($c->dob)->format('Y-m-d'),
            'current_address'                   => $c->street,
            'address_line2'                     => $c->apt,
            'city'                              => $c->city,
            'state'                             => $c->state,
            'zipcode'                           => $c->zip,
            'phone'                             => $c->phone,
            'credit_monitoring_name'            => $c->cm_provider,
            'credit_monitoring_username'        => $c->cm_email,
            'credit_monitoring_password'        => $c->cm_password,
            'credit_monitoring_security_answer' => $c->cm_security_answer,
        ], fn ($v) => $v !== null && $v !== '');
    }

    /** Read the stored documents once, so every transport reuses the same bytes. */
    private static function readDocuments(Onboarding $c): array
    {
        $disk = Storage::disk('local');
        $out  = [];

        foreach (self::DOCUMENTS as $field => $column) {
            $path = $c->{$column};
            if ($path && $disk->exists($path)) {
                $out[$field] = ['contents' => $disk->get($path), 'name' => basename($path)];
            }
        }

        return $out;
    }

    /** Shared client: key header, permissive Accept, plain UA, pinned TLS. */
    private static function client()
    {
        $http = Http::timeout(30)->withHeaders([
            'X-Intake-Key' => config('tycoon.apex.key'),
            // "*/*" rather than "application/json": a strict Accept can fail content
            // negotiation on the far end, and only once the key is valid. "*/*" cannot.
            'Accept'       => '*/*',
            // default Guzzle UA is a common WAF trigger; identify ourselves plainly
            'User-Agent'   => 'TycoonDuro-Intake/1.0 (+https://tycoonduro.com)',
        ]);

        // Verify TLS against a bundled CA cert (sensitive data — never skip verification)
        $ca = storage_path('cacert.pem');
        if (is_file($ca)) {
            $http = $http->withOptions(['verify' => $ca]);
        }

        return $http;
    }

    /**
     * Perform one attempt. Returns [Response|null, errorMessage|null] — never throws.
     */
    private static function attempt(string $transport, string $url, array $fields, array $docs): array
    {
        try {
            $http = self::client();

            if ($transport === 'multipart') {
                foreach ($docs as $field => $doc) {
                    $http = $http->attach($field, $doc['contents'], $doc['name']);
                }

                return [$http->post($url, $fields), null];
            }

            // JSON: documents inline as base64, matching APEX's <field>_base64 contract.
            $payload = $fields;
            foreach ($docs as $field => $doc) {
                $payload[$field . '_base64']   = base64_encode($doc['contents']);
                $payload[$field . '_filename'] = $doc['name'];
            }

            return [$http->asJson()->post($url, $payload), null];
        } catch (\Throwable $e) {
            Log::error('APEX intake error', ['transport' => $transport, 'url' => $url, 'error' => $e->getMessage()]);

            return [null, $e->getMessage()];
        }
    }

    /** 406 = the request never reached the application (WAF/proxy rejection). */
    private static function isBlocked(?Response $res): bool
    {
        return $res !== null && $res->status() === 406;
    }

    /** APEX exposes the same endpoint off /api for WAFs scoped to /api/*. */
    private static function fallbackUrl(string $url): ?string
    {
        $configured = config('tycoon.apex.url_fallback');
        if (! empty($configured)) {
            return rtrim($configured, '/');
        }

        if (str_contains($url, '/api/intake')) {
            return str_replace('/api/intake', '/partner-intake', $url);
        }

        return null;
    }

    /** Map a response onto the caller's result shape. */
    private static function interpret(?Response $res, string $via): array
    {
        if ($res === null) {
            return ['synced' => false, 'note' => 'apex: no response', 'status' => null, 'errors' => []];
        }

        $status = $res->status();

        if ($status === 201 || $res->successful()) {
            return [
                'synced' => true,
                'note'   => 'apex: synced #'.$res->json('id').' ('.$via.')',
                'status' => $status,
                'errors' => [],
            ];
        }

        if ($status === 401) {
            Log::warning('APEX intake 401 — invalid/missing key');
            return ['synced' => false, 'note' => 'apex: 401 invalid key', 'status' => 401, 'errors' => []];
        }

        if ($status === 406) {
            // Every transport was rejected before reaching APEX — a WAF on the
            // receiving host, not something either application can fix.
            Log::error('APEX intake 406 — every transport rejected by the receiving host', ['body' => $res->body()]);
            return [
                'synced' => false,
                'note'   => 'apex: 406 — blocked before reaching APEX on multipart, base64 JSON and the alias endpoint. The receiving host is rejecting the request (ModSecurity/Imunify360); ask them for the triggered rule ID.',
                'status' => 406,
                'errors' => [],
            ];
        }

        if ($status === 422) {
            $errors = $res->json('errors', []);
            Log::warning('APEX intake 422 — validation failed', ['errors' => $errors]);
            return ['synced' => false, 'note' => 'apex: 422 — '.implode('; ', array_keys($errors)), 'status' => 422, 'errors' => $errors];
        }

        Log::error('APEX intake failed', ['status' => $status, 'via' => $via, 'body' => $res->body()]);
        // keep a snippet of the body — "failed 500" alone gives nothing to act on
        $snippet = trim(preg_replace('/\s+/', ' ', strip_tags((string) $res->body())));

        return [
            'synced' => false,
            'note'   => 'apex: failed '.$status.($snippet !== '' ? ' — '.mb_substr($snippet, 0, 180) : ''),
            'status' => $status,
            'errors' => [],
        ];
    }
}
