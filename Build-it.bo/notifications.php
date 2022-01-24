<?php 
require_once 'bootstrap.php';

/* Checks if the user is logged in to update notifications */
if(isUserLoggedIn()) {
    $user_id = $_SESSION['user_id'];
    $permissions = $dbh->getUserPermissions($user_id)[0]['permissions'];

    /* Checks if the notification has been closed */
    if(isset($_POST['clicked'])) {
        if($permissions == 1) {
            $dbh->checkAdminNotifications((int)$_POST['clicked']);
        } else {
            $id = explode(" ", $_POST['clicked']);
            $dbh->checkUserNotifications((int)$id[0], (int)$id[1]);
        }
    }

    /* Gets all of the order made by an user to populate notifications */
    $orders = $dbh->getUserOrders($user_id);

    foreach($orders as $order) {
        $order_id = $order['id'];
        $start = strtotime($order['buy_date']);
        $end = strtotime($order['delivery_date']);
        $curr = strtotime(date("Y-m-d H:i:s"));

        /* Calculates the percentage of time passed */
        $percent = ($curr - $start) / ($end - $start);
        $step = $dbh->getStepUserNotifications($order_id);
        $last = 0;
        if(!empty($step)) $last = $step[0]['order_step'];

        /* Checks if the order has to be delivered */
        if($percent < 1) {
            /* Checks if the order is in the delivery state */
            if($percent >= 0.4) {
                $order_step = 2;
                $changed = $order_step - $last > 0 ? 1 : 0;
                /* Updates the step of a notification of a given order */
                $dbh->updateUserNotification($order_id, $order_step, $changed);
            } else if($percent >= 0.3) { /* Checks if the order is in the shipped state */
                $order_step = 1;
                $changed = $order_step - $last > 0 ? 1 : 0;
                /* Updates the step of a notification of a given order */
                $dbh->updateUserNotification($order_id, $order_step, $changed);
            } else if($percent < 0.3 && !$dbh->userNotificationAlreadyExists($user_id, $order_id)) {
                $dbh->addUserNotification($order_id, 0);
            }
        } else {
            $order_step = 3;
            $changed = $order_step - $last > 0 ? 1 : 0;
            /* Updates the step of a notification of a given order */
            $dbh->updateUserNotification($order_id, $order_step, $changed);
        }
    }

    $notifications = $permissions == 1 ? $dbh->getAdminNotifications() : $dbh->getUserNotifications($user_id);
    
    $out = "";

    /* Adds notifications to the page */
    if(isset($notifications) && !empty($notifications)) {
        $out .= '<div class="notification-wrapper">';
        foreach($notifications as $toast) {
            $text = $toast['text'];
            $item_id = $permissions == 1 ? $toast['id_product'] : $toast['id_order'];
            if($permissions == 0) $step = $toast['order_step'];

            if($permissions == 1) {
                $out .= '<div class="notification" id="notification-' .  $item_id . '">';
            } else {
                $out .= '<div class="notification" id="notification-' .  $item_id . " " . $step . '">';
            }

            $out .= '<div class="container-1">
                    <i class="check-square"></i>
                </div>
                <div class="container-2">
                    <p>Notifica</p>
                    <p>' . $text . " ID: " . $item_id . '</p>
                </div>';
            if($permissions == 1) {
                $out .= '<button id="' .  $item_id . '" onclick="closeNotification(this.id)">&times;</button>';
            } else {
                $out .= '<button id="' .  $item_id . " " . $step . '" onclick="closeNotification(this.id)">&times;</button>';
            } 
            $out .= '</div>';
        }
        $out .= '</div>';
    }

    echo $out;
}

?>