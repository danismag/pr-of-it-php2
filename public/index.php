<?php

require __DIR__ . '/../App/autoload.php';

$parts = explode('/', $_SERVER['REQUEST_URI']);

$controllerName = $parts[1] ?: 'Index';
$actionName =     $parts[2] ?: 'Default';
$controllerClass = '\\App\\Controllers\\' . $controllerName;

if (!class_exists($controllerClass)) {
    die('Контроллер ' . $controllerClass . ' не найден');
}
$controller = new $controllerClass;
$controller->action($actionName);

/*use App\View, App\Models\Article;

$view = new View;
$view->lastNews = Article::getLast(3);
$view->display(__DIR__ . '/../App/Templates/mainPage.php');*/
