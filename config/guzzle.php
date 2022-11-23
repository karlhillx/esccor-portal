<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Guzzle configuration
    |--------------------------------------------------------------------------
    |
    | Configure the request options for Guzzle.
    |
    */

    'default' => [
        'base_uri' => env('API_BASE_URI', 'http://mondeca-webapp-dev.nasawestprime.com'),
        'headers' => ['Accept' => 'application/json'],
    ],
];
