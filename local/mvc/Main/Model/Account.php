<?php

namespace local\mvc\Main\Model;
use local\Core\Model;
use local\Core\User;
class Account extends Model {
    protected $login;
    protected $password;
    protected $password_hash;
    protected $email;
    protected $phone;
    protected $id;
    protected $user;

    public function __construct($route) {
        parent::__construct($route);
        $this->user = new User();
    }

    public function register($params) {
        if (
            !empty($params['login']) && !empty($params['password'])
            && !empty($params['phone']) && !empty($params['email'])
        ) {
            $this->bindLogin($params['login']);
            $this->bindPassword($params['password']);
            $this->bindEmail($params['email']);
            $this->bindPhone($params['phone']);

            $this->user->prepareUser($params);
            if ($this->user->register()) {
                echo json_encode(['success' => true, 'message' => 'you was registered successfully']);
            }
            echo json_encode(['success' => false, 'message' => 'register hasn\'t happend']);
        } else {
            echo json_encode(['success' => false, 'message' => 'some data is empty, check it again']);

        }
    }

    protected function bindLogin($login) {
        if (!empty($login)) {
            $this->login = $login;
        }
    }

    protected function bindPassword($password) {
        if (!empty($password)) {
            $this->password = $password;
        }
    }

    protected function bindEmail($email) {
        if (!empty($email)) {
            $this->email = $email;
        }
    }

    protected function bindPhone($phone) {
        if (!empty($phone)) {
            $this->phone = $phone;
        }
    }
}