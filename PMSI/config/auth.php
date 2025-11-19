<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Defaults
    |--------------------------------------------------------------------------
    */
    'defaults' => [
        'guard' => env('AUTH_GUARD', 'web'),
        'passwords' => env('AUTH_PASSWORD_BROKER', 'users'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Authentication Guards
    |--------------------------------------------------------------------------
    |
    | Di sini kita menambahkan dua guard baru:
    | - penjual
    | - konsumen
    |
    | Keduanya memakai driver "session" sama seperti web.
    |
    */

    'guards' => [
        // Default Laravel
        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],

   	'admin' => [
            'driver' => 'session',
            'provider' => 'admins',
	],

        // Guard khusus PENJUAL
        'penjual' => [
            'driver' => 'session',
            'provider' => 'penjual',
        ],

        // Guard khusus KONSUMEN
        'konsumen' => [
            'driver' => 'session',
            'provider' => 'konsumen',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | User Providers
    |--------------------------------------------------------------------------
    |
    | Kita menambahkan provider untuk model Penjual dan Konsumen.
    |
    */

    'providers' => [
        // Default Laravel
        'users' => [
            'driver' => 'eloquent',
            'model' => App\Models\User::class,
        ],

        // Provider PENJUAL
        'penjual' => [
            'driver' => 'eloquent',
            'model' => App\Models\Penjual::class,
        ],

        // Provider KONSUMEN
        'konsumen' => [
            'driver' => 'eloquent',
            'model' => App\Models\Konsumen::class,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Resetting Passwords
    |--------------------------------------------------------------------------
    */

    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => env('AUTH_PASSWORD_RESET_TOKEN_TABLE', 'password_reset_tokens'),
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Password Confirmation Timeout
    |--------------------------------------------------------------------------
    */
    'password_timeout' => env('AUTH_PASSWORD_TIMEOUT', 10800),

];
