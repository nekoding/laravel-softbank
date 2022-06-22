<?php

namespace Nekoding\LaravelSoftbank\Traits\HttpClient;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

trait SoftbankHttpClient
{
    public $apiEndpoint = 'https://stbfep.sps-system.com/api/xmlapi.do';

    public function postData(string $xmlData, array $auth = []): Response
    {
        return Http::withBasicAuth(
            $auth['username'] ?? config('laravel-softbank.merchant_id') . config('laravel-softbank.service_id'), 
            $auth['password'] ?? config('laravel-softbank.hash_key'))
            ->withBody($xmlData, 'application/xml')
            ->post(config('laravel-softbank.api_endpoint') ?? $this->apiEndpoint);
    }

}