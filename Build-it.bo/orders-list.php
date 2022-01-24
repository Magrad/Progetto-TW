<?php
require_once 'bootstrap.php';

/* Checks if user is logged in otherwise redirect to main */
if(!isUserLoggedIn ()) {
    header("Location: main.php");
}

$templateParams['titolo'] = "Build-it - Lista Ordini";
$templateParams['nome'] = 'orders-list-form.php';
$templateParams['orders'] = $dbh->getUserOrders($_SESSION['user_id']);
if(isset($_SESSION['user_id'])) {
    $templateParams['permissions'] = $dbh->getUserPermissions($_SESSION['user_id']);
}
$templateParams['no-aside'] = true;
$templateParams['js'] = array('./js/show&hide.js', './js/search.js');

require './templates/base.php';
?>