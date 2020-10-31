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
    CONST DEPTH_1_LEVEL = '_1';

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
        return $this->db->select(self::CATALOG_TABLE_NAME . self::DEPTH_1_LEVEL)->getResults();
    }

    /**
     * Собираем категории верхнего уровня.
     * делаем выборку по категории нижнего уровня, где родительский айди равен айди верхнего уровня
     * опускаемся на уровень ниже и повторяем то же самое
     * @var int $depthLevel
     * @return array
     */
    public function getCategoriesDepth($depthLevel, $parent_id = 0, $currentLevel = 1) {
        if ($depthLevel <= 1) return $this->getAllCategories();
        $result = [];
        while($currentLevel < $depthLevel) {
            $currentLevelCategories = $this->getCategoriesOnLevel($currentLevel, $parent_id);
            $currentLevel++;
            foreach($currentLevelCategories as $currentLevelCategory) {
                $currentLevelCategory->children = $this->getCategoriesDepth($depthLevel, $currentLevelCategory->catalog_category_id, $currentLevel);
                $result[] = $currentLevelCategory;
            }
        }
        return $result;
    }

    public function getCategoriesOnLevel($currentLevel, $parent_id = 0) {
        if (!$currentLevel) return false;
        return $this->db->select(self::CATALOG_TABLE_NAME . '_' . $currentLevel, ['parent_id', '=', $parent_id])->getResults();
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