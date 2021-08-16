<?php
/**
 * Здкесь обычно дополнительные модули, реализующие
 * дополнительные функции:
 * > аутентификацию
 * > кеширование
 * > работу с формами
 * > абстракция для доступа к данным
 * > ORM
 * > Unit testing
 * > Benchmarking
 * > Работу с изображениями
 * > Backup
 * > и другие
 */
require_once __DIR__ . '/../vendor/autoload.php';
// require_once __DIR__ . '/core/route.php';
// include 'app_routes.php';
// include __DIR__ . '/../config/db_connection.php';
// Route::run();

use Core\EntryPoint;
use App\AppRoutes;

try {
    $route = ltrim(strtok($_SERVER['REQUEST_URI'], '?'), '/');
    $method = $_SERVER['REQUEST_METHOD'];
    $entryPoint = new EntryPoint($route, $method, new AppRoutes);
    $entryPoint->run();
} catch (PDOException $e) {
    $title = 'An error has occurred';
    $output = 'Database error: ' . $e->getMessage() . 'in ' .
    $e->getFile() . ':' . $e->getLine();
    include __DIR__ . '/templates/layout.html.php';
}
