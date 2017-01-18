<?php

require __DIR__ . '/../../App/autoload.php';

$view = new \App\View;
$view->article = new \App\Models\Article;
$view->display(__DIR__ . '/../../App/Templates/newArticle.php');