<?php


namespace App\Controllers;


use App\Controller,App\Exceptions\NotFoundException;

class Index extends Controller
{
    protected function actionDefault()
    {

    }

    protected function actionOne($id = null)
    {

    }

    protected function action404($message = 'Страница не найдена')
    {
        header("Not Found", true, 404);
        $this->view->message = $message;
    }

    protected function action403($message = 'Доступ закрыт')
    {
        header("Access Denied", true, 403);
        $this->view->message = $message;
    }

    protected function actionError($message = 'Ошибка приложения')
    {
        $this->view->message = $message;
    }

}