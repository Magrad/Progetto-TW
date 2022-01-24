<?php
require_once 'bootstrap.php';

/* Checks if the the search area needs to be cleaned */
if(isset($_GET['clear']) && $_GET['clear'] == 1 && isset($_SESSION['search']) && strlen($_SESSION['search']) > 0) {
    unset($_SESSION['search']);
}

/* Checks if an user wants to buy an item */
if(isset($_GET['buy'])) {
    $item = $dbh->getProductById($_GET['buy']);
    if(!isset($_SESSION['cart'])) $_SESSION['cart'] = array();

    if(!empty($item)) {
        if(checkItemIsAlreadyInCart($item[0]['id']) == 0) {
            array_push($_SESSION['cart'], array($item[0]['id'], 1));
        }
    }
    else $templateParams['global-error'] = "Errore: Articolo non trovato nel database";
}

$templateParams["titolo"] = "Build-it - Home";
$templateParams["nome"] = 'main-form.php';
$templateParams['articoli'] = $dbh->getProductsList();
$templateParams['main'] = true;

/* Checks if the user is logged in */
if(isset($_SESSION['user_id'])) {
    /* Shows notifications */
    $templateParams['permissions'] = $dbh->getUserPermissions($_SESSION['user_id']);
    if($templateParams['permissions'][0]['permissions'] == 1) {
        $templateParams['admin-notifications'] = $dbh->getAdminNotifications();
    }
}
$templateParams['js'] = array("./js/search.js", "./js/closeNotification.js");

require 'templates/base.php';