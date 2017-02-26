<?php


namespace App\Controllers;

use App\Controller, App\Models\Article;
use App\MultiException, App\Exceptions\NotFoundException;

class Admin extends Controller
{
    /**
     * Вывод главной страницы редактирования
     */
    protected function actionDefault()
    {
        $this->view->adminNews = Article::findAll();
        $this->view->display('/Admin/Default.html');
    }

    /**
     * Вывод страницы редактирования новости
     * @param string $id
     * @throws \App\Exceptions\NotFoundException
     */
    protected function actionEdit($id)
    {
        $article = Article::findById($id);
        if (null === $article) {
            throw new NotFoundException("Запись c id = $id не найдена!");
        }
        $this->view->article = $article;
        $this->view->display('/Admin/Edit.html');
    }

    /**
     * Вывод страницы создания новости
     */
    protected function actionNew()
    {
        $this->view->article = new Article;
        $this->view->display('/Admin/Edit.html');
    }

    /**
     * Сохранение новости
     * @param string | null $id
     * @throws \App\Exceptions\NotFoundException
     */
    protected function actionSave($id = null)
    {
        if ($id) {
            $article = Article::findById($id);
            if (null === $article) {
                throw new NotFoundException("Запись c id = $id не найдена!");
            }
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
            $this->view->display(__DIR__ . '/../Templates/Admin/Edit.html');
        }
    }

    /**
     * @param $id
     * @throws \App\Exceptions\NotFoundException
     */
    protected function actionDelete($id)
    {
        $article = Article::findById($id);
        if (null === $article) {
            throw new NotFoundException("Запись c id = $id не найдена!");
        }
        if ($article) {
            $article->delete();
        }

        header('Location: /admin/default');
        exit;
    }
}