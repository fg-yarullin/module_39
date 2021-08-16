<?php
ini_set('display_errors', 1);
// require __DIR__ . '/../config/config.php';

// require __DIR__ . '/../vendor/autoload.php';

require_once __DIR__ . '/../app/bootstrap.php';

/******************************************************** */
// use Core\EntryPoint;
// try {
//     // include_once __DIR__ . '/../App/Core/EntryPoint.php';
//     include __DIR__ . '/../app/AppRoutes.php';
//     $route = ltrim(strtok($_SERVER['REQUEST_URI'], '?'), '/');
//     $entryPoint = new EntryPoint($route, new AppRoutes);
//     $entryPoint->run();
// } catch (PDOException $e) {
//     $title = 'An error has occurred';
//     $output = 'Database error: ' . $e->getMessage() . 'in ' .
//     $e->getFile() . ':' . $e->getLine();
//     include __DIR__ . '/../src/templates/layout.html.php';
// }
