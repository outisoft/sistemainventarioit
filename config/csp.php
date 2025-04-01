<?php

return [
    
    'default' => 'app-csp',

    'profiles' => [
        'app-csp' => [
            'default-src' => [
                'self',
            ],
            'script-src' => [
                'self',
                'wasm-unsafe-eval',
                'unsafe-eval', // Solo si necesitas eval()
                env('APP_ENV') === 'local' ? 'unsafe-inline' : null, // Solo en desarrollo
            ],
            'style-src' => [
                'self',
                'unsafe-inline', // Laravel Livewire/Mix necesitan esto
            ],
            'img-src' => [
                'self',
                'data:',
                'blob:',
            ],
            'connect-src' => [
                'self',
                env('APP_ENV') === 'local' ? 'ws://localhost:8080' : null, // Para Vite
            ],
        ],
    ],

    'policy' => Spatie\Csp\Policies\Basic::class,

    'report_only_policy' => '',

    'report_uri' => env('CSP_REPORT_URI', ''),

    'enabled' => env('CSP_ENABLED', true),

    'nonce_generator' => Spatie\Csp\Nonce\RandomString::class,

    'nonce_enabled' => env('CSP_NONCE_ENABLED', true),
];
