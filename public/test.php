<?php

use App\Db;

require __DIR__ . '/../App/autoload.php';

/*$db = new Db();
$sql = 'SELECT * FROM news WHERE id=:id';

var_dump(\App\Models\Article::findLast(-2)); die;

foreach ($db->queryEach($sql, ['id' => 40], \App\Models\Article::class) as $article) {

    var_dump($article);
}*/

$view = new \App\View;
$view->news = (new \App\AdminDataTable(\App\Models\Article::findAll()))->render();
$view->display('/Admin/Default.html');

