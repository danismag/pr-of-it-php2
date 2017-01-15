<?php

require __DIR__ . '/../App/autoload.php';

use App\Models\Article;

if (isset($_GET['action'])) {

    switch ($_GET['action']) {
        case 'view':
            $article = \App\Models\Article::findById((int)$_GET['id']);

            if (!$article) {
                echo 'Такой страницы не существует!';
                die;
            }

            include __DIR__ . "/../App/templates/articlePage.php";
            break;

        case 'new':

            $title = '';
            $text = '';

            if (isset($_POST['title']) && isset($_POST['text'])) {
                $title = filter_var($_POST['title'], FILTER_SANITIZE_STRING);
                $text = filter_var($_POST['text'], FILTER_SANITIZE_STRING);
                if ($title && $text) {
                    $article = new Article;
                    $article->title = $title;
                    $article->text = $text;
                    $article->save();
                    echo 'Новость сохранена!';
                } else {
                    echo 'Введите верные данные';
                }
            }

            include __DIR__ . "/../App/templates/newPage.php";

            break;

        case 'edit':

            if (isset($_GET['id'])) {

                $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
                $article = Article::findById($id);
                if (!$article) {
                    echo 'Запрашиваемой страницы не существует';
                    die;
                }
                include __DIR__ . "/../App/templates/editPage.php";

            } elseif (isset($_POST['id']) &&
                isset($_POST['title']) && isset($_POST['text'])){

                $title = filter_var($_POST['title'], FILTER_SANITIZE_STRING);
                $text = filter_var($_POST['text'], FILTER_SANITIZE_STRING);
                $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);

                if ($id && $title && $text) {

                    $article = Article::findById($id);
                    $article->title = $title;
                    $article->text = $text;
                    $article->save();
                    echo 'Новость сохранена!';
                }

                $news = Article::findAll();
                include __DIR__ . "/../App/templates/editAllPage.php";

            } else {

                $news = Article::findAll();
                include __DIR__ . "/../App/templates/editAllPage.php";
            }

            break;

        case 'delete':

            if (isset($_GET['id'])) {

                $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
                $article = Article::findById($id);
                if (!$article) {
                    echo 'Запрашиваемой новости не существует';
                    break;
                }
                $article->delete();
                echo 'Новость успешно удалена!';
            }

            $news = Article::findAll();
            include __DIR__ . "/../App/templates/deleteAllPage.php";

            break;
    }
}
