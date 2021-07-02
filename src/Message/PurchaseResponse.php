<?php

namespace Paytic\Omnipay\Simplify\Message;

use ByTIC\Omnipay\Common\Message\Traits\HasViewTrait;
use Paytic\Omnipay\Simplify\Helper;

/**
 * Class PurchaseResponse
 * @package Paytic\Omnipay\Simplify\Message
 */
class PurchaseResponse extends AbstractResponse
{
    use HasViewTrait;

    protected function initViewVars()
    {
        $data = $this->getData();
        $data['returnUrl'] .= strpos($data['returnUrl'], '?') === false ? $data['returnUrl'] . '?' : '';
        $this->getView()->with($data);
    }

    /**
     * @inheritDoc
     */
    protected function generateViewPath()
    {
        return Helper::viewsPath();
    }

    /**
     * @return string
     */
    protected function getViewFile()
    {
        return 'purchase';
    }
}
