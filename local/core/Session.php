<?php

namespace local\core;
use local\core\Database;
use local\core\User;
class Session {
    const SESSION_TABLE = 'us_1';
    const SESSION_TOKEN = 'token';
    const SESSID = 'sessid';
    private $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function getSession() {
        $token = self::getSessid();
        if ($session = $this->db->select(self::SESSION_TABLE, [self::SESSION_TOKEN, '=', $token])) {
            return $session;
        } else {
            return false;
        }
    }

    public static function getSessid() {
        if (!empty($_SESSION[self::SESSID])) {
            return $_SESSION[self::SESSID];
        } else {
            return false;
        }
    }

    public function setSession($user_id) {
        if ($user_id) {
            $token = self::generateToken();
            $this->db->insert(self::SESSION_TABLE,
                [
                    'user_id' => $user_id,
                    'token' => $token
                ]
            );

            $_SESSION[self::SESSID] = $token;
        }
    }

    private static function generateToken() {
        return substr(bin2hex(random_bytes(256)), 0, 128);
    }
}