<?php
    namespace App\Routes;

    class Route {
        private static array $routes = [];

        public static function get(string $uri, array|string|callable $action) {
            self::$routes['GET'][$uri] = $action;
        }

        public static function post(string $uri, array|string|callable $action) {
            self::$routes['POST'][$uri] = $action;
        }

        public static function put(string $uri, array|string|callable $action) {
            self::$routes['PUT'][$uri] = $action;
        }

        public static function delete(string $uri, array|string|callable $action) {
            self::$routes['DELETE'][$uri] = $action;
        }

        public static function dispatch() {
            $method = $_SERVER['REQUEST_METHOD'];
            $uri = strtok($_SERVER['REQUEST_URI'], '?'); // Supprime les paramètres GET

            foreach (self::$routes[$method] ?? [] as $route => $action) {
                $pattern = preg_replace('#\{(\w+)\}#', '(\d+)', $route);
                if (preg_match("#^$pattern$#", $uri, $matches)) {
                    array_shift($matches); // Enlève l'URL complète du tableau
                    return self::execute($action, $matches);
                }
            }

            http_response_code(404);
            echo "404 Not Found";
        }

        private static function execute($action, $params) {
            if (is_callable($action)) {
                echo call_user_func_array($action, $params);
            } elseif (is_array($action) && count($action) === 2) {
                [$controller, $method] = $action;
                $controllerInstance = new $controller();
                echo $controllerInstance->$method(...$params);
            }
        }
    }
?>
