<?php

namespace Paytic\Omnipay\Simplify\Message;

use ByTIC\Omnipay\Common\Message\Traits\GatewayNotificationRequestTrait;
use Paytic\Omnipay\Simplify\Traits\HasOrderId;
use Paytic\Omnipay\Simplify\Utility\SessionData;

/**
 * Class CompletePurchaseRequest
 * @package Paytic\Omnipay\Simplify\Message
 *
 * @method CompletePurchaseResponse send()
 */
class CompletePurchaseRequest extends AbstractRequest
{
    use GatewayNotificationRequestTrait;
    use HasOrderId;

    /**
     * @return mixed
     */
    public function isValidNotification()
    {
        return $this->hasGet('resultIndicator')
            && $this->hasGet('sessionVersion');
    }

    /**
     * @return bool|mixed
     */
    protected function parseNotification()
    {
        $this->validate(
            'apiPassword',
            'merchant',
            'orderId'
        );

        if ($this->isValidTransaction()) {
            return false;
        }
        $this->data['success'] = true;

        $transaction = $this->httpRequest->query->all();

        return $transaction;
    }

    /**
     * @return bool
     */
    protected function isValidTransaction()
    {
        $success_indicator = SessionData::value($this->getOrderId(),CreateCheckoutSessionResponse::SUCCESS_INDICATOR);
        $result_indicator = $this->httpRequest->query->get('resultIndicator');

        $is_valid = $success_indicator == $result_indicator;
        if ($is_valid) {
            $this->setDataItem('success', true);
        }

        return $is_valid;
    }
}
