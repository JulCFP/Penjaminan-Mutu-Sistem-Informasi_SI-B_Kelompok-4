<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Defaults
    |--------------------------------------------------------------------------
    |
    | Default guard tetap 'web' (untuk Admin/User biasa).
    |
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
    | Di sini kita tentukan siapa saja yang bisa login.
    | 1. web      -> Untuk ADMIN (Model: User)
    | 2. penjual  -> Untuk PENJUAL (Model: Penjual)
    | 3. konsumen -> Untuk KONSUMEN (Model: Konsumen)
    |
    */

    'guards' => [
        // Guard untuk ADMIN (Tabel Users)
        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],

        // Guard untuk PENJUAL
        'penjual' => [
            'driver' => 'session',
            'provider' => 'penjuals', // Perhatikan 's' (plural)
        ],

        // Guard untuk KONSUMEN
        'konsumen' => [
            'driver' => 'session',
            'provider' => 'konsumens', // Perhatikan 's' (plural)
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | User Providers
    |--------------------------------------------------------------------------
    |
    | Menghubungkan Guard dengan Model Database.
    |
    */

    'providers' => [
        // Provider ADMIN
        'users' => [
            'driver' => 'eloquent',
            'model' => App\Models\User::class,
        ],

        // Provider PENJUAL
        'penjuals' => [
            'driver' => 'eloquent',
            'model' => App\Models\Penjual::class,
        ],

        // Provider KONSUMEN
        'konsumens' => [
            'driver' => 'eloquent',
            'model' => App\Models\Konsumen::class,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Resetting Passwords
    |--------------------------------------------------------------------------
    |
    | Konfigurasi tabel token untuk fitur Lupa Password.
    |
    */

    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => 'password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ],

        'penjuals' => [
            'provider' => 'penjuals',
            'table' => 'password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ],

        'konsumens' => [
            'provider' => 'konsumens',
            'table' => 'password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Password Confirmation Timeout
    |--------------------------------------------------------------------------
    */

    'password_timeout' => 10800,

];