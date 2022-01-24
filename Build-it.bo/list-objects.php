<?php
require_once 'bootstrap.php';

/* Checks if the action has been completed successfully */
if(isset($_GET['success']) && $_GET['success'] == 0) {
    $templateParams['global-success'] = "Azione eseguita con successo";
}

/* Checks if the action has ended with an error */
if(isset($_GET['success']) && $_GET['success'] == 1) {
    $templateParams['global-error'] = "Errore durante l'esecuzione dell'azione";
}

/* Checks if the user is logged in or if the user has the right permissions */
if(!isUserLoggedIn() || $dbh->getUserPermissions($_SESSION['user_id'])[0]['permissions'] != 1) {
    header("Location: main.php");
}

$templateParams['titolo'] = "Build-it - Lista Prodotti";
$templateParams['nome'] = 'list-objects-form.php';
$templateParams['articoli'] = $dbh->getProductsList();
$templateParams['js'] = array('./js/search.js');
if(isset($_SESSION['user_id'])) {
    $templateParams['permissions'] = $dbh->getUserPermissions($_SESSION['user_id']);
}

require './templates/base.php';
?>