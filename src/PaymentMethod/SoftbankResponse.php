<?php

namespace Nekoding\LaravelSoftbank\PaymentMethod;

use Nekoding\LaravelSoftbank\Contract\Response;
use Nekoding\LaravelSoftbank\Error\PaymentItem;
use Nekoding\LaravelSoftbank\Error\PaymentMethod;
use Nekoding\LaravelSoftbank\Error\PaymentType;
use Symfony\Component\Serializer\Annotation\SerializedName;

class SoftbankResponse implements Response
{

    /**
     * @SerializedName("res_result")
     */
    protected $resResult;

    /**
     * @SerializedName("res_err_code")
     */
    protected $resErrorCode;

    /**
     * @SerializedName("res_date")
     */
    protected $resDate;

    /**
     * @SerializedName("res_sps_transaction_id")
     */
    protected $transactionId;

    /**
     * @SerializedName("res_tracking_id")
     */
    protected $trackingId;

    /**
     * @SerializedName("res_pay_method_info")
     */
    protected $paymentInfo;

    // Getter and setter


    /**
     * Get the value of resResult
     */
    public function getResResult(): ?string
    {
        return $this->resResult;
    }

    /**
     * Set the value of resResult
     *
     * @return  self
     */
    public function setResResult($resResult): Response
    {
        $this->resResult = $resResult;

        return $this;
    }

    /**
     * Get the value of resErrorCode
     */
    public function getResErrorCode(): ?string
    {
        return $this->resErrorCode;
    }

    /**
     * Set the value of resErrorCode
     *
     * @return  self
     */
    public function setResErrorCode($resErrorCode): Response
    {
        $this->resErrorCode = $resErrorCode;

        return $this;
    }

    /**
     * Get the value of resDate
     */
    public function getResDate(): ?string
    {
        return $this->resDate;
    }

    /**
     * Set the value of resDate
     *
     * @return  self
     */
    public function setResDate($resDate): Response
    {
        $this->resDate = $resDate;

        return $this;
    }

    /**
     * Get error messages
     */
    public function getErrorMessages(): ?array
    {
        if ($this->getResResult() == 'NG') {
            return [
                PaymentMethod::parseErrorCode($this->getResErrorCode()),
                PaymentType::parseErrorCode($this->getResErrorCode()),
                PaymentItem::parseErrorCode($this->getResErrorCode())
            ];
        }

        return null;
    }

    /**
     * Get the value of transactionId
     */
    public function getTransactionId(): ?string
    {
        return $this->transactionId;
    }

    /**
     * Set the value of transactionId
     *
     * @return  self
     */
    public function setTransactionId($transactionId): Response
    {
        $this->transactionId = $transactionId;

        return $this;
    }

    /**
     * Get the value of trackingId
     */
    public function getTrackingId(): ?string
    {
        return $this->trackingId;
    }

    /**
     * Set the value of trackingId
     *
     * @return  self
     */
    public function setTrackingId($trackingId): Response
    {
        $this->trackingId = $trackingId;

        return $this;
    }

    /**
     * Get the value of paymentInfo
     */
    public function getPaymentInfo(): ?array
    {
        return $this->paymentInfo;
    }

    /**
     * Set the value of paymentInfo
     *
     * @return  self
     */
    public function setPaymentInfo($paymentInfo): Response
    {
        $this->paymentInfo = $paymentInfo;

        return $this;
    }
}
