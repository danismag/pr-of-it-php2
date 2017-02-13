<?php


namespace App\Controllers;


use App\AdminDataTable;
use App\Controller, App\Models\Article;
use App\MultiException, App\Exceptions\NotFoundException;

class Admin extends Controller
{
    /**
     * Вывод главной страницы редактирования
     */
    public function actionDefault()
    {
        $this->view->news = (new AdminDataTable(Article::findAll(), 'Article'))->renderRow();
        $this->display();
    }

    /**
     * Вывод страницы редактирования новости
     * @param string $id
     * @throws \App\Exceptions\NotFoundException
     */
    public function actionEdit($id)
    {
        $article = Article::findById($id);
        if (null === $article) {
            throw new NotFoundException("Запись c id = $id не найдена!");
        }
        $this->view->article = $article;
        $this->display();
    }

    /**
     * Вывод страницы создания новости
     */
    public function actionNew()
    {
        $this->view->article = new Article;
        $this->display('/Admin/Edit.html');
    }

    /**
     * Сохранение новости
     * @param string | null $id
     * @throws \App\Exceptions\NotFoundException
     */
    public function actionSave($id = null)
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
            $this->display('/Admin/Edit.html');
        }
    }

    /**
     * @param $id
     * @throws \App\Exceptions\NotFoundException
     */
    public function actionDelete($id)
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