<?php

require __DIR__ . '/../App/autoload.php';

$article = \App\Models\Article::findById((int)$_GET['id']);

if (!$article) {
    echo 'Такой страницы не существует!';
    die;
}

include __DIR__ . "/../App/templates/articlePage.php";