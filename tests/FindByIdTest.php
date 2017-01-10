<?php

$id = 2;
echo "id = $id <br>";
$res = \App\Models\Article::findById($id);
var_dump($res);
echo '<br><br>';

$id = 10;
echo "id = $id <br>";
$res = \App\Models\Article::findById($id);
var_dump($res);
