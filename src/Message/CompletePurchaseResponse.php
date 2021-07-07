<?php

namespace Paytic\Omnipay\Simplify\Message;

use ByTIC\Omnipay\Common\Message\Traits\GatewayNotificationResponseTrait;
use ByTIC\Omnipay\Common\Message\Traits\HtmlResponses\ConfirmHtmlTrait;

/**
 * Class CompletePurchaseResponse
 * @package Paytic\Omnipay\Simplify\Message
 */
class CompletePurchaseResponse extends AbstractResponse
{
    use ConfirmHtmlTrait;
    use GatewayNotificationResponseTrait;

    /**
     * Response Message
     *
     * @return null|string A response message from the payment gateway
     */
    public function getMessage()
    {
        if (!$this->isSuccessful()) {
            return 'Error authorising payment';
        }

        return parent::getMessage();
    }
}
