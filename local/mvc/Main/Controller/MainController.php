<?php

namespace local\mvc\Main\Controller;
use local\core\Controller;
use local\core\Database;

class MainController extends Controller {
    public function indexAction() {
        $db = Database::getInstance();

        $this->view->render('Главная', [], 'main');
    }
}