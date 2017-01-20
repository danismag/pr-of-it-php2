<?php


namespace App\Controllers;


use App\Controller, App\Models\Article;

class Index extends Controller
{
    public function actionDefault()
    {
        $this->view->lastNews = Article::getLast(3);
        $this->view->display(__DIR__ . '/../Templates/mainPage.php');
    }

    public function actionOne($id)
    {
        $article = Article::findById($id);
        if (!$article) {
            die('Запрошенной страницы не существует');
        }

        $this->view->article = $article;
        $this->view->display(__DIR__ . '/../Templates/articlePage.php');
    }

}