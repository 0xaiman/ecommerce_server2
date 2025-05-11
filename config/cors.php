<?php

return [

    'paths' => ['api/*', 'sanctum/csrf-cookie'], // Include sanctum if used

    'allowed_methods' => ['*'],

    'allowed_origins' => [env('FRONTEND_URL')], // Fallback default

    'allowed_origins_patterns' => [],

    'allowed_headers' => ['*'],

    'exposed_headers' => [],

    'max_age' => 0,

    'supports_credentials' => true, // Important: must be true if using withCredentials
];
