<?php

namespace Nekoding\LaravelSoftbank\Tests;

use Illuminate\Foundation\Testing\TestCase;
use Illuminate\Support\Facades\Http;
use Nekoding\LaravelSoftbank\LaravelSoftbank;
use Nekoding\LaravelSoftbank\PaymentMethod\CreditCard\CreditCardPayload;
use Orchestra\Testbench\Concerns\CreatesApplication;

class LaravelSoftbankTest extends TestCase
{

    use CreatesApplication;

    public function test_credit_card_request_success()
    {
        $softbank = new LaravelSoftbank;

        $payload = $softbank->payload();
        $payload->setMerchantId("30132");
        $payload->setServiceId('002');
        $payload->setHashKey("8435dbd48f2249807ec216c3d5ecab714264cc4a");

        $payload->setCustomerCode("Merchant_TestUser_999999");
        $payload->setOrderId(uniqid());
        $payload->setItemId("ITEMID00000000000000000000000001");
        $payload->setAmount(100);
        $payload->setReturnFlag(1);
        $payload->setRequestDate("20220625114212");
        $payload->setEncryptFlag(0);

        $creditCard = new CreditCardPayload();
        $creditCard->setCcNumber("5250729026209007");
        $creditCard->setCcExpiration("201103");
        $creditCard->setCcSecurityCode("798");

        $payload->setPaymentMethodInfo($creditCard);

        $payload->setPayloadHash(sha1(
            $payload->getMerchantId() .
            $payload->getServiceId() . 
            $payload->getCustomerCode() . 
            $payload->getOrderId() . 
            $payload->getItemId() . 
            $payload->getAmount() . 
            $payload->getReturnFlag() . 
            $creditCard->getCcNumber() . 
            $creditCard->getCcExpiration() . 
            $creditCard->getCcSecurityCode() . 
            $payload->getEncryptFlag() . 
            $payload->getRequestDate() . 
            $payload->getHashKey()
        ));

        $this->assertEquals("30132", $payload->getMerchantId());
        $this->assertEquals("002", $payload->getServiceId());
        $this->assertEquals("8435dbd48f2249807ec216c3d5ecab714264cc4a", $payload->getHashKey());

        Http::fake([
            '*' => Http::response(file_get_contents(__DIR__ . '/mock/cc_success.xml'))
        ]);

        $res = $softbank->creditCard()->createTransaction($payload);

        $this->assertEquals("OK", $res->getResResult());
        $this->assertNull($res->getErrorMessages());
    }

    public function test_credit_card_request_failed()
    {
        $softbank = new LaravelSoftbank;

        $payload = $softbank->payload();
        $payload->setMerchantId("30132");
        $payload->setServiceId('002');
        $payload->setHashKey("8435dbd48f2249807ec216c3d5ecab714264cc4a");

        $payload->setCustomerCode("Merchant_TestUser_999999");
        $payload->setOrderId(uniqid());
        $payload->setItemId("ITEMID00000000000000000000000001");
        $payload->setAmount(1);
        $payload->setReturnFlag(1);
        $payload->setRequestDate("20220622114212");
        $payload->setEncryptFlag(0);

        $creditCard = new CreditCardPayload();
        $creditCard->setCcNumber("5250729026209007");
        $creditCard->setCcExpiration("201103");
        $creditCard->setCcSecurityCode("798");

        $payload->setPaymentMethodInfo($creditCard);

        $payload->setPayloadHash(sha1(
            $payload->getMerchantId() .
            $payload->getServiceId() . 
            $payload->getCustomerCode() . 
            $payload->getOrderId() . 
            $payload->getItemId() . 
            $payload->getAmount() . 
            $payload->getReturnFlag() . 
            $creditCard->getCcNumber() . 
            $creditCard->getCcExpiration() . 
            $creditCard->getCcSecurityCode() . 
            $payload->getEncryptFlag() . 
            $payload->getRequestDate() . 
            $payload->getHashKey()
        ));

        Http::fake([
            '*' => Http::response(file_get_contents(__DIR__ . '/mock/cc_failed.xml'))
        ]);

        $res = $softbank->creditCard()->createTransaction($payload);

        $this->assertEquals("NG", $res->getResResult());
        $this->assertIsArray($res->getErrorMessages());
    }

