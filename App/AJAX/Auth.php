<?php
error_reporting(0);
session_start();
spl_autoload_register(function ($class) {
    $class = str_replace("App\\", '..\\', $class);
    $class = str_replace('\\', "/", $class);
    if (is_file($class . '.php')) {
        require_once($class . '.php');
    }
});

use App\Controllers\User\{LoginController, RegisterController};
use App\Providers\Error;

if (isset($_REQUEST['type'])) {
    if ($_REQUEST['type'] === 'LoginviaUsername' || $_REQUEST['type'] === 'LoginviaMail' || $_REQUEST['type'] === 'LoginviaPhone')
        login();
    if ($_REQUEST['type'] === 'Register')
        register();
} else {
    echo Error::AUTH_TYPE_MISSING->message();
    exit();
}

function login()
{
    $login = LoginController::authenticate($_REQUEST);
    if (!is_a($login, Error::class)) {
        $_SESSION['login'] = $login;
        $loginInfo = array("id" => $login);
        echo json_encode($loginInfo);
    } else
        echo $login->message();
}

function register()
{
    $register = RegisterController::authenticate($_REQUEST);
    if (!is_a($register, Error::class)) {
        $registerInfo = array("id" => $register);
        echo json_encode($registerInfo);
    } else
        echo $register->message();
}