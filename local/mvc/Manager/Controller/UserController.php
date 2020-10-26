<?

namespace local\mvc\Manager\Controller;
use local\mvc\Manager\Model\User;
use local\mvc\Manager\Controller\SessionController;
use local\mvc\Manager\Controller\CookieController;

class UserController {
    protected $model;
    protected $login;
    protected $password;
    protected $hashed_password;
    protected $email;
    protected $phone;
    protected $remember;
    const SESSID = 'sessid';

    public function __construct() {
        $this->model = new User();
    }

    private function prepareUser($params) {
        $this->login = !empty($params['login']) ? $params['login'] : '';
        $this->password = !empty($params['password']) ? $params['password'] : '';
        $this->email = !empty($params['email']) ? $params['email'] : '';
        $this->phone = !empty($params['phone']) ? $params['phone'] : '';
        $this->remember = !empty($params['remember']) ? $params['remember'] : '';
    }

    public function login($params) {
        if (empty($params['login'])) return false;
        $this->prepareUser($params);

        $user = $this->model->getUser($this->login);
        if (self::verifyPassword($this->password, $user->password)) {
            $session = new SessionController();
            $token = self::generateToken();
            if ($session->setSessionRow($user->id, $token)) {
                SessionController::setSession(self::SESSID, $token);

                if ($this->remember) CookieController::setCookie(self::SESSID, $token, time() + 3600 * 7);
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public static function isAuthorized(string $token): bool {
        $sessid = SessionController::getSession($token) ?: CookieController::getCookie($token);
        if ($sessid) {
            $session = new SessionController();
            if ($session->getSessionRow($sessid)) {
                return true;
            } else {
                return false;
            }
        }

        return false;
    }

    public function authorizeBySessid(string $sessid): bool {
        if (empty($sessid)) return false;

        $session = new SessionController();
        $sessionRow = $session->getSessionRow($sessid);

        if ($sessionRow) {
            $this->model->getUserByID($sessionRow->user_id);
            return true;
        } else {
            return false;
        }
    }

    public function logout(): bool {
        $tokenName = SessionController::getSessionName(self::SESSID) ?: (CookieController::getCookieName(self::SESSID) ?: false);
        if(!self::isAuthorized($tokenName)) return false;

        SessionController::removeSession(self::SESSID);
        CookieController::removeCookie(self::SESSID);
        die();
        return true;
    }

    public function register($params) {
        $this->prepareUser($params);

        $this->hashed_password = !empty($this->password) ? self::generatePassword($this->password) : '';

        return $this->model->regUser([
            'login' => $this->login,
            'password' => $this->hashed_password,
            'email' => $this->email,
        ]);
    }

    public static function generatePassword($password): string {
        return password_hash($password, PASSWORD_BCRYPT);
    }

    public static function verifyPassword($password, $hash): bool {
        return password_verify($password, $hash);
    }

    public static function generateToken() {
        return substr(bin2hex(random_bytes(128)), 0, 128);
    }
}