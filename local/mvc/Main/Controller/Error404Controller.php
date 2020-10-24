<?php

namespace local\mvc\Controller;

class Error404Controller {
    public function indexAction() {
        $this->render('Ошибка 404', [], 'error');
    }
}