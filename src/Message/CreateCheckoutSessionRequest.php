<?php

namespace Paytic\Omnipay\Simplify\Message;

use Http\Client\Common\HttpMethodsClient;
use Paytic\Omnipay\Simplify\Traits\HasOrderId;
use Paytic\Omnipay\Simplify\Utility\SessionData;

/**
 * Class PurchaseRequest
 * @package Paytic\Omnipay\Simplify\Message
 *
 * @method CreateCheckoutSessionResponse send()
 */
class CreateCheckoutSessionRequest extends AbstractRequest
{
    use HasOrderId;

    /**
     * @return array
     * @throws \Omnipay\Common\Exception\InvalidRequestException
     */
    public function getData()
    {
        $this->validate(
            'apiPassword',
            'merchant',
            'amount',
            'currency',
            'orderId'
        );
        $data = [
            'apiOperation' => 'CREATE_CHECKOUT_SESSION',
            'apiPassword' => $this->getApiPassword(),
            'apiUsername' => 'merchant.'.$this->getMerchant(),
            'merchant' => $this->getMerchant(),
            'order.id' => $this->getOrderId(),
            'order.amount' => $this->getAmount(),
            'order.notificationUrl' => $this->getNotifyUrl(),
            'order.currency' => $this->getCurrency(),
            'interaction.operation' => 'PURCHASE',
            'interaction.returnUrl' => $this->getReturnUrl(),
            'interaction.cancelUrl' => $this->getReturnUrl(),
            'interaction.timeoutUrl' => $this->getReturnUrl(),
        ];

        /** @var \Psr\Http\Message\ResponseInterface $response */
        $response = $this->httpClient->request(
            'POST',
            $this->getApiUrl('api/nvp'),
            [
                'Content-Type' => 'application/x-www-form-urlencoded',
            ],
            http_build_query($data)
        );

        $data_raw = $response->getBody(true);
        parse_str($data_raw, $data);

        SessionData::set($this->getOrderId(), $data);
        return $data;
    }
}
