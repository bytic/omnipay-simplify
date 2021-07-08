<?php

namespace Paytic\Omnipay\Simplify\Traits;

use Omnipay\Common\Message\AbstractRequest as CommonAbstractRequest;

/**
 * Trait HasAuthParamsTrait
 * @package Paytic\Omnipay\SimplifyTraits
 */
trait HasAuthParamsTrait
{
    /**
     * @return mixed
     */
    public function getApiPassword()
    {
        return $this->getParameter('apiPassword');
    }

    /**
     * @param $value
     * @return CommonAbstractRequest
     */
    public function setApiPassword($value)
    {
        return $this->setParameter('apiPassword', $value);
    }

    /**
     * @return mixed
     */
    public function getMerchant()
    {
        return $this->getParameter('merchant');
    }

    /**
     * @param $value
     * @return CommonAbstractRequest
     */
    public function setMerchant($value)
    {
        return $this->setParameter('merchant', $value);
    }

    /**
     * @return mixed
     */
    public function getMerchantName()
    {
        return $this->getParameter('merchant_name');
    }

    /**
     * @param $value
     * @return CommonAbstractRequest
     */
    public function setMerchantName($value)
    {
        return $this->setParameter('merchant_name', $value);
    }
}
