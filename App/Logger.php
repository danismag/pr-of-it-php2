<?php

namespace App;

use Psr\Log\AbstractLogger;

class Logger extends AbstractLogger
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

    /**
     * Logs with an arbitrary level.
     *
     * @param mixed $level
     * @param string $message
     * @param array $context
     *
     * @return void
     */
    public function log($level, $message, array $context = [])
    {
        $message = $this->format($message, $level);
        $this->write($message);
    }

    protected function format(\Exception $e, $level)
    {
        return date('Y-m-d H:m:s') . ' | Уровень ' .
            $level . ' | Код ошибки ' .
            $e->getCode() . ' | ' .
            $e->getFile() . ' | Строка ' .
            $e->getLine() . ' | ' .
            $e->getMessage() . "\n";
    }

    protected function write($message)
    {
        if (file_exists(self::PATH) &&
            is_writable(self::PATH)) {

            fwrite($this->file, $message);
        }
    }
}