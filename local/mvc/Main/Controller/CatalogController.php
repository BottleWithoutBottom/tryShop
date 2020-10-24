<?php

namespace local\mvc\Main\Controller;
use local\core\Controller;
class CatalogController extends Controller {
    public $categories;

    public function indexAction() {
        $this->view->render('Каталог');
    }

    public function categoryAction() {
        $this->categories = $this->model
            ->db->select('catalog_category', ['catalog_category_id', '=', $this->model->getId()])->getResults();
        $this->view->render('Категории каталога', [
            'categories' => $this->categories,
        ]);
    }

    public function categoriesAction() {
        $this->categories = $this->model
            ->db->select('catalog_category')
            ->getResults();
        $this->view->render('Категории каталога', [
            'categories' => $this->categories
        ], 'categories');
    }
}