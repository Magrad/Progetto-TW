<?php
require_once 'bootstrap.php';

if(isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['verify-password']) && isset($_POST['g-recaptcha-response'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $verify_password = $_POST['verify-password'];
    $recaptcha = $_POST['g-recaptcha-response'];

    if(empty($username)) {
        $templateParams['error'] = "Campo Username richiesto";
    } else if(empty($email)) {
        $templateParams['error'] = "Campo Email richiesto";
    } else if(empty($password)) {
        $templateParams['error'] = "Campo Password richiesto";
    } else if(empty($verify_password)) {
        $templateParams['error'] = "Campo Verifica Password richiesto";
    } else if(empty($recaptcha)) {
        $templateParams['error'] = "Risolvi verifica reCAPTCHA";
    } else {
        $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".HIDDEN_KEY."&response=".$recaptcha);

        $data = json_decode($response);
        $password_integrity = checkPasswordIntegrity($password);

        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $templateParams['error'] = "Email invalida";
        } else if(!$dbh->isEmailAvailable($email)) {
            $templateParams['error'] = "Email già in uso";
        } else if($password_integrity != "") {
            $templateParams['error'] = $password_integrity;
        } else if($password != $verify_password) { 
            $templateParams['error'] = "Passwords non coincidono";
        } else if(!$data->success) {
            $templateParams['error'] = "Errore durante registrazione";
        } else {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $return = $dbh->createNewAccount($username, $hashed_password, $email);
            $return = $dbh->authentication($email);
            $user = $return[1][0];
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_username'] = $user['username'];
            $_SESSION['user_email'] = $user['email'];

            $templateParams['success'] = "Registrazione effettuata";
            header('Refresh: 3; URL=main.php');
        }
        
    }
}

$templateParams['titolo'] = "Build-it - Register";
$templateParams['nome'] = 'register-form.php';
$templateParams['js'] = array('./js/search.js');
if(isset($_SESSION['user_id'])) {
    $templateParams['permissions'] = $dbh->getUserPermissions($_SESSION['user_id']);
}
$templateParams['no-aside'] = true;

require 'templates/base.php';
?>