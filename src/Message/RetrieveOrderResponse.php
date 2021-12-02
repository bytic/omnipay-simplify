<?php

namespace Paytic\Omnipay\Simplify\Message;

/**
 * Class RetrieveOrderResponse
 * @package Paytic\Omnipay\Simplify\Message
 */
class RetrieveOrderResponse extends AbstractResponse
{
    public function isSuccessful(): bool
    {
        if ($this->getDataProperty('result') === "SUCCESS"
            && $this->getDataProperty('status') === "CAPTURED"
            && $this->getDataProperty('totalCapturedAmount') === $this->getDataProperty('amount')
            && $this->getDataProperty('totalRefundedAmount') === "0.00") {
            return true;
        }

        return parent::isSuccessful();
    }

    /**
     * @inheritDoc
     */
    public function getTransactionId()
    {
        return $this->getDataProperty('id');
    }
}
