<?php

namespace local\core;
use local\core\View;
use local\core\User;

abstract class Controller {
    protected $route;
    protected $view;
    protected $model;
    protected $user;
    protected $isAuthorized;

    public function __construct($route) {
        $this->setRoute($route);
        $this->view = new View($this->getRoute());
        $this->model = $this->bindModel($this->route['controller']);
        $this->user = new User();
        if ($this->user->isAuthorized()) {
            $this->user->authorizeUserById();
            $this->isAuthorized = true;
        }
    }

    public function getRoute() {
        return $this->route;
    }

    public function setRoute($route) {
        $this->route = $route;
    }

    private function bindModel($modelName) {
        $preparedModelName = ucfirst(preg_replace('/Controller/', '', $modelName));
        $model = MVC_MODELS_PATH . $preparedModelName . '.php';
        if (file_exists($model)) {
            $modelClassNamespace = MVC_MODELS_NAMESPACE . $preparedModelName;
            return new $modelClassNamespace($this->route);
        }
        return false;
    }
}