    public function test_credit_card_confirm_success()
    {
        $softbank = new LaravelSoftbank;

        $payload = $softbank->payload();
        $payload->setMerchantId("30132");
        $payload->setServiceId('002');
        $payload->setHashKey("8435dbd48f2249807ec216c3d5ecab714264cc4a");

        $payload->setTransactionId("C30132002ST010010110100165280812");
        $payload->setTrackingId("00000640935095");
        $payload->setRequestDate("20220622170033");
        $payload->setPayloadHash(
            sha1(
                $payload->getMerchantId() . 
                $payload->getServiceId() . 
                $payload->getTransactionId() . 
                $payload->getTrackingId() . 
                $payload->getRequestDate() .
                $payload->getHashKey()
            )
        );

        Http::fake([
            '*' => Http::response(file_get_contents(__DIR__ . '/mock/cc_confirm_success.xml'))
        ]);

        $res = $softbank->creditCard()->confirmTransaction($payload);

        $this->assertEquals("OK", $res->getResResult());
        $this->assertNull($res->getErrorMessages());
    }

    public function test_credit_card_confirm_failed()
    {
        $softbank = new LaravelSoftbank;

        $payload = $softbank->payload();
        $payload->setMerchantId("30132");
        $payload->setServiceId('002');
        $payload->setHashKey("8435dbd48f2249807ec216c3d5ecab714264cc4a");

        $payload->setTransactionId("C30132002ST010010110100129880401");
        $payload->setTrackingId("00000640848839");
        $payload->setRequestDate("20220622170033");
        $payload->setPayloadHash(
            sha1(
                $payload->getMerchantId() . 
                $payload->getServiceId() . 
                $payload->getTransactionId() . 
                $payload->getTrackingId() . 
                $payload->getRequestDate() .
                $payload->getHashKey()
            )
        );

        Http::fake([
            '*' => Http::response(file_get_contents(__DIR__ . '/mock/cc_confirm_failed.xml'))
        ]);

        $res = $softbank->creditCard()->confirmTransaction($payload);

        $this->assertEquals("NG", $res->getResResult());
        $this->assertIsArray($res->getErrorMessages());
    }

    public function test_credit_card_sales_success()
    {
        $softbank = new LaravelSoftbank;

        $payload = $softbank->payload();
        $payload->setMerchantId("30132");
        $payload->setServiceId('002');
        $payload->setHashKey("8435dbd48f2249807ec216c3d5ecab714264cc4a");

        $payload->setTransactionId("C30132002ST010010110100175168591");
        $payload->setTrackingId("00000640946730");
        $payload->setRequestDate("20220622170033");
        $payload->setProcessingDate("20220622170033");

        $payload->setPayloadHash(
            sha1(
                $payload->getMerchantId() . 
                $payload->getServiceId() . 
                $payload->getTransactionId() . 
                $payload->getTrackingId() .
                $payload->getProcessingDate() .  
                $payload->getRequestDate() .
                $payload->getHashKey()
            )
        );

        Http::fake([
            '*' => Http::response(file_get_contents(__DIR__ . '/mock/cc_sales_success.xml'))
        ]);

        $res = $softbank->creditCard()->marksTransactionSales($payload);

        $this->assertEquals("OK", $res->getResResult());
        $this->assertNull($res->getErrorMessages());
    }

    public function test_credit_card_sales_failed()
    {
        $softbank = new LaravelSoftbank;

        $payload = $softbank->payload();
        $payload->setMerchantId("30132");
        $payload->setServiceId('002');
        $payload->setHashKey("8435dbd48f2249807ec216c3d5ecab714264cc4a");

        $payload->setTransactionId("C30132002ST010010110100129880401");
        $payload->setTrackingId("00000640848839");
        $payload->setRequestDate("20220622170033");
        $payload->setPayloadHash(
            sha1(
                $payload->getMerchantId() . 
                $payload->getServiceId() . 
                $payload->getTransactionId() . 
                $payload->getTrackingId() . 
                $payload->getRequestDate() .
                $payload->getHashKey()
            )
        );

        Http::fake([
            '*' => Http::response(file_get_contents(__DIR__ . '/mock/cc_sales_failed.xml'))
        ]);

        $res = $softbank->creditCard()->marksTransactionSales($payload);

        $this->assertEquals("NG", $res->getResResult());
        $this->assertIsArray($res->getErrorMessages());
    }

