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
