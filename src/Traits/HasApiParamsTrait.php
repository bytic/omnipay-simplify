<?php

namespace Paytic\Omnipay\Simplify\Traits;

/**
 * Trait HasApiParamsTrait
 * @package Paytic\Omnipay\SimplifyTraits
 */
trait HasApiParamsTrait
{

    protected function getApiUrl($type = '', $path = '')
    {
        return $this->getApiHost()
            .'/'.$type
            .'/version/'
            .$this->getApiVersion()
            .''.$path;
    }

    /**
     * @return mixed
     */
    public function getApiHost()
    {
        return $this->getParameter('apiHost');
    }

    /**
     * @param $value
     * @return $this
     */
    public function setApiHost($value)
    {
        return $this->setParameter('apiHost', $value);
    }

    /**
     * @return mixed
     */
    public function getApiVersion()
    {
        return $this->getParameter('apiVersion');
    }

    /**
     * @param $value
     * @return $this
     */
    public function setApiVersion($value)
    {
        return $this->setParameter('apiVersion', $value);
    }
}