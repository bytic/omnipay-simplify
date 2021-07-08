<?php

namespace Paytic\Omnipay\Simplify\Tests\Message;

use Omnipay\Common\Http\Client;
use Paytic\Omnipay\Simplify\Gateway;
use Paytic\Omnipay\Simplify\Message\CompletePurchaseRequest;
use Paytic\Omnipay\Simplify\Message\CompletePurchaseResponse;

/**
 * Class CompletePurchaseRequestTest
 * @package Paytic\Omnipay\Simplify\Tests\Message
 */
class CompletePurchaseRequestTest extends AbstractRequestTest
{
    public function test_basic()
    {
        /** @var Client $client */
        $client = $this->getHttpClient();

        $http_request = $this->generateRequestFromFixtures(TEST_FIXTURE_PATH . '/requests/complete_purchase/basic.php');

        $parameters = [
            'apiPassword' => getenv('SIMPLIFY_API_PASSWORD'),
            'merchant' => getenv('SIMPLIFY_MERCHANT'),
            'orderId' => '999',
            'apiHost' => 'https://egenius.unicredit.ro',
            'apiVersion' => Gateway::DEFAULT_API_VERSION,
        ];

        $request = \Mockery::mock(CompletePurchaseRequest::class)->shouldAllowMockingProtectedMethods()->makePartial();
        $request->__construct($client, $http_request);
        $request->initialize($parameters);
        $request->shouldReceive('isValidTransaction')->once()->andReturnFalse();
        $request->shouldReceive('getResponseClass')->once()->andReturn(CompletePurchaseResponse::class);
        $response = $request->send();

        self::assertFalse($response->isPending());
        self::assertFalse($response->isRedirect());
        self::assertFalse($response->isCancelled());
        self::assertFalse($response->isSuccessful());

        $request = $this->getMockClient()->getLastRequest();
        self::assertSame('https://egenius.unicredit.ro/api/nvp/version/60', $request->getUri()->__toString());
    }

}