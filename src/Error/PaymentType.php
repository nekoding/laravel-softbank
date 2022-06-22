<?php

namespace Nekoding\LaravelSoftbank\Error;


class PaymentType
{

    private static $paymentErrorMessage = [
        "101"   => [
            "20"    => "Credit card fraud card filter error",
            "21"    => "Credit center error",
            "22"    => "Credit card usage limit exceeded",
            "23"    => "Credit card not accepted",
            "24"    => "Illegal PIN",
            "25"    => "Exceeded credit card usage limit",
            "26"    => "Credit card not accepted",
            "27"    => "Credit card number / expiration date error",
            "28"    => "Transaction details cannot be handled",
            "29"    => "Cannot use the specified bonus number of times",
            "30"    => "Not available for designated bonus month",
            "31"    => "Specified bonus amount is not available",
            "32"    => "Not available in the designated payment start month",
            "33"    => "Cannot be used for the specified number of divisions",
            "34"    => "Specified installment amount not available",
            "35"    => "Specified initial payment amount is not available",
            "36"    => "Other credit errors",
            "37"    => "No sales request is required because automatic sales are set.",
            "38"    => "In the case of G formula, please process the sales with a file.",
            "39"    => "Sales processing has been canceled because there is no credit result.",
            "40"    => "Sales processing has been canceled because the credit has been cancelled.",
            "41"    => "Processing has been canceled because sales processing has been completed.",
            "42"    => "The processing date and time of sales processing is from the credit date3Valid until the end of the month.",
            "43"    => "In the case of G type, please process the refund with a file.",
            "44"    => "Refund processing has been canceled because the credit result does not exist.",
            "45"    => "Refund processing has been canceled because the credit has been cancelled.",
            "46"    => "Refund processing has been canceled because refund processing has been completed.",
            "47"    => "Refund processing has been canceled due to continuous billing.",
            "48"    => "-",
            "49"    => "Request a refund for automatic sales API",
            "50"    => "For P expressions, use the refund request API.",
            "51"    => "The credit cancellation process has been canceled because the credit result does not exist.",
            "52"    => "Since the credit has been canceled, the credit cancellation process has been cancelled.",
            "53"    => "-",
            "54"    => "Credit cancellation processing has been canceled due to continuous billing.",
            "55"    => "-",
            "56"    => "Refunds will be processed after the sales date and from the credit cancellation date.3Valid until the end of the month.",
            "57"    => "The specified renewal billing has already been cancelled.",
            "58"    => "Continuous billing in-use error",
            "59"    => "In the case of automatic sales (applying the commit flag), please perform refund processing after executing the commit.",
            "60"    => "Commit (cancel) cannot be executed because the process has already been completed.",
            "61"    => "Incorrect security code",
            "62"    => "-",
            "63"    => "Authentication assist information required error (SmartLinkTarget when using)",
            "64"    => "SmartLinkCenter error (SmartLinkTarget when using)",
            "65"    => "Settlement company judgment error",
            "66"    => "Settlement company judgment error",
            "67"    => "Settlement company judgment error",
            "68"    => "Settlement company judgment error",
            "69"    => "Settlement company judgment error",
            "70"    => "Settlement company judgment error",
            "71"    => "Settlement company judgment error",
            "72"    => "Settlement company judgment error",
            "73"    => "Settlement company judgment error",
            "74"    => "Settlement company judgment error",
            "75"    => "Settlement company judgment error",
            "76"    => "Settlement company judgment error",
            "77"    => "Settlement company judgment error",
            "78"    => "Credit card information storage flag specification error",
            "79"    => "Sales processing has been canceled because the specified amount exceeds the credit time amount.",
            "K0"    => "Partial refund processing has been canceled because sales processing has not been carried out.",
            "K1"    => "The partial refund process has been canceled because the total refund amount exceeds the sales amount.",
            "K2"    => "Settlement company judgment error",
            "K3"    => "Credit card brand return flag specification error",
            "K4"    => "The credit information change process has been canceled.",
            "K5"    => "The credit information change process has been canceled.",
            "W0"    => "Sales processing has been canceled because the cancellation process is already in progress.",
            "W1"    => "For the processing date and time, specify a date after the credit date.",
            "W2"    => "Refund processing has been canceled because sales processing has not been carried out.",
            "W3"    => "Refund processing has been canceled because refund processing is already in progress.",
            "W4"    => "Refund processing has been canceled because the specified amount exceeds the sales amount.",
            "W5"    => "For the processing date and time, specify a date after the sales date.",
            "W6"    => "The cancellation process has been canceled because the cancellation process is already in progress.",
        ]
    ];

    private static $commonErrorMessage = [
        "00"    => "XML format invalid",
        "01"    => "Invalid payment method",
        "02"    => "Invalid API request ID",
        "03"    => "No value is specified for the required field",
        "04"    => "Data type other than storable data type is specified",
        "05"    => "Exceeding data length",
        "06"    => "Illegal format",
        "07"    => "Definition value error",
        "08"    => "-",
        "09"    => "Invalid request hash value",
        "10"    => "Submitted request expires (default 10 minutes)",
        "11"    => "No settlement associated with the specified processing target SBPS transaction ID",
        "12"    => "No settlement associated with the processing target tracking ID specified in the recredit.",
        "13"    => "Value is set for a parameter that cannot be specified in recredit.",
        "14"    => "Merchant ID / service ID does not exist",
    ];

    private static $internalErrorMessage = [
        "80"    => "GW system error",
        "81"    => "API request parameter error",
        "82"    => "-",
        "83"    => "GW record search error",
        "84"    => "Settlement company response parameter error",
        "85"    => "Settlement company connection error",
        "86"    => "Settlement company system error",
    ];

    private static $apiErrorMessage = [
        "90"    => "API system error",
        "91"    => "-",
        "92"    => "GW connection error",
        "93"    => "Maximum number of re-entry limit error",
        "94"    => "Settlement incomplete error",
        "95"    => "Customer information integrity error",
        "96"    => "Double request error",
        "97"    => "Double request error (multiple partial refunds)",
        "98"    => "Permanent token integrity error",
    ];

    public static function parseErrorCode(string $paymentMethodCode, string $paymentTypeCode): string
    {

        if (isset(self::$paymentErrorMessage[$paymentMethodCode][$paymentTypeCode])) {
            return self::$paymentErrorMessage[$paymentMethodCode][$paymentTypeCode];
        }

        if (isset(self::$commonErrorMessage[$paymentTypeCode])) {
            return self::$commonErrorMessage[$paymentTypeCode];
        }

        if (isset(self::$internalErrorMessage[$paymentTypeCode])) {
            return self::$internalErrorMessage[$paymentTypeCode];
        }

        if (isset(self::$apiErrorMessage[$paymentTypeCode])) {
            return self::$apiErrorMessage[$paymentTypeCode];
        }

        return 'Unidentified';

    }
}
