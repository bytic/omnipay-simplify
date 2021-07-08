<?php

namespace Paytic\Omnipay\Simplify\Tests\Message;

use Paytic\Omnipay\Simplify\Message\AbstractRequest;
use Paytic\Omnipay\Simplify\Tests\AbstractTest;
use Guzzle\Http\Client as HttpClient;
use Omnipay\Common\Message\AbstractResponse;
use Symfony\Component\HttpFoundation\Request as HttpRequest;

/**
 * Class AbstractResponseTest
 * @package Paytic\Omnipay\Simplify\Tests\Message
 */
abstract class AbstractResponseTest extends AbstractTest
{
    /**
     * @param string $class Request Class
     * @param array $data
     * @return AbstractResponse|\Omnipay\Common\Message\ResponseInterface
     */
    protected function newResponse($class, $data = [])
    {
        $client = $this->getHttpClient();
        $request = HttpRequest::createFromGlobals();
        /** @var AbstractRequest $request */
        $request = new $class($client, $request);
        if ($request->sendData($data)) {
            return $request->getResponse();
        }
        return null;
    }
}
