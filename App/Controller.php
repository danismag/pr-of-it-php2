<?php


namespace App;


use App\Exceptions\AccessDeniedException;
use App\Exceptions\NotFoundException;

abstract class Controller
{
    protected $view;
    private $method;

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
            $this->method = $actionName;

            if (!method_exists($this, $action)) {
                throw new NotFoundException("Метод $action в контроллере " . static::class . ' не найден');
            }

            $this->$action($params);

        } else {
            throw new AccessDeniedException('Нет доступа');
        }
    }

    /**
     * Перредача шаблона во View
     * @param string $template
     */
    public function display($template = '')
    {
        if ('' !== $template) {
            if (file_exists(__DIR__ .'/Templates'. $template)) {
                return $this->view->display($template);
            }
        }

        $path = '/'. explode('\\', static::class)[2] .'/'. $this->method .'.html';

        if (file_exists(__DIR__ .'/Templates'. $path)) {
            return $this->view->display($path);
        }
    }

}