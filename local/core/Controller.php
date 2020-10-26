<?php

namespace local\core;
use local\core\View;
use local\mvc\Manager\Controller\SessionController;
use local\mvc\Manager\Controller\CookieController;
use local\mvc\Manager\Controller\UserController;

abstract class Controller {
    protected $route;
    protected $view;
    protected $model;
    protected $user;
    protected $isAuthorized = false;
    protected $sessid;
    protected $session_token;
    CONST SESSID = 'sessid';

    public function __construct($route) {
        $this->setRoute($route);
        $this->view = new View($this->getRoute());
        $this->model = $this->bindModel($this->route['controller']);
        $this->user = new UserController();
        $this->session_token = SessionController::getSessionName(self::SESSID) ?: CookieController::getCookieName(self::SESSID);

        if ($this->session_token) {
            $this->sessid = SessionController::getSession(self::SESSID) ?: (CookieController::getCookie(self::SESSID) ?: false);
            if ($this->user->isAuthorized($this->sessid)) {
                $this->user->authorizeBySessid($this->sessid);
                $this->isAuthorized = true;
            }
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