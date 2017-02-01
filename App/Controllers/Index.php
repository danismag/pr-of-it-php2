<?php


namespace App\Controllers;


use App\Controller, App\Models\Article, App\Exceptions\NotFoundException;

class Index extends Controller
{
    public function actionDefault()
    {
        $this->view->lastNews = Article::getLast(3);
        $this->view->display(__DIR__ . '/../Templates/mainPage.php');
    }

    public function actionOne($id = null)
    {
        $article = Article::findById($id);
        if (null === $article) {
            throw new NotFoundException("Запись c id = $id не найдена!");
        }
        $this->view->article = $article;
        $this->view->display(__DIR__ . '/../Templates/articlePage.php');
    }

    public function actionError($message = 'Страница не найдена')
    {
        $this->view->message = $message;
        $this->view->display(__DIR__ . '/../Templates/errorPage.php');
    }

}