<?php

namespace local\core;
use local\core\Database;
abstract class Model {

    protected $route;
    public $db;

    public function __construct($route) {
        $this->setRoute($route);
        $this->db = Database::getInstance();
    }

    public function getRoute() {
        return $this->route;
    }

    public function setRoute($route) {
        $this->route = $route;
    }
}