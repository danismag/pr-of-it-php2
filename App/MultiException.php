<?php


namespace App;


class MultiException
    extends \Exception
    implements \Iterator
{
    protected $data = [];

    public function add(\Exception $e)
    {
        $this->data[] = $e;
    }

    public function isEmpty()
    {
        return 0 == count($this->data);
    }

    /**
     * Реализация интерфейса Iterator
     */
    public function current()
    {
        return current($this->data);
    }

    public function next()
    {
        next($this->data);
    }

    public function key()
    {
        return key($this->data);
    }

    public function valid()
    {
        return null !== key($this->data);
    }

    public function rewind()
    {
        reset($this->data);
    }
}