    public function test_credit_card_refund_success()
    {
        $softbank = new LaravelSoftbank;

        $payload = $softbank->payload();
        $payload->setMerchantId("30132");
        $payload->setServiceId('002');
        $payload->setHashKey("8435dbd48f2249807ec216c3d5ecab714264cc4a");

        $payload->setTransactionId("C30132002ST010010110100165280812");
        $payload->setTrackingId("00000640935095");
        $payload->setRequestDate("20220622170033");
        $payload->setProcessingDate("20220622170033");

        $payload->setPayloadHash(
            sha1(
                $payload->getMerchantId() . 
                $payload->getServiceId() . 
                $payload->getTransactionId() . 
                $payload->getTrackingId() .
                $payload->getProcessingDate() .  
                $payload->getRequestDate() .
                $payload->getHashKey()
            )
        );

        Http::fake([
            '*' => Http::response(file_get_contents(__DIR__ . '/mock/cc_refund_success.xml'))
        ]);

        $res = $softbank->creditCard()->refundTransaction($payload);

        $this->assertEquals("OK", $res->getResResult());
        $this->assertNull($res->getErrorMessages());
    }

    public function test_credit_card_refund_failed()
    {
        $softbank = new LaravelSoftbank;

        $payload = $softbank->payload();
        $payload->setMerchantId("30132");
        $payload->setServiceId('002');
        $payload->setHashKey("8435dbd48f2249807ec216c3d5ecab714264cc4a");

        $payload->setTransactionId("C30132002ST010010110100129880401");
        $payload->setTrackingId("00000640848839");
        $payload->setRequestDate("20220622170033");
        $payload->setPayloadHash(
            sha1(
                $payload->getMerchantId() . 
                $payload->getServiceId() . 
                $payload->getTransactionId() . 
                $payload->getTrackingId() . 
                $payload->getRequestDate() .
                $payload->getHashKey()
            )
        );

        Http::fake([
            '*' => Http::response(file_get_contents(__DIR__ . '/mock/cc_refund_failed.xml'))
        ]);

        $res = $softbank->creditCard()->marksTransactionSales($payload);

        $this->assertEquals("NG", $res->getResResult());
        $this->assertIsArray($res->getErrorMessages());
    }

    public function test_credit_card_partial_refund_success()
    {
        $softbank = new LaravelSoftbank;

        $payload = $softbank->payload();
        $payload->setMerchantId("30132");
        $payload->setServiceId('002');
        $payload->setHashKey("8435dbd48f2249807ec216c3d5ecab714264cc4a");

        $payload->setTransactionId("C30132002ST010010110100175168591");
        $payload->setTrackingId("00000640946730");
        $payload->setRequestDate("20220622170033");
        $payload->setProcessingDate("20220622200033");

        $payload->setPaymentOption(['amount' => 50]);

        $payload->setPayloadHash(
            sha1(
                $payload->getMerchantId() . 
                $payload->getServiceId() . 
                $payload->getTransactionId() . 
                $payload->getTrackingId() . 
                $payload->getProcessingDate() .  
                50 .
                $payload->getRequestDate() .
                $payload->getHashKey()
            )
        );

        Http::fake([
            '*' => Http::response(file_get_contents(__DIR__ . '/mock/cc_partial_refund_success.xml'))
        ]);

        $res = $softbank->creditCard()->partialRefundTransaction($payload);

        $this->assertEquals("OK", $res->getResResult());
        $this->assertNull($res->getErrorMessages());
    }

    public function test_credit_card_partial_refund_failed()
    {
        $softbank = new LaravelSoftbank;

        $payload = $softbank->payload();
        $payload->setMerchantId("30132");
        $payload->setServiceId('002');
        $payload->setHashKey("8435dbd48f2249807ec216c3d5ecab714264cc4a");

        $payload->setTransactionId("C30132002ST010010110100175168591");
        $payload->setTrackingId("00000640946730");
        $payload->setRequestDate("20220622170033");
        $payload->setProcessingDate("20220622200033");

        $payload->setPaymentOption(['amount' => 50]);

        $payload->setPayloadHash(
            sha1(
                $payload->getMerchantId() . 
                $payload->getServiceId() . 
                $payload->getTransactionId() . 
                $payload->getTrackingId() . 
                $payload->getProcessingDate() .  
                50 .
                $payload->getRequestDate() .
                $payload->getHashKey()
            )
        );

        Http::fake([
            '*' => Http::response(file_get_contents(__DIR__ . '/mock/cc_partial_refund_failed.xml'))
        ]);

        $res = $softbank->creditCard()->partialRefundTransaction($payload);

        $this->assertEquals("NG", $res->getResResult());
        $this->assertIsArray($res->getErrorMessages());
    }

}