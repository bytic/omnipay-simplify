<?php

namespace Paytic\Omnipay\Simplify\Tests\Message;

//use Paytic\Omnipay\Simplify\Tests\Traits\HasTestUtilMethods;
use Paytic\Omnipay\Simplify\Message\AbstractRequest;
use Paytic\Omnipay\Simplify\Tests\AbstractTest;
use Http\Mock\Client as MockClient;
use Omnipay\Common\Http\Client;
use Omnipay\Common\Http\ClientInterface;
use Symfony\Component\HttpFoundation\Request as HttpRequest;

/**
 * Class AbstractRequestTest
 * @package Paytic\Omnipay\Simplify\Tests\Message
 */
abstract class AbstractRequestTest extends AbstractTest
{
    /** @var ClientInterface */
    private $httpClient;

    /** @var  MockClient */
    private $mockClient;

    /**
     * @param string $class
     * @param array $data
     * @return AbstractRequest
     */
    protected function newRequestWithInitTest($class, $data)
    {
        $request = $this->newRequest($class);
        self::assertInstanceOf($class, $request);
        $request->initialize($data);
        return $request;
    }

    /**
     * @param string $class
     * @return AbstractRequest
     */
    protected function newRequest($class)
    {
        $client = $this->getHttpClient();
        $request = HttpRequest::createFromGlobals();
        $request = new $class($client, $request);
        return $request;
    }

    public function getHttpClient()
    {
        if (null === $this->httpClient) {
            $this->httpClient = new Client(
                $this->getMockClient()
            );
        }

        return $this->httpClient;
    }

    public function getMockClient()
    {
        if (null === $this->mockClient) {
            $this->mockClient = new MockClient();
        }

        return $this->mockClient;
    }
}
