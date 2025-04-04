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
                "'nonce-{{ csp_nonce() }}'", // Permitir scripts con nonce
                'http://ajax.googleapis.com', // jQuery
                'https://code.jquery.com', // jQuery
                'https://cdn.datatables.net', // DataTables
                'https://cdnjs.cloudflare.com', // jszip, pdfmake, Chart.js
                'https://buttons.github.io', // GitHub buttons
                'https://cdn.jsdelivr.net', // Popper.js
                'https://maxcdn.bootstrapcdn.com', // Bootstrap
                'https://cdn.jsdelivr.net/npm/chart.js',
                'https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js', // DataTables             
            ],
            'style-src' => [
                'self',
                'unsafe-inline', // Solo si es necesario para estilos en línea
                'https://fonts.googleapis.com', // Google Fonts
                'https://cdn.datatables.net', // DataTables CSS
                'https://unpkg.com', // Swiper u otras bibliotecas
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

    'report_only_policy' => Spatie\Csp\Policies\Basic::class,

    'report_uri' => env('CSP_REPORT_URI', ''),

    'enabled' => env('CSP_ENABLED', true),

    'nonce_generator' => Spatie\Csp\Nonce\RandomString::class,

    'nonce_enabled' => env('CSP_NONCE_ENABLED', true),
];
