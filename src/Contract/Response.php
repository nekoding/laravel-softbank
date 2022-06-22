<?php

namespace Nekoding\LaravelSoftbank\Contract;

interface Response
{
    
    /**
     * Get the value of resResult
     * 
     * @return null|string
     */ 
    public function getResResult(): ?string;

    /**
     * Set the value of resResult
     *
     * @return  self
     */ 
    public function setResResult($resResult): self;

    /**
     * Get the value of resErrorCode
     * 
     * @return null|string
     */ 
    public function getResErrorCode(): ?string;

    /**
     * Set the value of resErrorCode
     *
     * @return  self
     */ 
    public function setResErrorCode($resErrorCode): self;

    /**
     * Get the value of resDate
     * 
     * @return null|string
     */ 
    public function getResDate(): ?string;

    /**
     * Set the value of resDate
     *
     * @return  self
     */ 
    public function setResDate($resDate): self;

    /**
     * Decode value of error message
     * 
     * @return null|array
     */
    public function getErrorMessages(): ?array;

    /**
     * Get the value of transactionId
     * 
     * @return null|string
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
     * @return null|string
     */ 
    public function getTrackingId(): ?string;

    /**
     * Set the value of trackingId
     *
     * @return  self
     */ 
    public function setTrackingId($trackingId): self;

    /**
     * Get the value of paymentInfo
     * 
     * @return null|array
     */ 
    public function getPaymentInfo(): ?array;

    /**
     * Set the value of paymentInfo
     *
     * @return  self
     */ 
    public function setPaymentInfo($paymentInfo): self;

}