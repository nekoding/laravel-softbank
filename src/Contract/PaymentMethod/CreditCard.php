<?php

namespace Nekoding\LaravelSoftbank\Contract\PaymentMethod;

use Nekoding\LaravelSoftbank\Contract\Payload;
use Nekoding\LaravelSoftbank\Contract\PaymentService;
use Nekoding\LaravelSoftbank\Contract\Response;

interface CreditCard extends PaymentService
{
    
    /**
     * partialRefundTransaction
     *
     * @param  \Nekoding\LaravelSoftbank\Contract\Payload $payload
     * @return Response
     */
    public function partialRefundTransaction(Payload $payload): Response;

}