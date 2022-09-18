<?php

// config for IsaEken/Envman
return [
    'enabled' => env('ENVMAN_ENABLED', true),

    'cache' => env('APP_ENV', 'production') === 'production',

    'features' => [
        // custom configs for domains
        'domains' => true,
    ],

    'database' => [
        'connection', env('DB_CONNECTION'),
    ],
];
