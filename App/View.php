<?php


namespace App;


use App\Traits\TMagicProperties;

class View
    implements \Countable
{
    use TMagicProperties;


    /**
     * Count elements of an object
     * @return int The custom count as an integer
     */
    public function count()
    {
        return count($this->data);
    }

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
}