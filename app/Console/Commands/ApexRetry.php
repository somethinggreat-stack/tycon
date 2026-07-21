<?php

namespace App\Console\Commands;

use App\Models\Onboarding;
use App\Services\ApexService;
use Illuminate\Console\Command;

/**
 * Diagnose the APEX connection and re-push any onboarding that never synced.
 *
 * A failed push only ever left a reason in `apex_note`, which nothing displayed,
 * so a client could sit at "pending" indefinitely with no visible cause.
 *
 *   php artisan apex:status          → config + every unsynced client and its reason
 *   php artisan apex:status --retry  → also re-send each one to APEX
 */
class ApexRetry extends Command
{
    protected $signature = 'apex:status {--retry : Re-send every unsynced client to APEX}';

    protected $description = 'Show why onboarding submissions failed to reach APEX, and optionally re-push them';

    public function handle(): int
    {
        $this->line('');
        $this->info('APEX configuration');

        $url     = (string) config('tycoon.apex.url');
        $key     = (string) config('tycoon.apex.key');
        $enabled = (bool) config('tycoon.apex.enabled');

        // never print the key itself
        $this->line('  APEX_ENABLED : '.($enabled ? 'true' : 'FALSE  <-- pushes are skipped entirely'));
        $this->line('  APEX_API_URL : '.($url !== '' ? $url : 'MISSING'));
        $this->line('  APEX_API_KEY : '.($key !== '' ? 'set ('.strlen($key).' chars, ends '.substr($key, -4).')' : 'MISSING'));
        $this->line('  service ready: '.(ApexService::enabled() ? 'yes' : 'NO — nothing will be sent'));

        $configCached = file_exists($this->laravel->getCachedConfigPath());
        $this->line('  config cached: '.($configCached
            ? 'yes  <-- .env edits do NOT apply until `php artisan config:clear`'
            : 'no (reading .env directly)'));

        $ca = storage_path('cacert.pem');
        $this->line('  CA bundle    : '.(is_file($ca) ? 'present' : 'absent (using system CA store)'));

        $pending = Onboarding::where('apex_synced', false)->orderBy('id')->get();
        $synced  = Onboarding::where('apex_synced', true)->count();

        $this->line('');
        $this->info('Onboarding submissions');
        $this->line('  synced : '.$synced);
        $this->line('  pending: '.$pending->count());

        if ($pending->isEmpty()) {
            $this->line('');
            $this->info('Nothing pending — every client reached APEX.');
            return self::SUCCESS;
        }

        $this->line('');
        $this->table(
            ['ID', 'Client', 'Submitted', 'Recorded reason'],
            $pending->map(fn (Onboarding $c) => [
                $c->id,
                $c->fullName(),
                optional($c->created_at)->format('M j, g:ia'),
                $c->apex_note ?: '(no reason recorded)',
            ])->all()
        );

        if (! $this->option('retry')) {
            $this->line('');
            $this->comment('Run with --retry to re-send these to APEX.');
            return self::SUCCESS;
        }

        if (! ApexService::enabled()) {
            $this->line('');
            $this->error('Cannot retry: the APEX service is not configured (see above). Fix that first.');
            return self::FAILURE;
        }

        $this->line('');
        $this->info('Re-sending '.$pending->count().' client(s)…');

        $okCount = 0;
        foreach ($pending as $client) {
            $result = ApexService::sendOnboarding($client);
            $client->update([
                'apex_synced' => $result['synced'],
                'apex_note'   => $result['note'],
            ]);

            if ($result['synced']) {
                $okCount++;
                $this->line('  <fg=green>OK</>   #'.$client->id.' '.$client->fullName().' — '.$result['note']);
            } else {
                $this->line('  <fg=red>FAIL</> #'.$client->id.' '.$client->fullName().' — '.$result['note']);
            }
        }

        $this->line('');
        $failed = $pending->count() - $okCount;
        $this->info($okCount.' synced, '.$failed.' still failing.');

        return $failed === 0 ? self::SUCCESS : self::FAILURE;
    }
}
