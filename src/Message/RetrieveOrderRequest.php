<?php

namespace Paytic\Omnipay\Simplify\Message;

use Paytic\Omnipay\Simplify\Traits\HasOrderId;

/**
 * Class RetrieveOrderRequest
 * @package Paytic\Omnipay\Simplify\Message
 *
 * @method RetrieveOrderResponse send()
 */
class RetrieveOrderRequest extends AbstractRequest
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
            'orderId'
        );

        $data = [
            'apiOperation' => 'RETRIEVE_ORDER',
            'apiPassword' => $this->getApiPassword(),
            'apiUsername' => 'merchant.'.$this->getMerchant(),
            'merchant' => $this->getMerchant(),
            'order.id' => $this->getOrderId(),
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

        return is_array($data) && count($data) ? $data : ['error' => true];
    }

}