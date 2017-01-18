<?php

require __DIR__ . '/../../App/autoload.php';

if (isset($_POST['article']['id']))
$article = new \App\Models\Article;
$article->id = filter_var($_POST['article']['id'], FILTER_SANITIZE_NUMBER_INT);
$article->title = filter_var($_POST['article']['title'], FILTER_SANITIZE_STRING);
$article->text = filter_var($_POST['article']['text'], FILTER_SANITIZE_STRING);


header('Location: /admin');
exit;