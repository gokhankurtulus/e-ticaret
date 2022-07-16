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

use App\Controllers\Category\{CategoryController};
use App\Providers\{Error};

if (isset($_REQUEST)) {
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        if (isset($_REQUEST['id'])) {
            $update = CategoryController::update($_REQUEST, ['id' => $_REQUEST['id']]);
            if (!is_a($update, Error::class)) {
                $updateInfo = array("status" => $update);
                echo json_encode($updateInfo);
            } else
                echo $update->message();
        } else
            echo Error::ID_MISSING->message();
    }
    if ($_SERVER["REQUEST_METHOD"] === "DELETE") {
        //parse_str(file_get_contents("php://input"), $var);
        //var_dump($var); TODO eklenecek
        echo 'eklenecek';
    }
}