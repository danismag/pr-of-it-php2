<?php

require __DIR__ . '/../App/autoload.php';


use App\Models\Article;

if (isset($_GET['action'])) {

    switch ($_GET['action']) {

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
                    break;

                } else {

                    echo 'Введите верные данные';
                }
            }

            include __DIR__ . "/../App/templates/newPage.php";
            return;

            break;

        case 'edit':

            if (isset($_GET['id'])) {

                $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
                $article = Article::findById($id);

                if (!$article) {
                    echo 'Запрашиваемой страницы не существует';
                    break;
                }

                include __DIR__ . "/../App/templates/editPage.php";
                return;

            } elseif (isset($_POST['id']) &&
                isset($_POST['title']) && isset($_POST['text'])) {

                $title = filter_var($_POST['title'], FILTER_SANITIZE_STRING);
                $text = filter_var($_POST['text'], FILTER_SANITIZE_STRING);
                $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);

                if ($id && $title && $text) {

                    $article = Article::findById($id);
                    $article->title = $title;
                    $article->text = $text;
                    $article->save();

                    echo 'Новость сохранена!';

                } else {

                    echo 'Ошибка редактирования!';
                }
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

            break;
    }
}

$news = Article::findAll();
include __DIR__ . "/../App/templates/editAllPage.php";
