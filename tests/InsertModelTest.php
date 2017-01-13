<?php

$art = new \App\Models\Article;
var_dump($art); echo '<br>';
$art->title = 'New Title';
var_dump($art); echo '<br>';
$art->text = 'Some things were happen many times ago';
var_dump($art); echo '<br>';
if ($art->insert()) {
    echo 'Вставка состоялась';
};
echo '<br>';
var_dump($art);
