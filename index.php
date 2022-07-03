<?php
error_reporting(1);
session_start();

$requestUrl = $_SERVER['REQUEST_URI'];
try {
    $parsed_url = explode('/', $requestUrl);
    $params['page'] = $parsed_url[2];
    $params['value'] = $parsed_url[3];
    $params['sort'] = $parsed_url[4];
    $params['val'] = $parsed_url[5];
} catch (Exception $exception) {
}

spl_autoload_register(function ($class) {
    if (is_file($class.'.php')) {
        require_once($class.'.php');
    }
});

use App\Models\{User};
use App\Providers\{Provider, Role, Route, Assets, Functions, Error};
use App\Controllers\{UserController, User\LoginController};

Provider::boot();

//    $user = UserController::get(['username' => 'gokhankurtulus']);
//    echo $user->getName();


//    if (isset($_REQUEST['username'])) {
//        var_dump($_REQUEST);
//        $user = UserController::get($_REQUEST);
//        echo $user->getName();
//    }

//    UserController::delete(['id'=>37]);
//    $user = UserController::update(identifier: ['username' => 'gokhan3kurtulus', 'name' => 'Gökhan'], where: ['id' => 1, 'username' => 'gokhan2kurtulus']);
//    var_dump($user);
//    $user = UserController::get(['username' => 'gokhankurtulus']);
//    if ($user)
//        echo $user->getName();
//    $users = UserController::search('name', 'gok');
//    echo '<pre>';
//    var_dump($users);
//    echo '</pre>';
//    $atts = ['name'=>'Gökhan','surname'=>'kurtulus','phone'=>1234];
//    $sonuc =  UserController::create($atts);
//    var_dump($sonuc);
//echo Functions::isStringLenghtBetween('heyasdasd',6,20);
if (isset($_REQUEST['type'])) {
    if ($_REQUEST['type'] === 'LoginviaUsername') {
        $login = LoginController::authenticate($_REQUEST);
    }
    if ($_REQUEST['type'] === 'LoginviaMail') {
        $login = LoginController::authenticate($_REQUEST);
    }
    if ($_REQUEST['type'] === 'LoginviaPhone') {
        $login = LoginController::authenticate($_REQUEST);
    }
    if (!is_a($login, Error::class))
        var_dump($login);
    else
        echo $login->message();
}
?>
<form method="post">
    <input type="hidden" name="type" value="LoginviaUsername">
    <input type="text" name="username" value="">
    <input type="text" name="password" value="">
    <input type="submit" name="login">
</form>

<form method="post">
    <input type="hidden" name="type" value="LoginviaMail">
    <input type="text" name="mail" value="">
    <input type="text" name="password" value="">
    <input type="submit" name="login">
</form>
<form method="post">
    <input type="hidden" name="type" value="LoginviaPhone">
    <input type="text" name="phone" value="">
    <input type="text" name="password" value="">
    <input type="submit" name="login">
</form>
