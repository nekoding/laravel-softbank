<?php

namespace Nekoding\LaravelSoftbank\PaymentMethod\CreditCard;

use Nekoding\LaravelSoftbank\Contract\Payload;
use Nekoding\LaravelSoftbank\Contract\PaymentMethod\CreditCard;
use Nekoding\LaravelSoftbank\Contract\Response;
use Nekoding\LaravelSoftbank\PaymentMethod\SoftbankResponse;
use Nekoding\LaravelSoftbank\Traits\HttpClient\SoftbankHttpClient;
use Nekoding\LaravelSoftbank\Traits\Payload\CanChangeRequestId;
use Nekoding\LaravelSoftbank\Traits\Payload\PayloadSerializer;

class CreditCardPayment implements CreditCard
{

    use PayloadSerializer;
    use SoftbankHttpClient;
    use CanChangeRequestId;

    protected $paymentRequestId         = 'ST01-00101-101';
    protected $confirmationRequestId    = 'ST02-00101-101';
    protected $salesRequestId           = 'ST02-00201-101';
    protected $refundRequestId          = 'ST02-00303-101';
    protected $partialRefundRequestId   = 'ST02-00307-101';
    protected $recreditRequestId        = '';
    protected $continuePaymentRequestId = '';
    protected $continueCancelRequestId  = '';
    protected $continueCancelNoticeId   = '';
    
    protected $saveCardInfoRequestId    = '';
    protected $updateCardInfoRequestId  = '';
    protected $deleteCardInfoRequestId  = '';
    protected $getCardInfoRequestId     = '';

    public function createTransaction(Payload $payload): Response
    {
        $body = $this->generatePayload($payload, $this->requestId ?? $this->paymentRequestId);

        $response = $this->postData($body, ['username' => $payload->getAuthUsername(), 'password' => $payload->getAuthPassword()]);

        /**
         * @var \Nekoding\LaravelSoftbank\PaymentMethod\SoftbankResponse
         */
        $result = $this->deserializeData($response->body(), SoftbankResponse::class);

        return $result;
    }

    public function confirmTransaction(Payload $payload): Response
    {

        $body = $this->generatePayload($payload, $this->requestId ?? $this->confirmationRequestId);

        $response = $this->postData($body, ['username' => $payload->getAuthUsername(), 'password' => $payload->getAuthPassword()]);

        /**
         * @var \Nekoding\LaravelSoftbank\PaymentMethod\SoftbankResponse
         */
        $result = $this->deserializeData($response->body(), SoftbankResponse::class);

        return $result;
    }

    public function marksTransactionSales(Payload $payload): Response
    {
        $body = $this->generatePayload($payload, $this->requestId ?? $this->salesRequestId);

        $response = $this->postData($body, ['username' => $payload->getAuthUsername(), 'password' => $payload->getAuthPassword()]);

        /**
         * @var \Nekoding\LaravelSoftbank\PaymentMethod\SoftbankResponse
         */
        $result = $this->deserializeData($response->body(), SoftbankResponse::class);

        return $result;
    }

    public function refundTransaction(Payload $payload): Response
    {
        $body = $this->generatePayload($payload, $this->requestId ?? $this->refundRequestId);

        $response = $this->postData($body, ['username' => $payload->getAuthUsername(), 'password' => $payload->getAuthPassword()]);

        /**
         * @var \Nekoding\LaravelSoftbank\PaymentMethod\SoftbankResponse
         */
        $result = $this->deserializeData($response->body(), SoftbankResponse::class);

        return $result;
    }

    public function partialRefundTransaction(Payload $payload): Response
    {
        $body = $this->generatePayload($payload, $this->requestId ?? $this->partialRefundRequestId);

        $response = $this->postData($body, ['username' => $payload->getAuthUsername(), 'password' => $payload->getAuthPassword()]);

        /**
         * @var \Nekoding\LaravelSoftbank\PaymentMethod\SoftbankResponse
         */
        $result = $this->deserializeData($response->body(), SoftbankResponse::class);

        return $result;
    }
}