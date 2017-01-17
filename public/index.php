<?php

require __DIR__ . '/../App/autoload.php';

use App\View, App\Models\Article;

$view = new View;
$view->lastNews = Article::getLast(3);
$view->display(__DIR__ . '/../App/Templates/mainPage.php');
