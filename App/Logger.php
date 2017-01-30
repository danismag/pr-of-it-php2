<?php


namespace App;


class Logger
{
    protected const PATH = __DIR__ . '/../logs/log.txt';
    protected $file;


    public function __construct()
    {
        $this->file = fopen(self::PATH, 'a');
    }

    public function __destruct()
    {
        fclose($this->file);
    }

    public function addRecord(\Exception $e)
    {
        $str = date('Y-m-d H:m:s') . ' | Код ошибки ' .
            $e->getCode() . ' | ' .
            $e->getFile() . ' | Строка ' .
            $e->getLine() . ' | ' .
            $e->getMessage() . "\n";
        fwrite($this->file, $str);
    }

}