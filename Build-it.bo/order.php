<?php
require_once 'bootstrap.php';

/* Checks if user is logged in otherwise requires authentication */
if(!isUserLoggedIn()) {
    header("Location: login.php?auth=1");
    exit;
}

$address = $dbh->getUserInformations($_SESSION['user_id'], $_SESSION['user_email'])[0]['address'];

/* Checks if the user has an address related to the account */
if(!$address || empty($address)) {
    header("Location: settings.php?address=1");
    exit;
}

$elements = array();
$tot = 0;
/* Gets total price */
if(isset($_SESSION['cart'])) {
    foreach($_SESSION['cart'] as $id) {
        $item = $dbh->getProductById($id[0])[0];
        array_push($elements, array($item, $id[1]));
        $tot += $item['price'];
    }
}

/* Checks if the submit button to order has been clicked */
if(isset($_POST['order']) && isset($_SESSION['cart'])) {
    $cart = $_SESSION['cart'];
    $check = true;
    $name = "";
    $user_id = $_SESSION['user_id'];
    $buy_date = date("Y-m-d H:i:s");

    foreach($cart as $item) {
        $id = $item[0];
        $quantity = $item[1];

        if($quantity > $dbh->getProductQuantity($id)) {
            $check = false;
            $name = $dbh->getProductName($id)[0]['name'];
        }
    }
    /* Checks if item is in stock */
    if($check) {
        $order = $dbh->getNewOrderId()['id'];
        $order++;

        /* Creates for each item an information list to create an order */
        foreach($cart as $item) {
            $id = $item[0];
            $quantity = $item[1];
            $tot_price = (float)$dbh->getProductDiscountedPrice($id) * $quantity;
            
            if($quantity > 0) {
                $result = $dbh->addNewProductsList($order, $id, $quantity, $tot_price);
            }
        }

        /* Gets all the lists of items of the same order */
        $item_list = $dbh->getOrderProductsList($order);
        $tot_price = (float)0;

        if(!empty($item_list)) {
            foreach($item_list as $item) {
                $tot_price += $item['price'];
            }

            $result = $dbh->addNewOrder($tot_price, "", $user_id, $buy_date);

            if($result) {
                foreach($cart as $item) {
                    $id = $item[0];
                    $result = $dbh->reduceProductQuantity($id);
                    $item_quantity = $dbh->getProductQuantity($id)[0]['quantity'];
                    /* Checks if the quantity of an items reaches 0 push a notification to the admins */
                    if($item_quantity == 0) {
                        if($dbh->adminNotificationAlreadyExists($id)) {
                            $dbh->uncheckAdminNotifications($id);
                        } else {
                            $dbh->addAdminNotification($id);
                        }
                    }
                }
            }

            /* Clear the cart */
            unset($_SESSION['cart']);

            $dbh->addUserNotification($_SESSION['user_id'], $order, 0);

            header("Location: orders-list.php");
            exit;
        }
    } else {
        $templateParams['global-error'] = 'Errore in scorte richieste per "' . $name . '"';
    }
}

$templateParams['titolo'] = "Build-it - Order";
$templateParams['nome'] = 'cart-form.php';
$templateParams['ordine'] = $dbh->getNewOrderId();
if(isset($_SESSION['user_id'])) {
    $templateParams['permissions'] = $dbh->getUserPermissions($_SESSION['user_id']);
}
$templateParams['articoli'] = $elements;
$templateParams['js'] = array('./js/order.js', './js/search.js');
$templateParams['tot'] = $tot;
$templateParams['no-aside'] = true;

require 'templates/base.php';
?>