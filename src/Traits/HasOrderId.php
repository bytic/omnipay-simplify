<?php

namespace Paytic\Omnipay\Simplify\Traits;

/**
 * Trait HasOrderId
 * @package Paytic\Omnipay\SimplifyTraits
 */
trait HasOrderId
{
    /**
     * @return mixed
     */
    public function getOrderId()
    {
        return $this->getParameter('orderId');
    }

    /**
     * @param $value
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function setOrderId($value)
    {
        return $this->setParameter('orderId', $value);
    }
}
