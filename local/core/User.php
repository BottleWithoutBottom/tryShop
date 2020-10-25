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
    protected $remember;

    protected $current_session;
    protected $user_data;

    function __construct() {
        $this->db = Database::getInstance();
        $this->session = new Session();
    }

    public function getUserId() {
        if (!empty($this->id)) {
            return $this->id;
        }
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
        $this->remember = !empty($params['remember']) ? $params['remember'] : null;
    }

    public function register(): bool {
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

    public function authorize(): string {
        if (!empty($this->login)) {
            $user = $this->db->select(self::USER_TABLE, ['login', '=', $this->login])->getResults()[0];
            if (self::checkPassword($this->password, $user->password)) {
                $this->session->setSession($user->id);
                if ($this->remember) {
                    $this->session->setRememberCookie($_SESSION[Session::SESSID]);
                }

                echo json_encode([
                    'success' => true,
                    'message' => 'successfull authorization',
                ]);
                return true;
            } else {
                echo json_encode([
                    'success' => false,
                    'message' => 'some data is not correct, please, check your data',
                ]);
                return false;
            }
        }
    }

    public function logout() {
        if ($this->session::getSessid()) {
            $this->session::deleteSessid();
        }
        if ($this->session::getSessidFromCookie()) {
            $this->session::deleteSessidFromCookie();
        }
        header('Location: ' . g_ROOT);
    }

    public function isAuthorized(): bool {
        if ($sess = $this->session->getSession()) {
            $this->current_session = $sess;
            return true;
        } elseif ($cookie = $this->session->getSessionFromCookie()){
            $this->current_session = $cookie;
            return true;
        } else {
            return false;
        }
    }

    public function authorizeUserById(): bool {
        if (!empty($this->current_session)) {
            $this->user_data = $this->db->select(self::USER_TABLE, ['id', '=', $this->current_session->user_id]);
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