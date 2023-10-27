<?php
if (!isset($_SESSION)) session_start();

if(!$_SESSION['user_Logged']['admin']) header('Location:403.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | TPV</title>
    <!--Bootsrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>

<body>
    <?php require_once('templates/nav.php'); ?>
    <header class="p-4 bg-secondary text-light border-top border-light">
        <h1 class="text-center "> <strong><?php echo $_SESSION['user_Logged']['username'] ?> </strong> - Panell de control del TPV</h1>
    </header>
    <section class="d-flex mt-5" style="height:30vh;">
        <a href="products_controller.php" style="text-decoration:none; font-size:30px;" class="text-white products border px-5 py-3 w-100 bg-dark align-middle d-flex align-items-center justify-content-center"><i class="bi bi-basket2 p-3"></i>Products</a>
        <a href="users_controller.php" style="text-decoration:none; font-size:30px;" class="text-white users border px-5 py-3 w-100 bg-dark d-flex align-items-center justify-content-center"><i class="bi bi-people p-3"></i>Usuaris</a>
        <a href="orders_controller.php" style="text-decoration:none; font-size:30px;" class="text-white orders border px-5 py-3 w-100 bg-dark d-flex align-items-center justify-content-center"><i class="bi bi-cart-check p-3"></i>Comandes</a>
    </section>
    <!--Bootsrap-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>