<?php


namespace App;


use App\Models\Article;
use App\Traits\TMagicProperties;

/**
 * Class View
 * @package App
 * @property Article article
 * @property array news
 * @property array lastNews
 * @property string message
 * @property array errors
 */
class View
    implements \Countable, \Iterator
{
    use TMagicProperties;

    /**
     * Подставляет в шаблон переданные данные и возвращает html
     * @param string $template
     * @return string
     */
    public function render($template)
    {
        foreach ($this->data as $key => $value) {
            $$key = $value;
        }
        ob_start();
        include $template;
        return ob_get_clean();
    }

    /**
     * Выводит на экран результат отрисовики шаблона
     * @param string $template
     */
    public function display($template)
    {
        echo $this->render($template);
    }

    /**
     * Реализация интерфейса Countable
     */
    public function count()
    {
        return count($this->data);
    }

    /**
     * Реализация интерфейса Iterator
     * Return the current element
     * @link http://php.net/manual/en/iterator.current.php
     * @return mixed Can return any type.
     * @since 5.0.0
     */
    public function current()
    {
        return current($this->data);
    }

    /**
     * Move forward to next element
     * @link http://php.net/manual/en/iterator.next.php
     * @return void Any returned value is ignored.
     * @since 5.0.0
     */
    public function next()
    {
        next($this->data);
    }

    /**
     * Return the key of the current element
     * @link http://php.net/manual/en/iterator.key.php
     * @return mixed scalar on success, or null on failure.
     * @since 5.0.0
     */
    public function key()
    {
        return key($this->data);
    }

    /**
     * Checks if current position is valid
     * @link http://php.net/manual/en/iterator.valid.php
     * @return boolean The return value will be casted to boolean and then evaluated.
     * Returns true on success or false on failure.
     * @since 5.0.0
     */
    public function valid()
    {
        return false !== current($this->data);
    }

    /**
     * Rewind the Iterator to the first element
     * @link http://php.net/manual/en/iterator.rewind.php
     * @return void Any returned value is ignored.
     * @since 5.0.0
     */
    public function rewind()
    {
        reset($this->data);
    }
}