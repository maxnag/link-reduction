<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Laravel CORS
    |--------------------------------------------------------------------------
    |
    | allowedOrigins, allowedHeaders and allowedMethods can be set to array('*')
    | to accept any value.
    |
    */
   
    'supportsCredentials' => false,
    'allowedOrigins' => ['*'],
    'allowedHeaders' => ['Accept', 'Content-Type'],
    'allowedMethods' => ['GET', 'POST', 'OPTIONS'],
    'exposedHeaders' => [],
    'maxAge' => 0,

];
