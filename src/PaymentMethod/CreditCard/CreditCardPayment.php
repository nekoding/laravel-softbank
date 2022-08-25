<?php

namespace Nekoding\LaravelSoftbank\PaymentMethod\CreditCard;

use Nekoding\LaravelSoftbank\Contract\Payload;
use Nekoding\LaravelSoftbank\Contract\PaymentMethod\CreditCard;
use Nekoding\LaravelSoftbank\Contract\Response;

class CreditCardPayment extends CreditCard
{
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
    protected $updateCardInfoRequestId  = 'MG02-00132-101';
    protected $deleteCardInfoRequestId  = 'MG02-00103-101"';
    protected $getCardInfoRequestId     = 'MG02-00104-101';


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

    public function updateCard(Payload $payload): Response
    {
        return $this->createRequest($payload, $this->updateCardInfoRequestId);
    }

    public function deleteCard(Payload $payload): Response
    {
        return $this->createRequest($payload, $this->deleteCardInfoRequestId);
    }

    public function getCard(Payload $payload): Response
    {
        return $this->createRequest($payload, $this->getCardInfoRequestId);
    }
}