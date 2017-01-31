<?php


namespace App\Controllers;


use App\Controller, App\Models\Article;
use danismag\MultiException\MultiException;

class Admin extends Controller
{
    /**
     * Вывод главной страницы редактирования
     */
    public function actionDefault()
    {
        $this->view->news = Article::findAll();
        $this->view->display(__DIR__ . '/../Templates/editPage.php');
    }

    /**
     * Вывод страницы редактирования новости
     * @param string $id
     */
    public function actionEdit($id)
    {
        $article = Article::findById($id);
        $this->view->article = $article;
        $this->view->display(__DIR__ . '/../Templates/newArticle.php');
    }

    /**
     * Вывод страницы создания новости
     */
    public function actionNew()
    {
        $this->view->article = new Article;
        $this->view->display(__DIR__ . '/../Templates/newArticle.php');
    }

    /**
     * Сохранение новости
     * @param string | null $id
     */
    public function actionSave($id = null)
    {
        if ($id) {
            $article = Article::findById($id);
        } else {
            $article = new Article;
        }
        try {
            $article->fill($_POST['article']);
            $article->save();

            header('Location: /admin/default');
            exit;

        } catch (MultiException $e) {

            $this->view->errors = $e;
            $this->view->article = $article;
            $this->view->display(__DIR__ . '/../Templates/newArticle.php');
        }
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