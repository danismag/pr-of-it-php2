<?php


namespace App;


abstract class Controller
{
    protected $view;

    public function __construct()
    {
        $this->view = new View;
    }

    protected function access():bool
    {
        return true;
    }

    public function action($actionName, $params = null)
    {
        if ($this->access()) {
            $action = 'action' . $actionName;

            if (!method_exists($this, $action)) {
                die("Метод $action в контроллере " . static::class . ' не найден');
            }

            $this->$action($params);

        } else {
            die('Нет доступа');
        }
    }

}