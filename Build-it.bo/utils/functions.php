<?php

/* Checks if an user is already logged in */
function isUserLoggedIn(){
    return !empty($_SESSION['user_id']);
}

/* Checks if the page requires the ReCaptcha authentication */
function isReCaptchaRequired() {
    if(isset($_SERVER['PHP_SELF']) && basename($_SERVER['PHP_SELF']) == SIGNUP_URL) {
        return 1;
    }
    
    return 0;
}

/* Checks if the password is "strong" */
function checkPasswordIntegrity($password) {
    $msg = "";

    if (strlen($password) < 8) {
        $msg .= "Lunghezza Password 8-16 caratteri";
    } else if (!preg_match("@[0-9]@", $password)) {
        $msg .= "Password deve contenere un numero";
    }else if (!preg_match("@[a-z]@", $password)) {
        $msg .= "Password deve contenere una lettera minuscola";
    }else if (!preg_match("@[A-Z]@", $password)) {
        $msg .= "Password deve contenere una lettera maiuscola";
    } else if(!preg_match("@[^\w]@", $password)) {
        $msg .= "Password deve contenere un carattere speciale";
    }

    return $msg;
}

/* Checks if an item is already in the cart */
function checkItemIsAlreadyInCart($id) {
    if(isset($_SESSION['cart'])) {
        $cart = $_SESSION['cart'];

        foreach($cart as $item) {
            $id_item = $item[0];
            if($id_item == $id) return 1;
        }

        return 0;
    }
}

?>