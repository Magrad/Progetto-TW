<?php 
require_once 'bootstrap.php';

$templateParams['titolo'] = "Build-it - Contatti";
$templateParams['nome'] = 'contatti-form.php';
$templateParams['js'] = array('./js/search.js');

if(isset($_SESSION['user_id'])) {
    $templateParams['permissions'] = $dbh->getUserPermissions($_SESSION['user_id']);
}

require 'templates/base.php';
?>