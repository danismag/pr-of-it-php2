<?php


namespace App\Controllers;


use App\Controller, App\Models\Article, App\Models\Author;

class Admin extends Controller
{
    public function actionDefault()
    {
        $this->view->news = Article::findAll();
        $this->view->display(__DIR__ . '/../Templates/editPage.php');
    }

    public function actionEdit($id)
    {
        $article = Article::findById($id);
        if (!$article) {
            die('Запрошенной страницы не существует');
        }

        $this->view->article = $article;
        $this->view->display(__DIR__ . '/../Templates/newArticle.php');
    }

    public function actionNew()
    {
        $this->view->article = new Article;
        $this->view->display(__DIR__ . '/../Templates/newArticle.php');
    }

    public function actionSave($id = null)
    {
        if ($id) {
            $article = Article::findById($id);
        } else {
            $article = new Article;
        }

        $article->fromArray($_POST['article']);
        var_dump($article);
    }

    public function actionDelete($id)
    {
        $article = Article::findById($id);
        if ($article) {
            $article->delete();
        }

        header('Location: /admin/default');
        exit;
    }
}