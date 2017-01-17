<?php

require __DIR__ . '/../App/autoload.php';

$lastNews = \App\Models\Article::getLast(3);
include __DIR__ . "/../App/Templates/mainPage.php";
