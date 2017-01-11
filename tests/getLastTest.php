<?php

$num = 2;
echo "число записей = $num <br>";
$res = \App\Models\Article::getLast($num);
var_dump($res);
echo '<br><br>';

$num = 3;
echo "число записей = $num <br>";
$res = \App\Models\Article::getLast($num);
var_dump($res);
