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
        'client_id' => '198196355213-ec51ca8cg0bobap92gaic7es2e0qtocp.apps.googleusercontent.com',
        'client_secret' => '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',
        'redirect' => 'https://binarymetrix-dev.com/glow/auth-google-callback',
    ],
  'facebook' => [
        'client_id' => '1081124712610957',
        'client_secret' => '29076c7a9bc45c98996f1e8ae8d77cf4',
        'redirect' => 'https://binarymetrix-dev.com/glow/auth-facebook-callback',
    ],
    'instagram' => [  
        'client_id' => env('INSTAGRAM_CLIENT_ID'),  
        'client_secret' => env('INSTAGRAM_CLIENT_SECRET'),  
        'redirect' => env('INSTAGRAM_REDIRECT_URI'),  
    ],
    // "apple" => [
    //     "client_id" => "<your_client_id>",
    //     "client_secret" => "<your_client_secret>",
    // ],
];