<?php

namespace Nekoding\LaravelSoftbank\Error;


class PaymentType
{
    public static function parseErrorCode(string $code): string
    {
        if (strlen($code) >= 5 && function_exists('trans')) {
            $errorMessage = sprintf("laravel-softbank::error_sbpayment_type.%s.%s", substr($code, 0, 3), substr($code, 3, 2));
            
            if (trans($errorMessage) != $errorMessage) {
                return trans($errorMessage, [], config('laravel-softbank.error_message_locale') ?? 'en');
            }

            $fallbackErrorMessage = sprintf("laravel-softbank::error_sbpayment_type._.%s", substr($code, 3, 2));

            if (trans($fallbackErrorMessage) != $fallbackErrorMessage) {
                return trans($fallbackErrorMessage, [], config('laravel-softbank.error_message_locale') ?? 'en');
            }

            return substr($code, 3, 2);
        }

        return $code;
    }
}
