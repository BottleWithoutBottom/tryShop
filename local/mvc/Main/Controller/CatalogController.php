<?php

namespace local\mvc\Main\Controller;
use local\core\Controller;
class CatalogController extends Controller {
    public $categories;
    public $category;
    public $category_id;
    public $categoryElements;

    public function __construct($route) {
        parent::__construct($route);

        $category_id = $this->route['additional']['category_id'];
        if (isset($category_id)) {
            $this->category_id = (int)$category_id;
        }
    }

    public function indexAction() {
        $this->view->render('Каталог');
    }

    public function categoryAction() {
        if ($this->category_id) {
            $this->categoryElements = $this->model
                ->getCategoryElements($this->category_id);
            $this->category = $this->model->getCategory($this->category_id);
        }
        $this->view->render('Категории каталога', [
            'categoryElements' => $this->categoryElements,
            'currentCategory' => $this->category,
        ]);
    }

    public function categoriesAction() {
        $this->categories = $this->model->getAllCategories();

        foreach($this->categories as $category) {
            $category->link = '/catalog/category/' . $category->catalog_category_id . '/';
        }

        $this->view->render('Категории каталога', [
            'categories' => $this->categories
        ], 'categories');
    }
}