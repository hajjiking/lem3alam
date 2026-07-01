<?php

return [
    'paths' => ['api/*', 'sanctum/csrf-cookie', 'docs*'],
    'allowed_methods' => ['*'],
    'allowed_origins' => array_values(
        array_filter(
            array_map(
                static fn ($v) => trim((string) $v),
                explode(',', (string) env('CORS_ALLOWED_ORIGINS', '*'))
            ),
            static fn ($v) => $v !== ''
        )
    ),
    'allowed_origins_patterns' => [
        '#^https?://localhost(:\d+)?$#',
        '#^https?://127\.0\.0\.1(:\d+)?$#',
        '#^https?://(www\.)?lem3alam\.cu\.ma(:\d+)?$#',
        '#^https?://([a-z0-9-]+\.)?googiehost\.com(:\d+)?$#',
    ],
    'allowed_headers' => ['*'],
    'exposed_headers' => [],
    'max_age' => 3600,
    'supports_credentials' => false,
];
