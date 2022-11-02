<?php

namespace Nekoding\LaravelSoftbank\Error;


class PaymentType
{
    public static function parseErrorCode(string $code): string
    {
        return $code;
    }
}
