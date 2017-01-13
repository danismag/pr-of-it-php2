<?php

namespace App\Traits;


trait TSingleton
{
    protected static $instance;

    protected function __construct()
    {

    }

    public static function instance()
    {
        if (null === self::$instance) {
            return self::$instance = new self;
        }
        return self::$instance;
    }
}