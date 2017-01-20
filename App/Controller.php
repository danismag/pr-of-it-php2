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

    public function action($actionName)
    {
        if ($this->access()) {
            $action = 'action' . $actionName;
            $this->$action;
        } else {
            die('Нет доступа');
        }

    }

}