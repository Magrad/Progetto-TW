<?php
require_once 'bootstrap.php';

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    /* Gets product informations */
    $product = $dbh->getProductById($id);

    if(!empty($product)) {
        $templateParams['product'] = $product[0];
    }    
}

$templateParams['titolo'] = "Build-it - Prodotto";
$templateParams['nome'] = 'product-form.php';
if(isset($_SESSION['user_id'])) {
    $templateParams['permissions'] = $dbh->getUserPermissions($_SESSION['user_id']);
}
$templateParams['js'] = array('./js/search.js');

require './templates/base.php';
?>