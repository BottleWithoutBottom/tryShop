<?php
namespace local\mvc\Main\Controller;
use local\core\Controller;
use local\mvc\Manager\Controller\UserController;

use local\mvc\Main\Model\Account;
class AccountController extends Controller {
    protected $login;
    protected $password;
    protected $email;
    protected $phone;
    protected $remember;

    public function indexAction() {
        $this->view->render('Личный кабинет');
    }

    public function regAction() {
        $params = [];
        if ($this->user->isAuthorized(parent::SESSID)) {
            $params['isAuthorized'] = true;
            $params['message'] = 'Вы уже авторизованы';
            $params['text'] = 'Вернуться на главную страницу';
        }

        $this->view->render('Регистрация', $params, 'reg');
    }

    public function loginAction() {
        $params = [];
        if ($this->user->isAuthorized(self::SESSID)) {
            $params['isAuthorized'] = true;
            $params['message'] = 'Вы уже авторизованы';
            $params['text'] = 'Вернуться на главную страницу';
        }

        $this->view->render('Авторизация', $params, 'login');
    }

    public function logoutAction() {
        if (!$this->user->isAuthorized(self::SESSID)) {
            header('Location: ' . g_ROOT);
            exit();
        }

        if ($this->user->logout()) {
            header('Location: ' . g_ROOT);
            exit();
        }

    }

    public function registerAJAXAction() {
        if(empty($_POST)) return false;

        $this->login = $_POST['login'] ? htmlspecialchars(strip_tags($_POST['login'])) : '';
        $this->password = $_POST['password'] ? htmlspecialchars(strip_tags($_POST['password'])) : '';
        $this->email = $_POST['email'] ? htmlspecialchars(strip_tags($_POST['email'])) : '';
        $this->phone = $_POST['phone'] ? htmlspecialchars(strip_tags($_POST['phone'])) : '';

        $registered = $this->user->register([
            'login' => $this->login,
            'password' => $this->password,
            'email' => $this->email,
//                'phone' => $this->phone,
        ]);

        if ($registered) {
            header('Location: ' . g_ROOT . 'account/');
            exit();
        } else {
            return false;
        }
    }

    public function loginAJAXAction() {
        if (!empty($_POST)) {
            $this->login = $_POST['login'] ? htmlspecialchars(strip_tags($_POST['login'])) : '';
            $this->password = $_POST['password'] ? htmlspecialchars(strip_tags($_POST['password'])) : '';
            $this->remember = $_POST['remember'] ? htmlspecialchars(strip_tags($_POST['remember'])) : '';

            $authorized = $this->user->login([
                'login' => $this->login,
                'password' => $this->password,
                'remember' => $this->remember
            ]);

            if ($authorized) {
                header('Location: ' . g_ROOT . 'account/');
                exit();
            } else {
                header('Location: ' . g_ROOT);
                exit();
            }
        }
    }
}