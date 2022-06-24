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
    
    protected $saveCardInfoRequestId    = 'MG02-00101-101';
    protected $updateCardInfoRequestId  = '';
    protected $deleteCardInfoRequestId  = '';
    protected $getCardInfoRequestId     = '';


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

    public function createTransaction(Payload $payload): Response
    {
        return $this->createRequest($payload, $this->paymentRequestId);
    }

    public function confirmTransaction(Payload $payload): Response
    {
        return $this->createRequest($payload, $this->confirmationRequestId);
    }

    public function marksTransactionSales(Payload $payload): Response
    {
        return $this->createRequest($payload, $this->salesRequestId);
    }

    public function refundTransaction(Payload $payload): Response
    {
        return $this->createRequest($payload, $this->refundRequestId);
    }

    public function partialRefundTransaction(Payload $payload): Response
    {
        return $this->createRequest($payload, $this->partialRefundRequestId);
    }

    public function saveCard(Payload $payload): Response
    {
        return $this->createRequest($payload, $this->saveCardInfoRequestId);
    }
}