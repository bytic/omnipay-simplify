<?php

namespace Paytic\Omnipay\Simplify\Message;

use Http\Client\Common\HttpMethodsClient;

/**
 * Class PurchaseRequest
 * @package Paytic\Omnipay\Simplify\Message
 *
 * @method CreateCheckoutSessionResponse send()
 */
class CreateCheckoutSessionRequest extends AbstractRequest
{

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
            'order.currency' => $this->getCurrency(),
            'interaction.operation' => 'PURCHASE',
            'interaction.returnUrl' => $this->getReturnUrl(),
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
        return $data;
    }

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
