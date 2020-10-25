<?php

namespace local\core;
use local\core\User;

class View {
    protected $header = 'header';
    protected $footer = 'footer';
    protected $view;
    protected $route;
    protected $user;
    protected $isAuthorized;

    public function __construct($route) {
        $this->user = new User();
        $this->isAuthorized = $this->user->isAuthorized();
        $this->setRoute($route);
        $this->view = $this->route['controller'] . '/' . $this->route['action'];
    }

    public function render($title, $params = [], $page = 'base') {
        $header = P_LAYOUTS . $this->header . '.php';
        $footer = P_LAYOUTS . $this->footer . '.php';
        if (!empty($params)) {
            extract($params);
        }

        if (file_exists($header) && file_exists($footer)) {
            ob_start();
            require MVC_VIEWS_PATH . $this->view . '.php';
            $inner = ob_get_clean();
            $isAuthorized = $this->isAuthorized;
            require $header;
            require $footer;
        } elseif (!file_exists($header)) {
            die('This layout doesn\'t exists on path: ' . $header);
        } elseif (!file_exists($footer)) {
            die('This layout doesn\'t exists on path: ' . $footer);
        } else {
            die ('Unknown error');
        }
    }

    public function getRoute() {
        return $this->route;
    }

    public function setRoute($route) {
        $this->route = $route;
    }

    public static function Error404Action() {
        http_response_code(404);
        require MVC_VIEWS_PATH . 'Error404Controller.php';
    }
}