<?php

return [

    /*
    |--------------------------------------------------------------------------
    | CCAvenue configuration file
    |--------------------------------------------------------------------------
    |   gateway = CCAvenue
    |   view    = File
     */

    'gateway' => 'CCAvenue', // Making this option for implementing multiple gateways in future

    'testMode' => false, // True for Testing the Gateway [For production false]

    'ccavenue' => [ // CCAvenue Parameters
        'merchantId' => env('CCAVENUE_MERCHANT_ID', '172808'),
        'accessCode' => env('CCAVENUE_ACCESS_CODE', 'AVRA77FD36AT61ARTA'),
        'workingKey' => env('CCAVENUE_WORKING_KEY', '3D168E728ED6B65F6AB548F89124B299'),

        // Should be route address for url() function
        'redirectUrl' => env('CCAVENUE_REDIRECT_URL', 'payments/response'),
        'cancelUrl' => env('CCAVENUE_CANCEL_URL', 'payments/response'),

        'currency' => env('CCAVENUE_CURRENCY', 'INR'),
        'language' => env('CCAVENUE_LANGUAGE', 'EN'),
    ],

    // Add your response link here. In Laravel 5.* you may use the api middleware instead of this.
    'remove_csrf_check' => [
        'payments/response',
    ],

];
