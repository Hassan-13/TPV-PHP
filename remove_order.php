<?php
    if(!isset($_SESSION)) session_start();

    //REmovigng from user_Logged to refresh the last 5 orders array to show
    if(!$_SESSION['user_Logged']['admin']){
        foreach ($_SESSION['user_Logged']['orders'] as $index => $order) {
            if ($_GET['orderid'] == $order['order_id']) {
                unset($_SESSION['user_Logged']['orders'][$index]);
            }
        }
    }

    foreach ($_SESSION['users'] as $key => $user) {
        if ($_GET['userid'] == $user['id']) {
            foreach ($user['orders'] as $index => $o) {
                if ($_GET['orderid'] == $o['order_id']) {
                    unset($_SESSION['users'][$key]['orders'][$index]);
                    header('location:' . $_SERVER['HTTP_REFERER']);
                }
            }
        }
    }


    
?>