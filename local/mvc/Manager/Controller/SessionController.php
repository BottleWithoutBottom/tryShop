<?php

namespace local\mvc\Manager\Controller;
use local\mvc\Manager\Model\Session;
class SessionController {
    protected $model;

    public function __construct() {
        $this->model = new Session();
    }

    public function setSessionRow(int $id, string $token): bool {
        if (empty($id) || empty($token)) die('empty sessionRow');

        return $this->model->setSession($id, $token);
    }

    public static function setSession(string $name, string $value): bool {
        if (empty($value)) return false;
        $_SESSION[$name] = $value;

        return true;
    }

    public static function getSession(string $name): string {
        if (!isset($_SESSION[$name])) return false;

        return $_SESSION[$name];
    }

    public static function getSessionName(string $name): string {
        if (empty($name) || !isset($_SESSION[$name])) return false;

        return $name;
    }

    public function getSessionRow(string $sessid) {
        if (empty($sessid)) return false;

        return $this->model->getSession($sessid);
    }

    public static function removeSession(string $name): bool {
        if (!isset($_SESSION[$name])) return false;
        unset($_SESSION[$name]);

        return true;
    }
}