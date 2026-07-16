<?php

namespace App\Services;

use App\Models\Onboarding;
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
 * Gated behind APEX_ENABLED — a safe no-op when disabled.
 */
class ApexService
{
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

        // Text fields — 1:1 with the funnel data (empties dropped)
        $fields = array_filter([
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

        $disk = Storage::disk('local');
        $http = Http::timeout(30)->withHeaders([
            'X-Intake-Key' => config('tycoon.apex.key'),
            'Accept'       => 'application/json',
        ]);

        // Verify TLS against a bundled CA cert (sensitive data — never skip verification)
        $ca = storage_path('cacert.pem');
        if (is_file($ca)) {
            $http = $http->withOptions(['verify' => $ca]);
        }

        // Attach files → makes the request multipart/form-data
        $files = [
            'drivers_license'  => $c->dl_path,
            'proof_of_address' => $c->proof_address_path,
            'ssn_card'         => $c->ssn_card_path,
        ];
        foreach ($files as $field => $path) {
            if ($path && $disk->exists($path)) {
                $http = $http->attach($field, $disk->get($path), basename($path));
            }
        }

        try {
            $res = $http->post(rtrim(config('tycoon.apex.url'), '/'), $fields);
            $status = $res->status();

            if ($status === 201 || $res->successful()) {
                return ['synced' => true, 'note' => 'apex: synced #'.$res->json('id'), 'status' => $status, 'errors' => []];
            }

            if ($status === 401) {
                Log::warning('APEX intake 401 — invalid/missing key');
                return ['synced' => false, 'note' => 'apex: 401 invalid key', 'status' => 401, 'errors' => []];
            }

            if ($status === 422) {
                $errors = $res->json('errors', []);
                Log::warning('APEX intake 422 — validation failed', ['errors' => $errors]);
                return ['synced' => false, 'note' => 'apex: 422 — '.implode('; ', array_keys($errors)), 'status' => 422, 'errors' => $errors];
            }

            Log::warning('APEX intake failed', ['status' => $status, 'body' => $res->body()]);
            return ['synced' => false, 'note' => 'apex: failed '.$status, 'status' => $status, 'errors' => []];
        } catch (\Throwable $e) {
            Log::error('APEX intake error', ['error' => $e->getMessage()]);
            return ['synced' => false, 'note' => 'apex: error — '.$e->getMessage(), 'status' => null, 'errors' => []];
        }
    }
}
