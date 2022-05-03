<?php
namespace Core;
use App\Routes;

class EntryPoint {
    private $route;
    private $method;
    private $routes;
    private $authentication;

    public function __construct(string $route, string $method, Routes $routes) {
        $this->route = $route;
        $this->method = $method;
        $this->routes = $routes;
        $this->authentication = $routes->getAuthentication();
        $this->checkUrl();
    }

    private function checkUrl() {
        if ($this->route != strtolower($this->route)) {
            http_response_code(301);
            header('location: '. strtolower($this->route));
        }
    }

    private function loadTemplate($template, $variables = []) {
        extract($variables);
        ob_start();
        include __DIR__ . '/../templates/' . $template;
        return ob_get_clean();
    }

    public function run() {
        $routes = $this->routes->getRoutes();

        if (isset($routes[$this->route]['login']) && $routes[$this->route]['login'] && !$this->authentication->isLoggedIn()) {
            header('location: /login/error');
        } else if (isset($routes[$this->route]['permissions']) && !$this->routes->checkPermission($routes[$this->route]['permissions'])) {
            header('location: /user/permissions/error');
        } else {
            $controller = $routes[$this->route][$this->method]['controller'];
            $action = $routes[$this->route][$this->method]['action'];

            if (method_exists($controller, $action)) {
                $page = $controller->$action();
                // var_dump($page);exit();
                extract($page);
                $output = isset($variables) ?
                    $this->loadTemplate($template, $variables) :
                    $this->loadTemplate($template);
                // include __DIR__ . '/../templates/layout.html.php';
                $data = [
                    'loggedIn' => $this->authentication->isLoggedIn(),
                    'output' => $output ?? null,
                    'title' => $title ?? ''
                ];
                echo $this->loadTemplate('layout.html.php', $data);
            } else {
                EntryPoint::errorPage404();
            }
        }
    }

    public static function errorPage404() {
        http_response_code(404);
        include __DIR__ . '/../templates/404_NotFound.php';
        return;
    }
}
