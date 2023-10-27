<?php

function validateUser($unm, $pwd){
    foreach ($_SESSION['users'] as $user) {
        if($user['username']==$unm && $user['password']==$pwd){
            return $user;
        }
    }
    return null;
}

function getNewUSerId(){
    $lastUser = end($_SESSION['users']);
    return  $lastUser['id'] + 1;
}

function get_new_product_id(){
    $lastUser = end($_SESSION['products']);
    if(sizeof($_SESSION['products'])<1){
        return 1;
    }
    return  $lastUser['id'] + 1;
}

function get_new_order_id(){
    $last_order = end($_SESSION['user_Logged']['orders']);
    if(sizeof($_SESSION['user_Logged']['orders'])<1){
        return 1;
    }
    return  $last_order['order_id'] + 1;
}

function get_new_line_id(){
    $last_line = end($_SESSION['order_lines']);
    if(sizeof($_SESSION['order_lines'])<1){
        return 1;
    }
    return  $last_line['id'] + 1;
}

function get_total_order(){
    $total = 0;
    foreach ($_SESSION['order_lines'] as $order) {
        $total = $total + $order['total'];
    }
    return $total;
}


function get_product_by_id($product_id){
    foreach ($_SESSION['products'] as $p) {
        if($p['id'] == $product_id){
            return $p;
        }
    } ;    
    return null;
}

function get_user_by_id($user_id){
    foreach ($_SESSION['users'] as $user) {
        if($user['id'] == $user_id){
            return $user;
        }
    } ;    
    return null;
}

?>
