<?php

namespace Nekoding\LaravelSoftbank\Error;

class PaymentMethod
{
    public static function parseErrorCode(string $code): string
    {
        return $code;
    }
}
