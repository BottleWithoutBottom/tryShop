<?php

namespace local\core;
use local\core\Helper;

class Router {
    protected $CHILDREN = 'children';
    protected $routes = [];
    protected $params = [];
    public function __construct() {
        $routesArr = $this->loadConfigFile();
        foreach ($routesArr as $route => $params) {
            $this->add($route, $params);
        }
    }

    // Преобразовывает текущий ключ массива конфига роута к виду регулярного выражения.
    public function add($route, $params) {
        if (strpos($route, ':') && isset($params['pattern'])) {
            $params['mask'] = $route;
            $route_preg = $params['pattern'];
        } else {
            $route_preg = $this->formPregRoute($route);
        }

        $this->routes[$route_preg] = $params;
        if (isset($params[$this->CHILDREN])) {
            foreach ($params[$this->CHILDREN] as $child_route => $child_params) {
                $this->add($child_route, $child_params);
            }
        }
    }

    public function mount() {
        foreach ($this->routes as $route => $params) {
            if (isset($params['pattern'])) {
                if (preg_match($params['pattern'], $_SERVER['REQUEST_URI'])) {
                    $maskParams = Helper::generateKeysFromMask($_SERVER['REQUEST_URI'], $params['maskPattern'], $params['mask'], '#:[a-zA-Z_]*#');
                    $this->params = $params;
                    $this->params['additional'] = $maskParams;
                    return true;
                }
            } else if(preg_match($route, $_SERVER['REQUEST_URI'])) {
                $this->params = $params;
                return true;
            }
        }

        return false;
    }

    public function executeRouter() {
        if ($this->mount()) {
            $controllerPath = MVC_CONTROLLER_NAMESPACE . ucfirst($this->params['controller']);
            if (class_exists($controllerPath)) {
                $action = $this->params['action'] . 'Action';
                if (method_exists($controllerPath, $action)) {
                    $controller = new $controllerPath($this->params);
                    $controller->$action();
                }
            }
        } else {
            View::Error404Action();
        }
    }

    public function loadConfigFile() {
        return require(MVC_MAIN_DIR_CONFIG . 'routes.php');
    }

    private function formPregRoute($route) {
        return '#^' . $route . '$#';
    }
}