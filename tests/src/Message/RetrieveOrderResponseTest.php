<?php

namespace Paytic\Omnipay\Simplify\Tests\Message;

use Paytic\Omnipay\Simplify\Message\RetrieveOrderRequest;
use Paytic\Omnipay\Simplify\Message\RetrieveOrderResponse;
use Symfony\Component\HttpFoundation\Request as HttpRequest;

/**
 * Class RetrieveOrderResponseTest
 * @package Paytic\Omnipay\Simplify\Tests\Message
 */
class RetrieveOrderResponseTest extends AbstractResponseTest
{
    public function test_basic()
    {
        $request = new RetrieveOrderRequest($this->getHttpClient(), HttpRequest::createFromGlobals());
        $data = require TEST_FIXTURE_PATH . '/responses/retrieve_order/basic_response.php';
        $response = new RetrieveOrderResponse($request, $data);

        self::assertFalse($response->isPending());
        self::assertFalse($response->isRedirect());
        self::assertFalse($response->isCancelled());
        self::assertTrue($response->isSuccessful());

        self::assertSame('1625688049', $response->getTransactionId());
    }
}