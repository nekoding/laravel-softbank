<?php

namespace Nekoding\LaravelSoftbank\PaymentMethod\CreditCard;

use Exception;
use Nekoding\LaravelSoftbank\Contract\PaymentInfo;
use Symfony\Component\Serializer\Annotation\SerializedName;
use Symfony\Component\Serializer\Annotation\Ignore;


class CreditCardPayload implements PaymentInfo
{

    /**
     * @SerializedName("token")
     */
    protected $token;

    /**
     * @SerializedName("token_key")
     */
    protected $tokenKey;

    /**
     * @SerializedName("cust_manage_flg")
     */
    protected $customerManageFlag;

    /**
     * @SerializedName("cardbrand_return_flg")
     */
    protected $cardBrandReturnFlag;

    /**
     * @SerializedName("cc_number")
     */
    protected $ccNumber;

    /**
     * @SerializedName("cc_expiration")
     */
    protected $ccExpiration;

    /**
     * @SerializedName("security_code")
     */
    protected $ccSecurityCode;


    public function __construct(...$data)
    {

        if (is_array($data)) {
            foreach ($data as $key => $value) {
                switch ($key) {
                    case 'token':
                        $this->setToken($value);
                        break;
                    
                    case 'token_key':
                        $this->setTokenKey($value);
                        break;    

                    case 'cust_manage_flg':
                        $this->setCustomerManageFlag($value);
                        break;

                    case 'cardbrand_return_flg':
                        $this->setCardBrandReturnFlag($value);
                        break;

                    case 'cc_number':
                        $this->setCcNumber($value);
                        break;

                    case 'cc_expiration':
                        $this->setCcExpiration($value);
                        break;

                    case 'security_code':
                        $this->setCcSecurityCode($value);
                        break;
                    
                    default:
                        break;
                }
            }
        }

    }

    
    // Getter and setter

    /**
     * Get the value of token
     */ 
    public function getToken()
    {
        return $this->token;
    }

    /**
     * Set the value of token
     *
     * @return  self
     */ 
    public function setToken($token)
    {
        $this->token = mb_convert_encoding($token, 'Shift_JIS', 'UTF-8');

        return $this;
    }

    /**
     * Get the value of tokenKey
     */ 
    public function getTokenKey()
    {
        return $this->tokenKey;
    }

    /**
     * Set the value of tokenKey
     *
     * @return  self
     */ 
    public function setTokenKey($tokenKey)
    {
        $this->tokenKey = mb_convert_encoding($tokenKey, 'Shift_JIS', 'UTF-8');

        return $this;
    }

    /**
     * Get the value of customerManageFlag
     */ 
    public function getCustomerManageFlag()
    {
        return $this->customerManageFlag;
    }

    /**
     * Set the value of customerManageFlag
     *
     * @return  self
     */ 
    public function setCustomerManageFlag($customerManageFlag)
    {
        $this->customerManageFlag = mb_convert_encoding($customerManageFlag, 'Shift_JIS', 'UTF-8');

        return $this;
    }

    /**
     * Get the value of cardBrandReturnFlag
     */ 
    public function getCardBrandReturnFlag()
    {
        return $this->cardBrandReturnFlag;
    }

    /**
     * Set the value of cardBrandReturnFlag
     *
     * @return  self
     */ 
    public function setCardBrandReturnFlag($cardBrandReturnFlag)
    {
        $this->cardBrandReturnFlag = mb_convert_encoding($cardBrandReturnFlag, 'Shift_JIS', 'UTF-8');

        return $this;
    }

    /**
     * Get the value of ccNumber
     */ 
    public function getCcNumber()
    {
        return $this->ccNumber;
    }

    /**
     * Set the value of ccNumber
     *
     * @return  self
     */ 
    public function setCcNumber($ccNumber)
    {
        $this->ccNumber = mb_convert_encoding($ccNumber, 'Shift_JIS', 'UTF-8');

        return $this;
    }

    /**
     * Get the value of ccExpiration
     */ 
    public function getCcExpiration()
    {
        return $this->ccExpiration;
    }

    /**
     * Set the value of ccExpiration
     *
     * @return  self
     */ 
    public function setCcExpiration($ccExpiration)
    {
        $this->ccExpiration =mb_convert_encoding($ccExpiration, 'Shift_JIS', 'UTF-8');

        return $this;
    }

    /**
     * Get the value of ccSecurityCode
     */ 
    public function getCcSecurityCode()
    {
        return $this->ccSecurityCode;
    }

    /**
     * Set the value of ccSecurityCode
     *
     * @return  self
     */ 
    public function setCcSecurityCode($ccSecurityCode)
    {
        $this->ccSecurityCode = mb_convert_encoding($ccSecurityCode, 'Shift_JIS', 'UTF-8');

        return $this;
    }

    /**
     * Get the value of ccSecurityCode
     * @Ignore
     */ 
    public function getPaymentInfo(): string
    {

        if ($this->token) {
            return $this->token;
        }

        if (is_null($this->token) && $this->ccNumber && $this->ccExpiration && $this->ccSecurityCode) {
            return $this->getCcNumber() . $this->getCcExpiration() . $this->getCcSecurityCode();
        } 

        throw new Exception("payment info not setted");
    }
}