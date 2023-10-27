<?php
if (!isset($_SESSION)) session_start(); 

if(!$_SESSION['user_Logged']['admin']) header('Location:403.php');

$product = eliminar_usuari($_GET['productid']);

if(!is_null($product)){
    $_SESSION['flash'] = "El producte ".$product['nom'] . " s'ha eliminat correctament";
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    die();
}


function eliminar_usuari($product_id){
    foreach ($_SESSION['products'] as $key => $product) {
        if($product['id']==$product_id){
            unset($_SESSION['products'][$key]);
            return $product;
        }
    }
    return null;
}
?>