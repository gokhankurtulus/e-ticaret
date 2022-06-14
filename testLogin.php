<?php
require_once "App/User.php";
session_start();
if (isset($_REQUEST['logout']))
    unset($_SESSION['login']);
if (isset($_SESSION['login'])):
    $loginedUser = new User();
    $loginedUser->load($_SESSION['login']);
    ?>
    <pre>
    <?php print_r($loginedUser); ?>
    </pre>
    <form method="post"><button type="submit" name="logout" value="0">Logout</button></form>
<?php else: ?>
    <link rel="stylesheet" href="assets/css/all.min.css">
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="assets/css/jquery-ui.css">
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


        .formBottom {
            width: 100%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: .5em 0;
        }

        a {
            text-decoration: none;
            color: var(--dark);
            transition: .5s;
        }

        a:hover {
            color: var(--yellow);
        }

        label[for=_checkbox] {
            margin: .5em 0;
        }

        label[for=_checkbox] a {
            font-size: .6em;
        }

        input[id="_checkbox"] {
            margin: .5em 0;
        }

        .social-container {
            margin: 1em 0;
        }

        .social-container a {
            border: 1px solid #DDDDDD;
            border-radius: 50%;
            display: inline-flex;
            justify-content: center;
            align-items: center;
            margin: 0 5px;
            height: 40px;
            width: 40px;
        }

        #successMsg, #errorMsg, #loader {
            display: none;
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
    <form id="loginForm" name="login" method="post">
        <h3>Basic Login Form</h3>
        <p id="successMsg"></p>
        <p id="errorMsg"></p>
        <div class="inputDiv">
            <i class="fas fa-user"></i>
            <input type="text" name="lgnUsername" onkeypress="blockChars(this);" pattern=".{6,20}" title="6-20 character" autocomplete="off"
                   placeholder="Username" required>
        </div>
        <div class="inputDiv">
            <i class="fas fa-key"></i>
            <input type="password" name="lgnPassword" onkeypress="blockChars(this,'pw');" pattern=".{6,20}" title="6-20 character"
                   autocomplete="off"
                   placeholder="Password" required>
        </div>
        <input type="submit" name="lgn" value="Log In">
        <img id="loader" draggable="false" src="assets/css/ajax-loader.gif">
        <div class="formBottom">
            <a href="testRegister.php">Sign Up</a>
            <a href="">Forgot Password</a>
        </div>
        <div class="social-container">
            <a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
            <a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
            <a href="#" class="social"><i class="fab fa-linkedin-in"></i></a>
        </div>
    </form>
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/jquery-ui.js"></script>
    <script src="assets/js/login.js"></script>
<?php
endif;
?>
