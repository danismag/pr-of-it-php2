<?php

require __DIR__ . '/../App/autoload.php';

$parts = explode('/', $_SERVER['REQUEST_URI']);

$controllerName = ucfirst($parts[1] ?: 'Index');
$actionName = ucfirst($parts[2] ?? 'Default');
$params = $parts[3] ?? null;

$controllerClass = '\\App\\Controllers\\' . $controllerName;

if (!class_exists($controllerClass)) {
    (new \App\Controllers\Index)->actionError('Контроллер ' . $controllerClass . ' не найден');
}

try {
    $controller = new $controllerClass;
    $controller->action($actionName, $params);

} catch (\Exception $e) {

    (new \App\Logger)->addRecord($e);
    (new \App\Controllers\Index)->actionError();
}

