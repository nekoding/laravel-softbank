<?php

namespace Nekoding\LaravelSoftbank\Error;

class PaymentItem
{

    private static $paymentItem = [
        "101"   => [
            "200"   => "Credit Card Number",
            "201"   => "Credit card expiration date",
            "202"   => "Transaction classification",
            "203"   => "Number of divisions",
            "204"   => "Number of bonus combinations",
            "205"   => "Credit card information storage flag",
            "206"   => "Remarks column 1",
            "207"   => "Remarks column 2",
            "208"   => "Remarks column 3",
            "209"   => "Security code",
            "210"   => "-",
            "211"   => "-",
            "212"   => "-",
            "213"   => "-",
            "214"   => "Payment information usage specific type",
            "215"   => "Payment payment method usage specific type",
            "216"   => "Input information return type at the time of payment",
            "217"   => "Credit card brand return flag",
            "218"   => "-",
            "219"   => "-",
            "220"   => "-",
            "221"   => "-",
            "222"   => "-",
            "223"   => "-",
            "224"   => "-",
            "225"   => "Refund branch number",
            "226"   => "-",
            "227"   => "Token",
            "228"   => "Token key",
            "229"   => "Permanent token",
            "900"   => "-",
        ]
    ];

    private static $commonItem = [
        "000"   => "API request ID",
        "001"   => "Merchant ID",
        "002"   => "Service ID",
        "003"   => "Customer ID",
        "004"   => "Purchase ID",
        "005"   => "Product ID",
        "006"   => "Product name",
        "007"   => "Tax amount",
        "008"   => "Amount (tax included)",
        "009"   => "Result notification destination CGI",
        "010"   => "Free column 1",
        "011"   => "Free column 2",
        "012"   => "Free column 3",
        "013"   => "Billing number",
        "014"   => "Line number",
        "015"   => "Item ID",
        "016"   => "Item name",
        "017"   => "Detail quantity",
        "018"   => "Detailed tax amount",
        "019"   => "Detailed amount (tax included)",
        "020"   => "Payment classification",
        "021"   => "Last billing month",
        "022"   => "Campaign type",
        "023"   => "Request date and time",
        "024"   => "Request permissible time",
        "025"   => "Hash",
        "026"   => "SBPS transaction ID to be processed",
        "027"   => "Processing target tracking ID",
        "028"   => "3DES encryption flag",
        "029"   => "Processing date and time",
        "030"   => "SBPS customer information return flag",
    ];

    public static function parseErrorCode(string $paymentErrCode, string $itemErrCode): string
    {

        if (isset(self::$paymentItem[$paymentErrCode][$itemErrCode])) {
            return self::$paymentItem[$paymentErrCode][$itemErrCode];
        }

        if (isset(self::$commonItem[$itemErrCode])) {
            return self::$commonItem[$itemErrCode];
        }

        return "Not applicable";
    }

}