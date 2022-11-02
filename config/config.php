<?php

/*
 * You can place your custom package configuration in here.
 */
return [
    'merchant_id'       => env('SOFTBANK_MERCHANT_ID'),
    'service_id'        => env('SOFTBANK_SERVICE_ID'),
    'hash_key'          => env('SOFTBANK_HASH_KEY'),
    'api_endpoint'      => env('SOFTBANK_API_ENDPOINT', "https://stbfep.sps-system.com/api/xmlapi.do"),
    'token_endpoint'    => env('SOFTBANK_TOKEN_ENDPOINT', "https://stbtoken.sps-system.com/sbpstoken/com_sbps_system_token.js")
];