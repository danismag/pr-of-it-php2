<?php


namespace App\Controllers;


use App\Controller, App\Models\Article, App\Exceptions\NotFoundException;

class Index extends Controller
{
    protected function actionDefault()
    {
        $this->view->lastNews = Article::getLast();
        $this->display();
    }

    protected function actionOne($id = null)
    {
        $article = Article::findById($id);
        if (null === $article) {
            throw new NotFoundException("Запись c id = $id не найдена!");
        }
        $this->view->article = $article;
        $this->display();
    }

    protected function action404($message = 'Страница не найдена')
    {
        header('Not Found', true, 404);
        $this->view->message = $message;
        $this->display('/Index/Error.html');
    }

    protected function action403($message = 'Доступ закрыт')
    {
        header('Access Denied', true, 403);
        $this->view->message = $message;
        $this->display('/Index/Error.html');
    }

    protected function actionError($message = 'Ошибка приложения')
    {
        $this->view->message = $message;
        $this->display();
    }

}