<?php

namespace Nekoding\LaravelSoftbank;

use Nekoding\LaravelSoftbank\Contract\Payload;
use Nekoding\LaravelSoftbank\Contract\PaymentMethod\CreditCard;
use Nekoding\LaravelSoftbank\PaymentMethod\CreditCard\CreditCardPayment;
use Nekoding\LaravelSoftbank\PaymentMethod\SoftbankPayload;

class LaravelSoftbank
{

    
    /**
     * payload
     *
     * @return \Nekoding\LaravelSoftbank\PaymentMethod\SoftbankPayload
     */
    public function payload(): Payload
    {
        return new SoftbankPayload();
    }

    
    /**
     * creditCard
     *
     * @return \Nekoding\LaravelSoftbank\PaymentMethod\CreditCard\CreditCardPayment
     */
    public function creditCard(): CreditCard
    {
        return new CreditCardPayment();
    }

}
