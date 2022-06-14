<?php
require_once "App/User.php";
$errorMsg = null;
$successMsg = null;
if (isset($_REQUEST['rgs'])) {
    try {
        $userForRegister = new User();
        $userForRegister->setUsername = $_REQUEST['rgsUsername'];
        $userForRegister->setName = $_REQUEST['rgsName'];
        $userForRegister->setSurname = $_REQUEST['rgsSurname'];
        $userForRegister->setMail = $_REQUEST['rgsMail'];
        if ($userForRegister->validateInputs()) {
            $successMsg = "Inputs validated";
        }
    } catch (Exception $ex) {
        $errorMsg = $ex->getMessage();
    }
}
?>
<link rel="stylesheet" href="assets/css/all.min.css">
<link rel="stylesheet" href="assets/css/main.css">
<style>
    body {
        background: var(--background);
        display: flex;
        justify-content: center;
        align-items: center;
    }

    form {
        display: flex;
        flex-flow: column nowrap;
        align-items: center;
        width: 400px;
        max-width: 80vw;
        padding: 2em;
        border-radius: 5px;
        background: var(--white);
        -webkit-box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.25);
        -moz-box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.25);
        box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.25);
    }

    h3 {
        color: var(--dark);
        margin: .5em 0;
    }

    .inputDiv {
        position: relative;
        display: flex;
        flex-flow: row nowrap;
        align-items: center;
        width: 100%;
        margin: .5em 0;
    }

    .inputDiv i {
        position: absolute;
        color: var(--dark);
        left: .25em;
    }

    input {
        width: 100%;
        padding: .5em 2em;
        border: none;
        outline: none;
        color: var(--dark);
        border-bottom: 2px solid var(--grey);
        transition: .5s;
    }

    input[type="text"]:focus, input[type="password"]:focus, input[type="tel"]:focus, input[type="email"]:focus {
        border-bottom: 2px solid var(--blue);
    }

    input[type="submit"] {
        height: 2.5em;
        margin: 1em 0;
        background: var(--black);
        color: var(--background);
        border-radius: 50px;
        border-bottom: none;
        cursor: pointer;
    }

    input[type="submit"]:hover {
        background: var(--blue);
    }


    #successMsg, #errorMsg, #loader {
        display: block;
    }

    #successMsg {
        color: var(--green);
        font-weight: 500;
    }

    #errorMsg {
        color: var(--red);
        font-weight: 500;
    }
</style>
<form name="register" method="post">
    <h3>Validate Inputs</h3>
    <p id="successMsg"><?= $successMsg; ?></p>
    <p id="errorMsg"><?= $errorMsg; ?></p>
    <div class="inputDiv">
        <i class="fas fa-user"></i>
        <input type="text" name="rgsUsername"
               autocomplete="off"
               placeholder="Username">
    </div>
    <div class="inputDiv">
        <i class="fas fa-id-card"></i>
        <input type="text" name="rgsName"
               autocomplete="off"
               placeholder="Name">
    </div>
    <div class="inputDiv">
        <i class="fas fa-id-card"></i>
        <input type="text" name="rgsSurname"
               autocomplete="off"
               placeholder="Surname">
    </div>
    <div class="inputDiv">
        <i class="fas fa-at"></i>
        <input type="text"  name="rgsMail" autocomplete="off"
               placeholder="E-mail">
    </div>
    <input type="submit" name="rgs" value="Validate Inputs">
    <img id="loader" draggable="false" src="assets/css/ajax-loader.gif">
</form>
