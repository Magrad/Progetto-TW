<?php
require_once 'bootstrap.php';

/* Checks if the user is logged in and wants to logout */
if(isset($_GET['logout']) && $_GET['logout'] == 1) {
    session_destroy();
    header("Location: main.php");
}

/* Checks if the user is logged in to perform an order */
if(isset($_GET['auth']) && $_GET['auth'] == 1) {
    $templateParams['global-error'] = "Autenticazione richiesta per creare un ordine";
}

/* Checks if a user is trying to log-in */
if(isset($_POST['username']) && isset($_POST['password'])) {
    $email = $_POST['username'];
    $password = $_POST['password'];

    /* Checks if the email and password fields are empty */
    if(empty($email)) {
        $templateParams['error'] = "Campo Email vuoto";
    } else if(empty($password)) {
        $templateParams['error'] = "Campo Password vuoto";
    } else {
        $return = $dbh->authentication($email, $password);

        if(!$return[0]) {
            $user = $return[1][0];

            $user_id = $user['id'];
            $user_username = $user['username'];
            $user_email = $user['email'];
            $user_password = $user['password'];

            /* If the email and password are correct create a new session */
            if($email == $user_email) {
                if(password_verify($password, $user_password)) {
                    $_SESSION['user_id'] = $user_id;
                    $_SESSION['user_username'] = $user_username;
                    $_SESSION['user_email'] = $user_email;
                    header("Location: main.php");
                } else {
                    $templateParams['error'] = "Username o Password errati";
                }
            } else {
                $templateParams['error'] = "Username o Password errati";
            }
        } else {
            $templateParams['error'] = $return[1];
        }
    }
}

$templateParams['titolo'] = "Build-it - Login";
$templateParams['nome'] = 'login-form.php';
$templateParams['js'] = array('./js/search.js');
if(isset($_SESSION['user_id'])) {
    $templateParams['permissions'] = $dbh->getUserPermissions($_SESSION['user_id']);
}
$templateParams['no-aside'] = true;

require 'templates/base.php'
?>