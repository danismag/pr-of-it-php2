<?php

require __DIR__ . '/../App/autoload.php';

use App\Models\Article;


$article = Article::findById(filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT));

if (!$article) {
    echo 'Такой страницы не существует!';
    die;
}

include __DIR__ . "/../App/templates/articlePage.php";


