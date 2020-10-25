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
        session_start();
    }

    public function getSession() {
        $token = self::getSessid();
        if ($session = $this->getSessionByToken($token)) {
            return $session;
        } else {
            return false;
        }
    }

    public function getSessionFromCookie() {
        $token = self::getSessidFromCookie();
        if ($session = $this->getSessionByToken($token)) {
            return $session;
        } else {
            return false;
        }
    }

    public static function getSessid(): string {
        if (!empty($_SESSION[self::SESSID])) {
            return $_SESSION[self::SESSID];
        } else {
            return false;
        }
    }

    public static function deleteSessid(): bool {
        if (!empty($_SESSION[self::SESSID])) {
           unset($_SESSION[self::SESSID]);
           return true;
        } else {
            return false;
        }
    }

    public static function deleteSessidFromCookie():bool {
        if (!empty($_COOKE[self::SESSID])) {
            setCookie(self::SESSID, '', time() - 1, g_ROOT);
            return true;
        } else {
            return false;
        }
    }

    public static function getSessidFromCookie(): string {
        if (!empty($_COOKIE[self::SESSID])) {
            return $_COOKIE[self::SESSID];
        } else {
            return false;
        }
    }

    private function getSessionByToken($token) {
        return $this->db->select(self::SESSION_TABLE, [self::SESSION_TOKEN, '=', $token])->getResults()[0];
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

    /** Помещает в куки токен пользователя */
    public function setRememberCookie($token) {
        if (!empty($token)) {
            setCookie(self::SESSID, $token, time() + 3600 * 24 * 7, g_ROOT);
        }
    }

    private static function generateToken() {
        return substr(bin2hex(random_bytes(256)), 0, 128);
    }
}