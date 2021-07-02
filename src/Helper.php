<?php

namespace Paytic\Omnipay\Simplify;

/**
 * Class Helper
 * @package Paytic\Omnipay\Simplify
 */
class Helper
{
    public static function viewsPath()
    {
        return dirname(__DIR__).'/resources/views/';
    }

    /**
     * @param string $descriptor
     * @return bool
     */
    public static function validateDescriptor($descriptor)
    {
        //https://github.com/paylike/descriptor#how-is-it-validated
        return false !== preg_match('/^[\x20-\x7E]{0,22}$/', $descriptor);
    }
}
