<?php

require __DIR__ . '/../App/autoload.php';

use App\Exceptions\NotFoundException, App\Exceptions\DbException;
use \App\Controllers\Index, \App\Logger, App\Exceptions\AccessDeniedException;

PHP_Timer::start();

$parts = explode('/', $_SERVER['REQUEST_URI']);

$controllerName = ucfirst($parts[1] ?: 'Index');
$actionName = ucfirst($parts[2] ?? 'Default');
$params = $parts[3] ?? null;

$controllerClass = '\\App\\Controllers\\' . $controllerName;

try {
    if (!class_exists($controllerClass)) {
        throw new NotFoundException('Контроллер ' . $controllerClass . ' не найден');
    }

    /** @var \App\Controller $controller */
    $controller = new $controllerClass;
    $controller->action($actionName, $params);

} catch (DbException $e) {

    (new Logger)->error($e);
    (new Index)->action('Error', $e->getMessage());

} catch (NotFoundException $e) {

    (new Logger)->info($e);
    (new Index)->action('404', $e->getMessage());

} catch (AccessDeniedException $e) {

    (new Logger)->warning($e);
    (new Index)->action('403', $e->getMessage());

} catch (\Exception $e) {

    (new Logger)->debug($e);
    (new Index)->action('Error', $e->getMessage());
}

