<?php

require __DIR__ . '/../App/autoload.php';

use App\Models\Article, App\View;

$view = new View;

$article = Article::findById(filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT));

if (!$article) {
    echo 'Такой страницы не существует!';
    die;
}
$view->article = $article;
$view->display(__DIR__ . '/../App/Templates/articlePage.php');


