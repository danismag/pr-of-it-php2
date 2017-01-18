<?php

require __DIR__ . '/../../App/autoload.php';

if (isset($_GET['id'])) {

    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $article = \App\Models\Article::findById($id);

    if (!$article) {

        header('Location: /admin');
        exit;
    }

    $view = new \App\View;
    $view->article = $article;
    $view->display(__DIR__ . '/../../App/Templates/newArticle.php');

} else {

    header('Location: /admin');
    exit;
}
