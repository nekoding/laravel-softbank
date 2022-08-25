<?php

namespace Nekoding\LaravelSoftbank\Tests;

use Illuminate\Foundation\Testing\TestCase;
use Illuminate\Support\Facades\Http;
use Nekoding\LaravelSoftbank\LaravelSoftbank;
use Nekoding\LaravelSoftbank\PaymentMethod\CreditCard\CreditCardPayload;
use Nekoding\LaravelSoftbank\PaymentMethod\SoftbankPayload;
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

    public function test_save_credit_card_using_cardinfo_success()
    {
        $softbank = new LaravelSoftbank;

        $customerID = uniqid("test");

        $payload = $softbank->payload();
        $payload->setMerchantId("30132");
        $payload->setServiceId('103');
        $payload->setHashKey("ed679e1c9f90c2ab96b25d5c580b58e25192eb5d");
        $payload->setCustomerCode($customerID);
        $payload->setEncryptFlag(0);

        $creditCard = new CreditCardPayload();
        $creditCard->setCcNumber("5250729026209007");
        $creditCard->setCcExpiration("201103");
        $creditCard->setCcSecurityCode("798");

        $payload->setPaymentMethodInfo($creditCard);
        $payload->setRequestDate("20220925114212");

        $payload->setPayloadHash(sha1(
            $payload->getMerchantId() .
            $payload->getServiceId() . 
            $payload->getCustomerCode() .
            $creditCard->getCcNumber() . 
            $creditCard->getCcExpiration() . 
            $creditCard->getCcSecurityCode() . 
            $payload->getEncryptFlag() . 
            $payload->getRequestDate() . 
            $payload->getHashKey()
        ));

        Http::fake([
            '*' => Http::response(file_get_contents(__DIR__ . '/mock/cc_save_card_success.xml'))
        ]);

        $res = $softbank->creditCard()->saveCard($payload);

        $this->assertEquals("OK", $res->getResResult());
        $this->assertNull($res->getErrorMessages());
    }

    public function test_save_credit_card_using_cardinfo_failed()
    {
        $softbank = new LaravelSoftbank;

        $random = uniqid("test");

        $payload = $softbank->payload();
        $payload->setMerchantId("30132");
        $payload->setServiceId('002');
        $payload->setHashKey("8435dbd48f2249807ec216c3d5ecab714264cc4a");
        $payload->setCustomerCode($random);
        $payload->setEncryptFlag(0);

        $creditCard = new CreditCardPayload();
        $creditCard->setCcNumber("5250729026209007");
        $creditCard->setCcExpiration("201103");
        $creditCard->setCcSecurityCode("798");

        $payload->setPaymentMethodInfo($creditCard);
        $payload->setRequestDate("20220625114212");

        $payload->setPayloadHash(sha1(
            $payload->getMerchantId() .
            $payload->getServiceId() . 
            $payload->getCustomerCode() .
            $creditCard->getCcNumber() . 
            $creditCard->getCcExpiration() . 
            $creditCard->getCcSecurityCode() . 
            $payload->getEncryptFlag() . 
            $payload->getRequestDate() . 
            $payload->getHashKey()
        ));

        Http::fake([
            '*' => Http::response(file_get_contents(__DIR__ . '/mock/cc_save_card_failed.xml'))
        ]);

        $res = $softbank->creditCard()->saveCard($payload);

        $this->assertEquals("NG", $res->getResResult());
        $this->assertIsArray($res->getErrorMessages());
    }

    public function test_payment_using_saved_card_success()
    {
        $softbank = new LaravelSoftbank;

        $payload = $softbank->payload();
        $payload->setMerchantId("30132");
        $payload->setServiceId('103');
        $payload->setHashKey("ed679e1c9f90c2ab96b25d5c580b58e25192eb5d");

        $customerID = '14790b9d-88df-4b7c-867d-6a551d64d0d9';

        $payload->setCustomerCode($customerID);
        $payload->setOrderId(uniqid());
        $payload->setItemId("ITEMID00000000000000000000000001");
        $payload->setAmount(100);
        $payload->setReturnFlag(1);
        $payload->setRequestDate("20220925114212");
        $payload->setEncryptFlag(0);

        $creditCard = new CreditCardPayload();
        $creditCard->setCardBrandReturnFlag(1);

        $payload->setPaymentMethodInfo($creditCard);

        $payload->setPayloadHash(sha1(
            $payload->getMerchantId() .
            $payload->getServiceId() . 
            $payload->getCustomerCode() . 
            $payload->getOrderId() . 
            $payload->getItemId() . 
            $payload->getAmount() . 
            $payload->getReturnFlag() . 
            $creditCard->getCardBrandReturnFlag() . 
            $payload->getEncryptFlag() . 
            $payload->getRequestDate() . 
            $payload->getHashKey()
        ));

        Http::fake([
            '*' => Http::response(file_get_contents(__DIR__ . '/mock/cc_payment_using_saved_card_success.xml'))
        ]);

        $res = $softbank->creditCard()->createTransaction($payload);

        $this->assertEquals("OK", $res->getResResult());
        $this->assertNull($res->getErrorMessages());
    }

    public function test_payment_using_saved_card_failed()
    {
        $softbank = new LaravelSoftbank;

        $payload = $softbank->payload();
        $payload->setMerchantId("30132");
        $payload->setServiceId('002');
        $payload->setHashKey("8435dbd48f2249807ec216c3d5ecab714264cc4a");

        $customerID = 'test62b579b43e677';

        $payload->setCustomerCode($customerID);
        $payload->setOrderId(uniqid());
        $payload->setItemId("ITEMID00000000000000000000000001");
        $payload->setAmount(100);
        $payload->setReturnFlag(1);
        $payload->setRequestDate("20220625114212");
        $payload->setEncryptFlag(0);

        $creditCard = new CreditCardPayload();
        $creditCard->setCardBrandReturnFlag(1);

        $payload->setPaymentMethodInfo($creditCard);

        $payload->setPayloadHash(sha1(
            $payload->getMerchantId() .
            $payload->getServiceId() . 
            $payload->getCustomerCode() . 
            $payload->getOrderId() . 
            $payload->getItemId() . 
            $payload->getAmount() . 
            $payload->getReturnFlag() . 
            $creditCard->getCardBrandReturnFlag() . 
            $payload->getEncryptFlag() . 
            $payload->getRequestDate() . 
            $payload->getHashKey()
        ));

        Http::fake([
            '*' => Http::response(file_get_contents(__DIR__ . '/mock/cc_payment_using_saved_card_failed.xml'))
        ]);

        $res = $softbank->creditCard()->createTransaction($payload);

        $this->assertEquals("NG", $res->getResResult());
        $this->assertNotNull($res->getErrorMessages());
    }

    public function test_compose_array_params()
    {

        $params = [
            'merchant_id' => '12345',
            'service_id'  => '001',
            'cust_code' => '001',
            'order_id' => '001',
            'item_id' => '001',
            'amount'    => 001,
            'request_date' => '20220720110909',
            'sps_hashcode' => sha1(
                'merchant_id' . 
                'service_id' . 
                'customer id' . 
                'order id' . 
                'item id' . 
                'amount' . 
                'request date' . 
                'hash key'
            )
        ];

        $softbankPayload = SoftbankPayload::create($params);

        $this->assertTrue($softbankPayload instanceof SoftbankPayload);

        $this->assertEquals($params['merchant_id'], $softbankPayload->getMerchantId());
        $this->assertEquals($params['service_id'], $softbankPayload->getServiceId());
        $this->assertEquals($params['cust_code'], $softbankPayload->getCustomerCode());

    }

    public function test_get_credit_card_info()
    {
        $softbank = new LaravelSoftbank;

        $time = '20220925084920';

        $hash = 'ed679e1c9f90c2ab96b25d5c580b58e25192eb5d';

        $data = [
            'merchant_id'           => '30132',
            'hash_key'              => $hash,
            'service_id'            => '103',
            'cust_code'             => '550519da-5e69-4fa0-9120-17ed582b8fec',
            'response_info_type'    => '2',
            'pay_option_manage'     => [
                'cardbrand_return_flg' => 1
            ],
            'encrypted_flg'         => 0,
            'request_date'          => $time,
            'sps_hashcode'          => sha1(
                '30132' . 
                '103' . 
                '550519da-5e69-4fa0-9120-17ed582b8fec' . 
                '2' . 
                '1' .
                '0' .
                $time . 
                $hash)
        ];

        $payload = SoftbankPayload::create($data);

        Http::fake([
            '*' => Http::response(file_get_contents(__DIR__ . '/mock/cc_get_info_success.xml'))
        ]);

        $result = $softbank->creditCard()->getCard($payload);

        $this->assertNull($result->getErrorMessages());

        $this->assertEquals('OK', $result->getResResult());
    }

}