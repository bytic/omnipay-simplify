<?php

namespace Paytic\Omnipay\Simplify;

use Paytic\Omnipay\Simplify\Message\CaptureRequest;
use Paytic\Omnipay\Simplify\Message\CompletePurchaseRequest;
use Paytic\Omnipay\Simplify\Message\CreateCheckoutSessionRequest;
use Paytic\Omnipay\Simplify\Message\PurchaseRequest;
//use Paytic\Omnipay\Paylike\Message\ServerCompletePurchaseRequest;
use Paytic\Omnipay\Simplify\Message\RetrieveOrderRequest;
use Paytic\Omnipay\Simplify\Traits\HasApiParamsTrait;
use Paytic\Omnipay\Simplify\Traits\HasAuthParamsTrait;
use Omnipay\Common\AbstractGateway;
use Omnipay\Common\Message\NotificationInterface;
use Omnipay\Common\Message\RequestInterface;

/**
 * Class Gateway
 * @package Paytic\Omnipay\Simplify
 *
 * @method RequestInterface authorize(array $options = [])
 * @method RequestInterface completeAuthorize(array $options = [])
 * @method RequestInterface refund(array $options = [])
 * @method RequestInterface void(array $options = [])
 * @method RequestInterface createCard(array $options = [])
 * @method RequestInterface updateCard(array $options = [])
 * @method RequestInterface deleteCard(array $options = [])
 * @method RequestInterface fetchTransaction(array $options = [])
 * @method NotificationInterface acceptNotification(array $options = array())
 */
class Gateway extends AbstractGateway
{
    use HasApiParamsTrait;
    use HasAuthParamsTrait;

    public const VERSION = '1.0';

    public const DEFAULT_API_VERSION = '60';

    /**
     * @inheritdoc
     */
    public function getName()
    {
        return 'Simplify';
    }

    // ------------ PARAMETERS ------------ //

    /** @noinspection PhpMissingParentCallCommonInspection
     *
     * {@inheritdoc}
     */
    public function getDefaultParameters()
    {
        return [
            'testMode' => true, // Must be the 1st in the list!
            'apiPassword' => $this->getApiPassword(),
            'merchant' => $this->getMerchant(),
            'merchant_name' => $this->getMerchantName(),
            'apiHost' => 'https://egenius.unicredit.ro',
            'apiVersion' => self::DEFAULT_API_VERSION,
        ];
    }

    // ------------ REQUESTS ------------ //

    /**
     * @inheritdoc
     * @return PurchaseRequest
     */
    public function purchase(array $parameters = []): RequestInterface
    {
        return $this->createRequest(
            PurchaseRequest::class,
            array_merge($this->getDefaultParameters(), $parameters)
        );
    }

    /**
     * @inheritdoc
     * @return CreateCheckoutSessionRequest
     */
    public function createCheckoutSession(array $parameters = []): RequestInterface
    {
        return $this->createRequest(
            CreateCheckoutSessionRequest::class,
            array_merge($this->getDefaultParameters(), $parameters)
        );
    }

    /**
     * @inheritdoc
     * @return CompletePurchaseRequest
     */
    public function completePurchase(array $parameters = []): RequestInterface
    {
        return $this->createRequest(
            CompletePurchaseRequest::class,
            array_merge($this->getDefaultParameters(), $parameters)
        );
    }

    /**
     * @inheritdoc
     * @return RetrieveOrderRequest
     */
    public function retrieveOrder(array $parameters = []): RequestInterface
    {
        return $this->createRequest(
            RetrieveOrderRequest::class,
            array_merge($this->getDefaultParameters(), $parameters)
        );
    }

    /**
     * @inheritdoc
     */
//    public function serverCompletePurchase(array $parameters = []): RequestInterface
//    {
//        return $this->createRequest(
//            ServerCompletePurchaseRequest::class,
//            array_merge($this->getDefaultParameters(), $parameters)
//        );
//    }
}
