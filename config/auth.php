<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Defaults
    |--------------------------------------------------------------------------
    |
    | الحارس (guard) الافتراضي الذي سيُستخدم للمصادقة.
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
    | كل نوع مستخدم نعمل له guard خاص.
    | نستخدم driver = sanctum لكل المستخدمين الذين يسجلون دخول عبر API.
    |
    */

    'guards' => [
        // الحارس الافتراضي للموقع
        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],

        // الحارس العام للمستخدمين (الإداريين)
        'api' => [
            'driver' => 'sanctum',
            'provider' => 'users',
        ],

        // حارس المعلمين
        'teacher' => [
            'driver' => 'sanctum',
            'provider' => 'teachers',
        ],

        // حارس الطلاب
        'student' => [
            'driver' => 'sanctum',
            'provider' => 'students',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | User Providers
    |--------------------------------------------------------------------------
    |
    | هنا نُعرف من أين يأتي كل نوع مستخدم (من أي جدول/موديل).
    |
    */

    'providers' => [
        'user' => [
            'driver' => 'eloquent',
            'model' => App\Models\User::class,
        ],

        'teachers' => [
            'driver' => 'eloquent',
            'model' => App\Models\Teacher::class,
        ],

        'students' => [
            'driver' => 'eloquent',
            'model' => App\Models\Student::class,
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
