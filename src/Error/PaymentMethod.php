<?php

namespace Nekoding\LaravelSoftbank\Error;

class PaymentMethod
{

    private static $messages = [
        "101"   => "Credit Card",
        "305"   => "Rakuten Pay (Online Payment)",
        "306"   => "Paypal",
        "307"   => "Yahoo! Wallet payment Digicon version",
        "309"   => "Recruit Easy Payment",
        "310"   => "LINE Pay",
        "311"   => "PayPay (Online Payment)",
        "313"   => "Wallet payment service (Type-Y)",
        "314"   => "Melpay Net Payment",
        "315"   => "Amazon Pay",
        "316"   => "Epos Easy Settlement",
        "401"   => "Docomo Payment (carrier)",
        "402"   => "au Easy settlement",
        "405"   => "SoftBank Collective Payment (B)",
        "406"   => "au PAY (net payment)",
        "510"   => "Alipay International Payment",
        "513"   => "JCB PREMO payment / house prepaid payment",
        "514"   => "UnionPay Net Payment",
        "601"   => "Apple Pay",
        "604"   => "Google Pay",
        "701"   => "Convenience payment",
        "702"   => "Comprehensive transfer settlement",
        "703"   => "Pay-easy payment",
        "710"   => "NP Deferred Payment",
        "805"   => "Permanent Immortal Point Settlement",
        "806"   => "T point program (online payment)",
        "912"   => "Maillink type",
        "999"   => "Common"
    ];

    public static function parseErrorCode(string $code): string
    {
        return self::$messages[$code];
    }

}