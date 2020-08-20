<?php

return [

'multilingual' => [
        'enabled' => true,
        'default' => 'es',
        'locales' => [
            'en',
            'es',
        ],
    ],
'user' => [
    'add_default_role_on_register' => true,
    'default_role'                 => 'user',
    'admin_permission'             => 'browse_admin',
    'namespace'                    => App\User::class,
    'redirect'                     => '/admin'
],

'controllers' => [
    'namespace' => 'TCG\\Voyager\\Http\\Controllers',
],
];
