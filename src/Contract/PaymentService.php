<?php

namespace Nekoding\LaravelSoftbank\Contract;

use Nekoding\LaravelSoftbank\Contract\Payload;
use Nekoding\LaravelSoftbank\PaymentMethod\SoftbankResponse;
use Nekoding\LaravelSoftbank\Traits\HttpClient\SoftbankHttpClient;
use Nekoding\LaravelSoftbank\Traits\Payload\PayloadSerializer;

abstract class PaymentService
{

    use PayloadSerializer;
    use SoftbankHttpClient;
    
    /**
     * createRequest
     *
     * @param   \Nekoding\LaravelSoftbank\Contract\Payload $payload
     * @param  string $requestId
     * @return Response
     */
    public function createRequest(Payload $payload, string $requestId): Response
    {
        $body = $this->generatePayload($payload, $requestId);

        $response = $this->postData($body, ['username' => $payload->getAuthUsername(), 'password' => $payload->getAuthPassword()]);

        /**
         * @var \Nekoding\LaravelSoftbank\PaymentMethod\SoftbankResponse
         */
        $result = $this->deserializeData($response->body(), SoftbankResponse::class);

        return $result;
    }

    /**
     * createTransaction
     *
     * @param  \Nekoding\LaravelSoftbank\Contract\Payload $payload
     * @return Response
     */
    public abstract function createTransaction(Payload $payload): Response;

    
    /**
     * confirmTransaction
     *
     * @param  \Nekoding\LaravelSoftbank\Contract\Payload $payload
     * @return Response
     */
    public abstract function confirmTransaction(Payload $payload): Response;

        
    /**
     * marksTransactionSales
     *
     * @param  \Nekoding\LaravelSoftbank\Contract\Payload $payload
     * @return Response
     */
    public abstract function marksTransactionSales(Payload $payload): Response;
    
    /**
     * refundTransaction
     *
     * @param  \Nekoding\LaravelSoftbank\Contract\Payload $payload
     * @return Response
     */
    public abstract function refundTransaction(Payload $payload): Response;
}
