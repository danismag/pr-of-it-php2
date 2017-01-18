<?php

require __DIR__ . '/../../App/autoload.php';

$view = new \App\View;
$view->news = \App\Models\Article::findAll();
$view->display(__DIR__ . '/../../App/Templates/editPage.php');
