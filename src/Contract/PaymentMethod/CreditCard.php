<?php

namespace Nekoding\LaravelSoftbank\Contract\PaymentMethod;

use Nekoding\LaravelSoftbank\Contract\Payload;
use Nekoding\LaravelSoftbank\Contract\PaymentService;
use Nekoding\LaravelSoftbank\Contract\Response;

abstract class CreditCard extends PaymentService
{
    
    /**
     * partialRefundTransaction
     *
     * @param  \Nekoding\LaravelSoftbank\Contract\Payload $payload
     * @return Response
     */
    public abstract function partialRefundTransaction(Payload $payload): Response;
    
    /**
     * saveCard
     *
     * @param  \Nekoding\LaravelSoftbank\Contract\Payload $payload
     * @return Response
     */
    public abstract function saveCard(Payload $payload): Response;
    
    /**
     * saveCardToken
     *
     * @param  \Nekoding\LaravelSoftbank\Contract\Payload $payload
     * @return Response
     */
    // public abstract function saveCardToken(Payload $payload): Response;
    
    /**
     * updateCard
     *
     * @param  \Nekoding\LaravelSoftbank\Contract\Payload $payload
     * @return Response
     */
    // public abstract function updateCard(Payload $payload): Response;
    
    /**
     * deleteCard
     *
     * @param  \Nekoding\LaravelSoftbank\Contract\Payload $payload
     * @return Response
     */
    // public abstract function deleteCard(Payload $payload): Response;

}