<?php

namespace local\mvc\Main\Model;
use local\Core\Model;
use local\Core\User;
class Account extends Model {
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
            $this->user->prepareUser($params);
            if ($this->user->register()) {
                echo json_encode(['success' => true, 'message' => 'you were registered successfully']);
            } else {
                echo json_encode(['success' => false, 'message' => 'register hasn\'t happend']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'some data is empty, check it again']);

        }
    }

    public function login($params) {
        if ($this->user->isAuthorized()) header('Location:' . g_ROOT);

        if (!empty($params['login']) && !empty($params['password'])) {
            $this->user->prepareUser($params);
            if ($this->user->authorize()) {
                echo json_encode(['success' => true, 'message' => 'you logined in']);
            } else {
                echo json_encode(['success' => false, 'message' => 'something went wrong, check your data again']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'some data was not filled in, check it again']);

        }
    }

    public function logout() {
        if (!$this->user->isAuthorized()) header('Location: ' . g_ROOT);

        $this->user->logout();
    }
}