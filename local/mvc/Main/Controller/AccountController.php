<?php

namespace local\mvc\Main\Controller;
use local\core\Controller;
use local\mvc\Main\Model\Account;
class AccountController extends Controller {
    protected $login;
    protected $password;
    protected $email;
    protected $phone;

    public function indexAction() {
        $this->view->render('Личный кабинет');
    }

    public function loginAction() {

    }

    public function regAction() {
        $this->view->render('Регистрация', [], 'reg');
    }

    public function registerAction() {
        if(!empty($_POST)) {
            $this->login = $_POST['login'] ? htmlspecialchars(strip_tags($_POST['login'])) : '';
            $this->password = $_POST['password'] ? htmlspecialchars(strip_tags($_POST['password'])) : '';
            $this->email = $_POST['email'] ? htmlspecialchars(strip_tags($_POST['email'])) : '';
            $this->phone = $_POST['phone'] ? htmlspecialchars(strip_tags($_POST['phone'])) : '';

            $this->model->register([
                'login' => $this->login,
                'password' => $this->password,
                'email' => $this->password,
                'phone' => $this->phone,
            ]);
        }
    }
}