<?php
if (!isset($_SESSION)) session_start();
include('functions.php');

if(!$_SESSION['user_Logged']['admin']) header('Location:403.php');


if (isset($_POST['btn-register'])) {
    //Validation for duplicate username
    foreach ($_SESSION['users'] as $user) {
        if($_POST['username'] == $user['username']){
            $user_exist = true;
        }
        if($_POST['password'] == ''){
            $pwd_empty = true;
        }
        
    }

    if(!isset($user_exist) && !isset($pwd_empty)){
        $date = new DateTime('now', new DateTimeZone('Europe/Madrid'));
        $admin = false;
        if (isset($_POST['admin'])) {
            $admin = true;
            $user = array(
                "id" => getNewUSerId(),
                "username" => $_POST['username'],
                "password" => $_POST['password'],
                "admin" => $admin
            );
    }else{
        $user = array(
            "id" => getNewUSerId(),
            "username" => $_POST['username'],
            "password" => $_POST['password'],
            "admin" => $admin,
            "hora" => $date,
            "orders" => array()
        );
    }
    

    $_SESSION['users'][] = $user;
    
    header('Location:users_controller.php');
    }
    
}
 ?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=ç, initial-scale=1.0">
    <title>Document</title>
    <!-- Bootsrat import-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>

<body>
    <?php require_once('templates/nav.php')?>
    <form action="#" method="post">
        <div class="mx-auto border p-5 col-4 bg-light">
            <h1>Register</h1>
            <div class="form-group">
                <label for="exampleInputEmail1">Username</label>
                <input name="username" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Username">
                <?php
                    if(isset($user_exist)){
                        echo '<small class="text-danger">Aquest nom ja està en ús!</small>';
                    }
                ?>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Password:</label>
                <input name="password" type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                <?php
                    if(isset($pwd_empty)){
                        echo '<small class="text-danger">La contrasenya no pot estar buida!</small>';
                    }
                ?>
            </div>
            <div class="form-check">
                <input name="admin" class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                <label class="form-check-label" for="flexCheckDefault">
                    Admin
                </label>
            </div>
            <a class="btn btn-dark mt-2" href='users_controller.php'">Cancel</a>
            <button type="submit" class="btn btn-primary mt-2" name="btn-register">Register</button>
            </br>
    </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>