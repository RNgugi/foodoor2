<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],

    'fcm' => [
        'key' => 'AAAAvQZ2LHQ:APA91bEVaeKSuAGueZxGDTRpHvwQGrxcOEYfBr1MxmWC01lr7Pei3SiOhvtqcAa2xCJhbkmsPi_SCdWUebXA0dPJwS7zDMsVXeUCbJ6Jx7HkozJGpO3M0npteheCwi9XjZegE_FW77J18-85XKD6EZsCCNUeOlV7iA'
     ]

];
