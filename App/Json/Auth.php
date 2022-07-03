<?php

namespace App\Json\TestAJAX;
error_reporting(0);
session_start();
spl_autoload_register(function ($class) {
    $class = str_replace("App\\", '..\\', $class);
    $class = str_replace('\\', "/", $class);
    if (is_file($class . '.php')) {
        require_once($class . '.php');
    }
});

use App\Controllers\User\LoginController;
use App\Providers\Error;

if (isset($_REQUEST['type'])) {
    if ($_REQUEST['type'] === 'LoginviaUsername' || $_REQUEST['type'] === 'LoginviaMail' || $_REQUEST['type'] === 'LoginviaPhone')
        login();
    if ($_REQUEST['type'] === 'register') ;
    //register();
    if ($_REQUEST['type'] === 'logout') ;
    //logout();
}
function login()
{
    if (isset($_REQUEST['type'])) {
        if ($_REQUEST['type'] === 'LoginviaUsername')
            $login = LoginController::authenticate($_REQUEST);
        else if ($_REQUEST['type'] === 'LoginviaMail')
            $login = LoginController::authenticate($_REQUEST);
        else if ($_REQUEST['type'] === 'LoginviaPhone')
            $login = LoginController::authenticate($_REQUEST);
        else {
            echo Error::AUTH_TYPE_MISSING->message();
            exit();
        }
        if (!is_a($login, Error::class)) {
            $_SESSION['login'] = $login;
            $loginInfo = array("id" => $login);
            echo json_encode($loginInfo);
        } else
            echo $login->message();
    }
}