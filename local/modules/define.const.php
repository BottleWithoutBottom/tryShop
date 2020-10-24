<?
define(SITE_DIR, $_SERVER['DOCUMENT_ROOT'] . '/');
define(g_ROOT, '/');
define(LOCAL, SITE_DIR . 'local/');
define(P_IMAGES, LOCAL . 'img/');
define(MVC_DIR, LOCAL . 'mvc/');
define(MVC_MAIN_DIR, MVC_DIR . 'Main/');
define(MVC_MAIN_DIR_CONFIG, MVC_MAIN_DIR . 'config/');

define(MVC_CONTROLLERS_PATH, MVC_MAIN_DIR . 'Controller/');
define(MVC_MODELS_PATH, MVC_MAIN_DIR . 'Model/');
define(MVC_VIEWS_PATH, MVC_MAIN_DIR . 'View/');

define(MVC_MODELS_NAMESPACE, 'local\mvc\Main\Model\\');
define(MVC_VIEWS_NAMESPACE, 'local\mvc\Main\View\\');
define(MVC_CONTROLLER_NAMESPACE, 'local\mvc\Main\Controller\\');

define(P_LAYOUTS, LOCAL . 'layout/');

define(IB_USERS, 'users');
?>