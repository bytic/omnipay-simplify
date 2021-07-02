<?php

namespace Paytic\Omnipay\Simplify\Message;


/**
 * Class PurchaseRequest
 * @package Paytic\Omnipay\Simplify\Message
 *
 * @method PurchaseResponse send()
 */
class PurchaseRequest extends AbstractRequest
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
            'merchant_name',
            'amount',
            'currency',
            'description',
            'orderId',
            'returnUrl',
            'card'
        );

        $data = [
            'session_id' => $this->createSessionId(),
            'merchant_name' => $this->getMerchantName(),
            'orderId' => $this->getOrderId(),
            'amount' => $this->getAmount(),
            'currency' => $this->getCurrency(),
            'description' => $this->getDescription(),
            'clientIp' => $this->getClientIp(),
            'apiJsUrl' => $this->getApiUrl('checkout', '/checkout.js'),
        ];

        $card = $this->getCard();

        $data['firstName'] = $card->getBillingFirstName();
        $data['lastName'] = $card->getBillingLastName();
        $data['street1'] = $card->getBillingAddress1();
        $data['street2'] = $card->getBillingAddress2();
        $data['city'] = $card->getBillingCity();
        $data['country'] = $card->getBillingCountry();
        $data['phone'] = $card->getBillingPhone();
        $data['email'] = $card->getEmail();

        return $data;
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
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function setMerchantName($value)
    {
        return $this->setParameter('merchant_name', $value);
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

    /**
     * @param array $parameters
     * @return string
     */
    protected function createSessionId(array $parameters = [])
    {
        $request = new CreateCheckoutSessionRequest($this->httpClient, $this->httpRequest);
        $request->initialize(array_replace($this->getParameters(), $parameters));
        $response = $request->send();
        if ($response->isSuccessful() === false) {
            throw new \Exception($response->getMessage());
        }
        return $response->getSessionId();
    }
}
