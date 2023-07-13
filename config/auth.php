<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Defaults
    |--------------------------------------------------------------------------
    |
    | This option controls the default authentication "guard" and password
    | reset options for your application. You may change these defaults
    | as required, but they're a perfect start for most applications.
    |
    */

    'defaults' => [
        // 'guard' => 'web',
        'guard' => 'ldap',
        'passwords' => 'users',
    ],

    /*
    |--------------------------------------------------------------------------
    | Authentication Guards
    |--------------------------------------------------------------------------
    |
    | Next, you may define every authentication guard for your application.
    | Of course, a great default configuration has been defined for you
    | here which uses session storage and the Eloquent user provider.
    |
    | All authentication drivers have a user provider. This defines how the
    | users are actually retrieved out of your database or other storage
    | mechanisms used by this application to persist your user's data.
    |
    | Supported: "session", "token"
    |
    */

    'guards' => [
        'ldap' => [
            'driver' => 'session',
            'provider' => 'ldap',
        ],
        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],

        'api' => [
            'driver' => 'token',
            'provider' => 'users',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | User Providers
    |--------------------------------------------------------------------------
    |
    | All authentication drivers have a user provider. This defines how the
    | users are actually retrieved out of your database or other storage
    | mechanisms used by this application to persist your user's data.
    |
    | If you have multiple user tables or models you may configure multiple
    | sources which represent each model / table. These sources may then
    | be assigned to any extra authentication guards you have defined.
    |
    | Supported: "database", "eloquent"
    |
    */

    'providers' => [
        'ldap' => [
            'driver' => 'ldap',
            'model' => App\Models\User::class,
            'rules' => [
                \Adldap\Laravel\Validation\Rules\DenyTrashed::class,
            ],
            'connection' => 'azure_ad',
        ],
        'users' => [
            'driver' => 'eloquent',
            'model' => App\User::class,
        ],

        'users' => [
            'driver' => 'database',
            'table' => 'users',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Resetting Passwords
    |--------------------------------------------------------------------------
    |
    | You may specify multiple password reset configurations if you have more
    | than one user table or model in the application and you want to have
    | separate password reset settings based on the specific user types.
    |
    | The expire time is the number of minutes that the reset token should be
    | considered valid. This security feature keeps tokens short-lived so
    | they have less time to be guessed. You may change this as needed.
    |
    */

    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => 'password_resets',
            'expire' => 60,
        ],
    ],

    'azure_ad' => [
        'auto_connect' => env('LDAP_AUTO_CONNECT', true),
        'connection' => Adldap\Connections\Ldap::class,
        'settings' => [
            'schema' => Adldap\Schemas\OpenLDAP::class,
            'account_prefix' => '',
            'account_suffix' => '@vuquanglinh2122001gmail.onmicrosoft.com',
            'hosts' => ['vuquanglinh2122001gmail.onmicrosoft.com'],
            'port' => 636,
            'timeout' => 5,
            'base_dn' => 'dc=vuquanglinh2122001gmail,dc=onmicrosoft,dc=com',
            'username' => '34f61fb9-2151-4dd9-87f4-b0506748cfbf',
            'password' => '43174425-5ac7-45f2-9ab2-219c02824b16',
            'follow_referrals' => false,
        ],
    ],    
];
