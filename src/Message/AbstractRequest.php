<?php

namespace Paytic\Omnipay\Simplify\Message;

use ByTIC\Omnipay\Common\Message\Traits\SendDataRequestTrait;
use Omnipay\Common\Message\AbstractRequest as CommonAbstractRequest;
use Paytic\Omnipay\Simplify\Traits\HasApiParamsTrait;
use Paytic\Omnipay\Simplify\Traits\HasAuthParamsTrait;

/**
 * Class AbstractRequest
 * @package Paytic\Omnipay\Simplify\Message
 */
abstract class AbstractRequest extends CommonAbstractRequest
{
    use SendDataRequestTrait;
    use HasApiParamsTrait;
    use HasAuthParamsTrait;

}
