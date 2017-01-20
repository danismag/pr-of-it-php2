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
            if ($params) {
                $this->$action($params);
            } else {
                $this->$action();
            }

        } else {
            die('Нет доступа');
        }

    }

}