<?

namespace local\mvc\Manager\Model;
use local\core\Database;

class User {
    protected $db;
    CONST USER_TABLE = 'users';

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function getUser($login) {
        if (empty($login)) return false;

        return $this->db->select(self::USER_TABLE, ['login', '=', $login])->getResults()[0];
    }

    public function gerUserById($id) {
        if (empty($id)) return false;

        return $this->db->select(self::USER_TABLE, ['id', '=', $id])->getResults()[0];
    }

    public function regUser($fields) {
        if (!isset($fields['login']) || !isset($fields['password']) || !isset($fields['email'])) return false;

        return $this->db->insert(self::USER_TABLE, [
            'login' => $fields['login'],
            'password' => $fields['password'],
            'email' => $fields['email'],
        ]);
    }
}