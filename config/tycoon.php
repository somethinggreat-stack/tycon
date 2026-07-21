<?php

/*
|--------------------------------------------------------------------------
| Tycoon Duro app settings
|--------------------------------------------------------------------------
| Reading env() through config keeps values available after
| `php artisan config:cache` (env() returns null once config is cached).
*/

return [
    'admin' => [
        'email'    => env('ADMIN_EMAIL', 'admin@tycoonduro.com'),
        'password' => env('ADMIN_PASSWORD', ''),

        // Sign the admin out after this much inactivity. Enforced server-side in
        // AdminAuth, so it holds regardless of SESSION_LIFETIME or a closed tab.
        'idle_minutes' => (int) env('ADMIN_IDLE_MINUTES', 10),
        // How long the "you're about to be signed out" warning counts down for.
        'warn_seconds' => (int) env('ADMIN_IDLE_WARN_SECONDS', 60),
    ],

    'apex' => [
        'enabled' => filter_var(env('APEX_ENABLED', false), FILTER_VALIDATE_BOOLEAN),
        'url'     => env('APEX_API_URL'),
        'key'     => env('APEX_API_KEY'),
        // Optional. Only used if the main URL is blocked by a WAF (HTTP 406).
        // Left blank it is derived from the main URL (/api/intake -> /partner-intake).
        'url_fallback' => env('APEX_API_URL_FALLBACK'),
    ],
];
