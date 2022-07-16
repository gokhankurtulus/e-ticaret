<?php
error_reporting(1);
session_start();
ob_start();

if (isset($_REQUEST['logout']))
    unset($_SESSION['login']);

$providerPath = 'App/Providers/Provider.php';

if (is_file($providerPath))
    require_once $providerPath;

use App\Providers\{Provider};
use function App\Providers\view;
use App\Controllers\{User\UserController};

Provider::boot();

if (isset($_SESSION['login'])) {
    $loginedUser = UserController::get(['id' => $_SESSION['login']]);
    if (!is_a($loginedUser, Error::class)) {
        $GLOBALS['loginedUser'] =
            [
                'id' => $loginedUser->getID(),
                'username' => $loginedUser->getUsername(),
                'name' => $loginedUser->getName(),
                'verified' => $loginedUser->getVerified(),
                'role' => $loginedUser->getRole()
            ];
    }
}


if ($GLOBALS['route']->getPage() == 'login')
    view("Page/login.phtml");
else if ($GLOBALS['route']->getPage() == 'register')
    view("Page/register.phtml");
else if ($GLOBALS['route']->getPage() == 'logout') {
    view("Page/logout.phtml");
} else if ($GLOBALS['route']->getPage() == 'panel')
    view("Panel/layout/panel.phtml");
else
    view("Page/layout/page.phtml");
?>