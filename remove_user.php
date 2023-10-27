<?php
if (!isset($_SESSION)) session_start(); 

if(!$_SESSION['user_Logged']['admin']) header('Location:403.php');

$user = eliminar_usuari($_GET['userid']);

if(!is_null($user)){
    $_SESSION['flash'] = "L'usuari ".$user['username'] . " s'ha eliminat correctament";
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    die();
}


function eliminar_usuari($username_id){
    foreach ($_SESSION['users'] as $key => $user) {
        if($user['id']==$username_id){
            unset($_SESSION['users'][$key]);
            return $user;
        }
    }
    return null;
}
?>