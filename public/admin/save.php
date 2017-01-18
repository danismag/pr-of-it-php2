<?php

require __DIR__ . '/../../App/autoload.php';

use App\Models\Article;

if ($_POST['article']['id']) {

    $article = Article::findById($_POST['article']['id']);

} else {

    $article = new Article;
}

$article->title = $_POST['article']['title'];
$article->text = $_POST['article']['text'];

if ($_POST['article']['author']['firstName'] || $_POST['article']['author']['lastName']) {

    $author = new \App\Models\Author;
    $author->firstName = $_POST['article']['author']['firstName'];
    $author->lastName = $_POST['article']['author']['lastName'];
    $author->save();
    $article->author_id = $author->id;
}
$article->save();

header('Location: /admin');
exit;