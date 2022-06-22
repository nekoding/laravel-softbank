<?php

namespace Nekoding\LaravelSoftbank\Contract;

use Symfony\Component\Serializer\Annotation\SerializedName;
use Symfony\Component\Serializer\Annotation\Ignore;

interface Payload
{
    /**
     * Get the value of merchantId
     * 
     * @return string
     */ 
    public function getMerchantId(): ?string;

    /**
     * Set the value of merchantId
     *
     * @return  self
     */ 
    public function setMerchantId($merchantId): self;

    /**
     * Get the value of serviceId
     * 
     * @return string
     */ 
    public function getServiceId(): ?string;
    /**
     * Set the value of serviceId
     *
     * @return  self
     */ 
    public function setServiceId($serviceId): self;

    /**
     * Get the value of hashKey
     * 
     * @return string
     */ 
    public function getHashKey(): ?string;

    /**
     * Set the value of hashKey
     *
     * @return  self
     */ 
    public function setHashKey($hashKey): self;

    /**
     * Get the value of api auth username
     *
     * @return  string
     * @Ignore()
     */ 
    public function getAuthUsername(): ?string;

    /**
     * Get the value of api auth password
     *
     * @return  string
     * @Ignore()
     */ 
    public function getAuthPassword(): ?string;

    /**
     * Get the value of customerCode
     * 
     * @return string
     */ 
    public function getCustomerCode(): ?string;

    /**
     * Set the value of customerCode
     *
     * @return  self
     */ 
    public function setCustomerCode($customerCode): self;

    /**
     * Get the value of orderId
     * 
     * @return string
     */ 
    public function getOrderId(): ?string;

    /**
     * Set the value of orderId
     *
     * @return  self
     */ 
    public function setOrderId($orderId): self;

    /**
     * Get the value of itemId
     * 
     * @return string
     */ 
    public function getItemId(): ?string;

    /**
     * Set the value of itemId
     *
     * @return  self
     */ 
    public function setItemId($itemId): self;

    /**
     * Get the value of itemName
     * 
     * @return string
     */ 
    public function getItemName(): ?string;

    /**
     * Set the value of itemName
     *
     * @return  self
     */ 
    public function setItemName($itemName): self;

    /**
     * Get the value of tax
     * 
     * @return int
     */ 
    public function getTax(): ?int;
    /**
     * Set the value of tax
     *
     * @return  self
     */ 
    public function setTax($tax): self;

    /**
     * Get the value of amount
     * 
     * @return int
     */ 
    public function getAmount(): ?int;

    /**
     * Set the value of amount
     *
     * @return  self
     */ 
    public function setAmount($amount): self;

    /**
     * Get the value of returnFlag
     * 
     * @return int
     */ 
    public function getReturnFlag(): ?int;

    /**
     * Set the value of returnFlag
     *
     * @return  self
     */ 
    public function setReturnFlag($returnFlag): self;

    /**
     * Get the value of encryptFlag
     * 
     * @return int
     */ 
    public function getEncryptFlag(): ?int;

    /**
     * Set the value of encryptFlag
     *
     * @return  self
     */ 
    public function setEncryptFlag($encryptFlag): self;

    /**
     * Get the value of requestDate
     * 
     * @return string
     */ 
    public function getRequestDate(): ?string;

    /**
     * Set the value of requestDate
     *
     * @return  self
     */ 
    public function setRequestDate($requestDate): self;

    /**
     * Get the value of payloadHash
     * 
     * @return string
     */ 
    public function getPayloadHash(): ?string;

    /**
     * Set the value of payloadHash
     *
     * @return  self
     */ 
    public function setPayloadHash($payloadHash): self;

    /**
     * Get the value of paymentMethodInfo
     * 
     * @return PaymentInfo|array|null
     */ 
    public function getPaymentMethodInfo();

    /**
     * Set the value of paymentMethodInfo
     *
     * @return  self
     */ 
    public function setPaymentMethodInfo($paymentMethodInfo): self;

    /**
     * Get the value of transactionId
     * 
     * @return string
     */ 
    public function getTransactionId(): ?string;

    /**
     * Set the value of transactionId
     *
     * @return  self
     */ 
    public function setTransactionId($transactionId): self;

    /**
     * Get the value of trackingId
     * 
     * @return string
     */ 
    public function getTrackingId(): ?string;

    /**
     * Set the value of trackingId
     *
     * @return  self
     */ 
    public function setTrackingId($trackingId): self;

    /**
     * Get the value of processingDate
     * 
     * @return string
     */ 
    public function getProcessingDate(): ?string;

    /**
     * Set the value of processingDate
     *
     * @return  self
     */ 
    public function setProcessingDate($trackingId): self;

    /**
     * Get the value of paymentOption
     * 
     * @return array|null
     */ 
    public function getPaymentOption();

    /**
     * Set the value of paymentOption
     *
     * @return  self
     */ 
    public function setPaymentOption($paymentOption): self;

}