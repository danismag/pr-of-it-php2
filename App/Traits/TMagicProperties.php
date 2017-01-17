<?php
/**
 * Created by PhpStorm.
 * User: danis
 * Date: 17.01.17
 * Time: 20:01
 */

namespace App\Traits;


trait TMagicProperties
{
    protected $data = [];

    public function __set($key, $value)
    {
        $this->data[$key] = $value;
    }

    public function __get($key)
    {
        return $this->data[$key];
    }

    public function __isset($key)
    {
        return isset($this->data[$key]);
    }

}