<?php

namespace local\mvc\Main\Controller;
use local\core\Controller;
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
        if ($this->user->isAuthorized()) {
            $params['isAuthorized'] = true;
            $params['message'] = 'Вы уже авторизованы';
            $params['text'] = 'Вернуться на главную страницу';
        }

        $this->view->render('Регистрация', $params, 'reg');
    }

    public function loginAction() {
        $params = [];
        if ($this->user->isAuthorized()) {
            $params['isAuthorized'] = true;
            $params['message'] = 'Вы уже авторизованы';
            $params['text'] = 'Вернуться на главную страницу';
        }

        $this->view->render('Авторизация', $params, 'login');
    }

    public function logoutAction() {
        if (!$this->user->isAuthorized()) {
            header('Location: ' . g_ROOT);
            exit();
        }
        $this->user->logout();
    }

    public function registerAJAXAction() {
        if(!empty($_POST)) {
            $this->login = $_POST['login'] ? htmlspecialchars(strip_tags($_POST['login'])) : '';
            $this->password = $_POST['password'] ? htmlspecialchars(strip_tags($_POST['password'])) : '';
            $this->email = $_POST['email'] ? htmlspecialchars(strip_tags($_POST['email'])) : '';
            $this->phone = $_POST['phone'] ? htmlspecialchars(strip_tags($_POST['phone'])) : '';

            if (
                !empty($this->login) && !empty($this->password)
                && !empty($this->email) && !empty($this-phone)
            ) {
                $this->user->prepareUser([
                    'login' => $this->login,
                    'password' => $this->password,
                    'email' => $this->email,
//                    'phone' => $this->phone,
                ]);
                if ($this->user->register()) {
                    echo json_encode(['success' => true, 'message' => 'you were registered successfully']);
                } else {
                    echo json_encode(['success' => false, 'message' => 'register hasn\'t happend']);
                }
            } else {
                echo json_encode(['success' => false, 'message' => 'some data is empty, check it again']);
            }
        }
    }

    public function loginAJAXAction() {
        if (!empty($_POST)) {
            $this->login = $_POST['login'] ? htmlspecialchars(strip_tags($_POST['login'])) : '';
            $this->password = $_POST['password'] ? htmlspecialchars(strip_tags($_POST['password'])) : '';
            $this->remember = $_POST['remember'] ? htmlspecialchars(strip_tags($_POST['remember'])) : '';

            if (!empty($this->login) && !empty($this->password)) {
                $this->user->prepareUser([
                    'login' => $this->login,
                    'password' => $this->password,
                    'remember' => $this->remember,
                ]);
                if ($this->user->authorize()) {
                    echo json_encode(['success' => true, 'message' => 'you logined in']);
                } else {
                    echo json_encode(['success' => false, 'message' => 'something went wrong, check your data again']);
                }
            } else {
                echo json_encode(['success' => false, 'message' => 'some data was not filled in, check it again']);
            }
        }
    }
}