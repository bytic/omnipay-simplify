<?php

namespace Paytic\Omnipay\Simplify\Utility;

use Nip\Utility\Traits\SingletonTrait;

/**
 * Class SessionHandler
 * @package Paytic\Omnipay\Simplify\Utility
 */
class SessionData
{
    use SingletonTrait;

    public const DEFAULT_SESSION_KEY = 'flash-data';

    /**
     * @var null|[]
     */
    protected $data = null;

    public static function set($orderId, $data = [])
    {
        static::instance()->setData($orderId, $data);
    }

    public static function get($orderId, $default = null)
    {
        return static::instance()->getData($orderId, $default);
    }

    /**
     * @param $orderId
     * @param $key
     * @param null $default
     * @return mixed|null
     */
    public static function value($orderId, $key, $default = null)
    {
        return static::instance()->getDataValue($orderId, $key, $default);
    }

    /**
     * @param $orderId
     * @param array $data
     */
    protected function setData($orderId, $data = [])
    {
        $this->checkStart();
        $this->data[$orderId] = $data;
    }

    /**
     * @param $orderId
     * @param array $data
     */
    protected function getData($orderId, $default = null)
    {
        $this->checkRead();
        return $this->data[$orderId] ?? $default;
    }

    /**
     * @param $orderId
     * @param array $data
     */
    protected function getDataValue($orderId, $key, $default = null)
    {
        $this->checkRead();
        return $this->data[$orderId][$key] ?? $default;
    }

    protected function checkRead()
    {
        if ($this->data === null) {
            $this->checkStart();
            $this->data = $_SESSION[self::DEFAULT_SESSION_KEY];
        }
    }

    protected function checkStart()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function __destruct()
    {
        $this->checkRead();
        $_SESSION[self::DEFAULT_SESSION_KEY] = $this->data;
    }
}
