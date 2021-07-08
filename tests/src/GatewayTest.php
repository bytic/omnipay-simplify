<?php

namespace Paytic\Omnipay\Simplify\Tests;

use Paytic\Omnipay\Simplify\Gateway;
use Paytic\Omnipay\Simplify\Message\PurchaseRequest;

/**
 * Class HelperTest
 * @package Paytic\Omnipay\Simplify\Tests
 */
class GatewayTest extends AbstractTest
{

    public function testPurchaseRequestEndpointUrl()
    {
        $gateway = new Gateway();

        $request = $gateway->purchase();
        self::assertInstanceOf(PurchaseRequest::class, $request);
    }
}
