<?php
if (!isset($_SESSION)) session_start();
include('functions.php');
if(!$_SESSION['user_Logged']['admin']) header('Location:403.php');


//Get the product from Id
$prod = get_product_by_id($_GET['productid']);


if (isset($_POST['btn-add_product'])) { 
    $date = new DateTime('now', new DateTimeZone('Europe/Madrid'));

    //Modify the product in teh array

    foreach ($_SESSION['products'] as $key => $p) {
        if($p == $prod){
            $_SESSION['products'][$key]['nom'] = $_POST['product_name'];
            $_SESSION['products'][$key]['desc'] = $_POST['product_desc'];
            $_SESSION['products'][$key]['hora'] = $date;
            $_SESSION['products'][$key]['preu'] = $_POST['product_price'];
        }
    }
    
    header('Location: products_controller.php');
}

 ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>Document</title>
    <!-- Bootsrat import-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>

<body>
    <?php require_once('templates/nav.php')?>
    <form action="#" method="post">
        <div class="mx-auto border p-5 col-4 bg-light">
            <h1>Modificar product</h1>
            <div class="form-group">
                <label for="exampleInputEmail1">Nom del producte</label>
                <input name="product_name" type="text" class="form-control" value="<?php echo $prod['nom']?>">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Descripció</label>
                <input name="product_desc" type="text" class="form-control" id="exampleInputPassword1" value="<?php echo $prod['desc']?>">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Preu</label>
                <input name="product_price" type="number" step="0.01" class="form-control" id="exampleInputPassword1" value="<?php echo $prod['preu']?>">
            </div>
            <a class="btn btn-dark mt-2" href='usersController.php'">Cancelar</a>
            <button type="submit" class="btn btn-primary mt-2" name="btn-add_product">Modificar</button>
            </br>

    </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>