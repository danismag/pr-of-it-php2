<?php


namespace App;

use App\Traits\TSingleton;

/**
 * Class Config
 * @package App
 */
class Config
{
    use TSingleton;

    const PATH = __DIR__ . '/config/config.php';

    public $data = [];

    protected function __construct()
    {
        $this->data = include self::PATH;
    }

}