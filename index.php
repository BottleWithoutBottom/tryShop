<?
require './local/modules/define.const.php';
spl_autoload_register(function ($class_name) {
    include $class_name . '.php';
});
use local\core\Router;

session_start();
$router = new Router();
$router->executeRouter();
?>