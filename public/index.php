<?php

require __DIR__ . '/../App/autoload.php';

/*$lastNews = \App\Models\Article::getLast(3);
include __DIR__ . "/../App/templates/mainPage.php";*/

$config = \App\Config::instance();
var_dump($config->data['db']['host']);