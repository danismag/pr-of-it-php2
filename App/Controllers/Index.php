<?php


namespace App\Controllers;


use App\Controller, App\Models\Article, App\Exceptions\NotFoundException;

class Index extends Controller
{
    public function actionDefault()
    {
        $this->view->lastNews = Article::getLast();
        $this->display();
    }

    public function actionOne($id = null)
    {
        $article = Article::findById($id);
        if (null === $article) {
            throw new NotFoundException("Запись c id = $id не найдена!");
        }
        $this->view->article = $article;
        $this->display();
    }

    public function action404($message = 'Страница не найдена')
    {
        header('Not Found', true, 404);
        $this->view->message = $message;
        $this->display('/Index/Error.html');
    }

    public function action403($message = 'Доступ закрыт')
    {
        header('Access Denied', true, 403);
        $this->view->message = $message;
        $this->display('/Index/Error.html');
    }

    public function actionError($message = 'Ошибка приложения')
    {
        $this->view->message = $message;
        $this->display();
    }

}