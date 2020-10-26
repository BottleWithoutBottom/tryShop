<?php

namespace local\mvc\Main\Model;

use local\core\Model;
use local\core\Database;
class Catalog extends Model {
    protected $category_id;
    CONST CATALOG_TABLE_NAME = 'catalog_category';
    CONST CATALOG_ITEMS_TABLE_NAME = 'catalog_products';
    CONST CATALOG_ITEMS_CATEGORY_ID = 'CATEGORY_ID';
    CONST CATEGORY_ID = 'catalog_category_id';

    public function __construct($route) {
        parent::__construct($route);
    }

    public function getCategoryElements($category_id) {
        if ($category_id) {
            $category_id = (int)$category_id;
            return $this->db->select(self::CATALOG_ITEMS_TABLE_NAME, [self::CATALOG_ITEMS_CATEGORY_ID, '=', $category_id])->getResults();
        }

        return false;
    }

    public function getAllCategories() {
        return $this->db->select(self::CATALOG_TABLE_NAME)->getResults();
    }

    public function getCategory($category_id) {
        if ($category_id) {
            return $this->db->select(self::CATALOG_TABLE_NAME, [self::CATEGORY_ID, '=', $category_id])->getResults()[0];
        }

        return false;
    }

    public function getId() {
        return $this->category_id;
    }
}