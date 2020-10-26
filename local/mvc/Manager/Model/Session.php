<?php

namespace local\mvc\Manager\Model;
use local\core\Database;
class Session {
    protected $db;
    const SESSION_TABLE = 'us_1';

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function setSession(int $id, string $token): bool {
        if (empty($id) || empty($token)) return false;

        return $this->db->insert(self::SESSION_TABLE, [
            'user_id' => $id,
            'token' => $token,
        ]);
    }

    public function getSession($sessid) {
        if (empty($sessid)) return false;

        return $this->db->select(self::SESSION_TABLE, ['token', '=', $sessid])->getResults()[0];
    }
}