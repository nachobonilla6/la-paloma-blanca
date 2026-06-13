<?php

return [
    'panels' => [
        'admin' => [
            'id' => 'admin',
            'path' => 'admin',
            'home_url' => '/admin',
            'login' => [
                'route' => 'filament.admin.auth.login',
            ],
            'auth' => [
                'guard' => 'web',
                'pages' => [
                    'login' => \Filament\Pages\Auth\Login::class,
                ],
            ],
            'middleware' => ['web', 'auth'],
            'pages' => [
                \Filament\Pages\Dashboard::class,
            ],
            'resources' => [
                // Resources go here
            ],
        ],
    ],
];
