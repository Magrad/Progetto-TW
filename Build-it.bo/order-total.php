<?php 
require_once 'bootstrap.php';

$tot_price = (float)0;
$tot_quantity = 0;
$tot_savings = (float)0;
$name = $_POST['title'];
$CONST_NAME = SITE_NAME . " - Order";
$msg = "";

/* Checks if the product quantity in the cart is changed */
if(isset($_POST['product_id']) && isset($_POST['quantity']) && isset($_POST['title']) && isset($_SESSION['cart'])) {
    $id = $_POST['product_id'];
    $quantity = (int)$_POST['quantity'];
    $cart = $_SESSION['cart'];
    $name = $_POST['title'];
    $found = false;

    /* Updates the new item quantity based on the number of item ordered */
    for($i=0;$i<count($cart);$i++) {
        $item_id = $cart[$i][0];

        if($id == $item_id) {
            $found = true;
            if($quantity > 0) {
                $_SESSION['cart'][$i][1] = $quantity;
            } else {
                array_splice($_SESSION['cart'], $i, 1);
            }
        }
    }

    if(!$found && $quantity != 0) {
        array_push($_SESSION['cart'], array($id, 1));
    }
} 

/* Checks if update to cart informations are required */
if(isset($_SESSION['cart'])) {
    $cart = $_SESSION['cart'];

    /* Adds new items price, discounts and tot price to the*/
    foreach($cart as $item) {
        $id = $item[0];
        $quantity = (int)$item[1];
        $tot_quantity += $quantity;
        $price = $dbh->getProductPrice($id)[0];
        $tot_price += $dbh->getProductDiscountedPrice($id) * $quantity;
    }

    $msg .= '<p>
        <span>Prezzo totale:</span>
        <span id="result-price">' . $tot_price . '€</span>
    </p>
    <p>
        <span>Numero di prodotti:</span>
        <span id="result-quantity">' . $tot_quantity . '</span>
    </p>';
    if($tot_savings > 0) {
        $msg .= '<p>
            <span>Risparmi:</span>
            <span id="result-saving">' . $tot_savings . '€</span>
        </p>';
    }

    if($name != $CONST_NAME && isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
        $msg .= "<a href=\"order.php\" class=\"submit\">Ordina</a>";
    } else if($name == $CONST_NAME) {
        $msg .= "<input type=\"submit\" class=\"submit procede\" id=\"order\" name=\"order\" value=\"Procedi all'ordine\">";
    }
}

echo $msg;

?>