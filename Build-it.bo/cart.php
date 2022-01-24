<?php 
require_once 'bootstrap.php';

$elements = array();

/* Checks if the variabile cart has already been initialized */
if(isset($_SESSION['cart'])) {
    $keys = array_keys($_SESSION['cart']);
    $cart = $_SESSION['cart'];

    $count = 0;
    for($i=0;$i<count($cart);$i++) {
        $item = $cart[$i];
        if(isset($_POST[$item[0]])) {
            /* Removes an object from the cart if 
               the button is pressed */
            array_splice($_SESSION['cart'], $i, 1);
        } else {
            /* Gets item informations by the ID present 
               in the cart variable session */
            $item = $dbh->getProductById($item[0])[0];
            array_push($elements, array($item, 1));
        }
        $count++;
    }
}

$templateParams["titolo"] = "Build-it - Cart";
$templateParams["nome"] = 'cart-form.php';
if(isset($_SESSION['user_id'])) {
    $templateParams['permissions'] = $dbh->getUserPermissions($_SESSION['user_id']);
}
$templateParams['articoli'] = $elements;
$templateParams['js'] = array('./js/order.js', './js/search.js');
$templateParams['no-aside'] = true;

require './templates/base.php'
?>