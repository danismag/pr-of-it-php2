<?php


namespace App;


use App\Exceptions\AccessDeniedException;
use App\Exceptions\NotFoundException;

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
                throw new NotFoundException("Метод $action в контроллере " . static::class . ' не найден');
            }

            $this->$action($params);

        } else {
            throw new AccessDeniedException('Нет доступа');
        }
    }

}