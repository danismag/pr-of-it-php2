<?php

require __DIR__ . '/../App/autoload.php';

// Тестирование метода execute класса Db
//include_once __DIR__ . '/../tests/dbTest.php';

// Тестирование метода findById класса Model
//include_once __DIR__ . '/../tests/findByIdTest.php';

// Тестирование метода getLast класса Article
//include_once __DIR__ . '/../tests/getLastTest.php';

$lastNews = \App\Models\Article::getLast(3);
include __DIR__ . "/../App/templates/mainPage.php";