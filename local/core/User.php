<?php

namespace local\core;
use local\core\Database;
use local\core\Session;

class User {
    CONST USER_TABLE = 'users';

    protected $id;
    protected $login;
    protected $password;
    protected $password_hash;
    protected $email;
    protected $phone;
    protected $db;
    protected $session;

    protected $current_session;
    protected $session_id;

    function __construct() {
        $this->db = Database::getInstance();
        $this->session = new Session();
    }

    public static function getUserId() {

    }

    public static function getUserGroups() {

    }

    public static function getUserStatus() {

    }

    public function prepareUser($params) {
        $this->login = !empty($params['login']) ? $params['login'] : null;
        $this->password = !empty($params['password']) ? $params['password'] : null;
        $this->email = !empty($params['email']) ? $params['email'] : null;
        $this->phone = !empty($params['phone']) ? $params['phone'] : null;
    }

    public function register() {
        if (
            !empty($this->login) && !empty($this->password)
            && !empty($this->email) && !empty($this->phone)
        ) {
            $this->password_hash = self::generatePassword($this->password);

            $this->db->insert(self::USER_TABLE, [
                'login' => $this->login,
                'password' => $this->password_hash,
                'email' => $this->email,
//                'phone' => $this->phone,
            ]);

            $this->id = $this->db->select(self::USER_TABLE, ['login', '=', $this->login], 'SELECT id')->getResults()[0]->id;
            $this->session->setSession($this->id);
            return true;
        } else {
            return false;
        }
    }

    public function authorize() {
        if (!empty($this->login)) {

        }
    }

    public function isAuthorized() {
        if ($sess = $this->session->getSession()) {
            $this->current_session = $sess;
            return true;
        } else {
            return false;
        }
    }

    private static function generatePassword($password): string {
        return password_hash($password, PASSWORD_BCRYPT);
    }

    private static function checkPassword($password, $hash): bool {
        return password_verify($password, $hash);
    }
}