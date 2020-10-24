<?php

namespace local\mvc\Main\Model;

use local\core\Model;
use local\core\Database;
class Catalog extends Model {
    protected $category_id;

    public function __construct($route) {
        parent::__construct($route);

        $category_id = $this->route['additional']['category_id'];
        if (isset($category_id)) {
            $this->category_id = (int)$category_id;
        }
    }

    public function getId() {
        return $this->category_id;
    }
}