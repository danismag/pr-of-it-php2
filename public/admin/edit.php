<?php

require __DIR__ . '/../../App/autoload.php';

$article = \App\Models\Article::findById($_GET['id']);

$view = new \App\View;
$view->article = $article;
$view->display(__DIR__ . '/../../App/Templates/newArticle.php');

