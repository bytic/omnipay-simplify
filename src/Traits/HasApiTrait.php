<?php

namespace Paytic\Omnipay\Simplify\Traits;

/**
 * Trait HasApiTrait
 * @package Paytic\Omnipay\Simplify\Traits
 *
 * @method string getPrivateKey
 */
trait HasApiTrait
{
    /**
     * @var string $checkoutJS URL of the sandbox API endpoint
     */
    public static $checkoutJS = 'https://egenius.unicredit.ro/checkout/version/60/checkout.js';

    /**
     * @var null|\Paylike\Paylike
     */
    protected $api = null;

    /**
     * @return \Paylike\Paylike
     */
    public function getApi()
    {
        if ($this->api == null) {
            $this->initApi();
        }
        return $this->api;
    }

    protected function initApi()
    {
        $this->api = $this->generateApi();
    }

    /**
     * @return \Paylike\Paylike
     * @throws \Paylike\Exception\ApiException
     */
    protected function generateApi()
    {
        return new \Paylike\Paylike($this->getPrivateKey());
    }
}
