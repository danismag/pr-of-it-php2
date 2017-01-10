<?php

require __DIR__ . '/autoload.php';

$data = \App\Models\Author::findAll();
var_dump($data);