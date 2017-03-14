<?php


namespace App;


use App\Exceptions\AccessDeniedException;
use App\Exceptions\NotFoundException;

/**
 * Class Controller
 * @package App
 * @property \App\View $view
 */
abstract class Controller
{
    protected $view;
    private $method;

    public function __construct()
    {
        $this->view = new View;
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
            $this->afterAction();

        } else {
            throw new AccessDeniedException('Нет доступа');
        }
    }

    public function redirect($url = '/')
    {
        header('Location: ' . $url, true, 302);
        exit;
    }

    /**
     * Перредача шаблона во View
     * @param string $template
     */
    protected function transferTemplateToView($template = '')
    {
        if ('' !== $template) {
            if (file_exists(__DIR__ .'/Templates'. $template)) {
                return $this->view->display($template);
            }
        }

        $path = '/' . explode('\\', static::class)[2] .
            '/' . $this->method . '.html';

        if (file_exists(__DIR__ .'/Templates'. $path)) {
            return $this->view->display($path);
        }
    }

    protected function afterAction()
    {
        $this->transferTemplateToView();
    }

    protected function access():bool
    {
        return true;
    }

}