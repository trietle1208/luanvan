<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'google' => [
        'client_id' => '317626595481-lor2vj49u7m3apsqf2r30263dk5q0j4e.apps.googleusercontent.com',
        'client_secret' => '75O_fRpfUzqHS9oSPHb5F1UQ',
        'redirect' => 'https://thegioilinhkien.com/tai-khoan/google/callback',
    ],

    'facebook' => [
        'client_id' => '252014176936275',
        'client_secret' => 'ca4c5dd99aef9ffc2a3c43c27fb38802',
        'redirect' => 'https://thegioilinhkien.com/tai-khoan/facebook/callback',
    ]
];
