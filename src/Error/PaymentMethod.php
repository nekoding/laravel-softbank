<?php

namespace Nekoding\LaravelSoftbank\Error;

class PaymentMethod
{
    public static function parseErrorCode(string $code): string
    {
        
        if (strlen($code) >= 3 && function_exists('trans')) {
            $errorMessage = sprintf("laravel-softbank::error_sbpayment_method.%s", substr($code, 0, 3));
            
            if (trans($errorMessage) != $errorMessage) {
                return trans($errorMessage, [], config('laravel-softbank.error_message_locale') ?? 'en');
            }

            return substr($code, 0, 3);
        }

        return $code;
    }
}
