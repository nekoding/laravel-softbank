<?php

namespace Nekoding\LaravelSoftbank\Error;

class PaymentItem
{
    public static function parseErrorCode(string $code): string
    {
        return $code;
    }

}