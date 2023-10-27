<?php
if (!isset($_SESSION)) session_start();
//unset($_SESSION['products']);

if(!$_SESSION['user_Logged']['admin']) header('Location:403.php');

/*echo '<pre>';
var_dump($_SESSION['products']);
echo '</pre>';*/

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UsersList | TPV</title>
    <!--Bootsrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>

<body>
    <?php require_once('templates/nav.php'); ?>
    <div class="buttons table mx-auto my-5 d-flex justify-content-between" style="width: 60vw;">
        <button type="button" class="btn btn-dark" onclick="window.location.href='adminView.php'"><i class="bi bi-arrow-left"></i>Tornar</button>
        <button type="button" class="btn btn-primary" onclick="window.location.href='add_product.php'">Afegir producte</button>
    </div>
    <?php if(isset($_SESSION['flash'])){ ?>
        <div class="">
            <p class="text-success text-center"><?php echo $_SESSION['flash'];?></p>
        </div>
        <?php unset($_SESSION['flash']); ?>
    <?php };?>
    <table class="table mx-auto" style="width: 60vw;">
        <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Nom</th>
                <th scope="col">Drescripció</th>
                <th scope="col">Ultima modificació</th>
                <th scope="col">Preu</th>
            </tr>
        </thead>
        <tbody class="table-group-divider">
            <?php foreach ($_SESSION['products'] as $product) { ?>
                <tr>
                    <th><?php echo $product['id'] ?></th>
                    <td><?php echo $product['nom'] ?></td>
                    <td><?php echo $product['desc'] ?></td>
                    <td><?php echo $product['hora']->format("d/m/Y - h:i:s") ?></td>
                    <td><?php echo $product['preu'] . "€" ?></td>
                    <td>
                        <?php echo '<td><a href="./edit_product.php?productid=' .  $product['id'] . '" role="button"><i class="bi bi-pencil-fill"></i></a></td>'; ?>
                    </td>
                    <td>
                        <?php echo '<td><a href="./remove_product.php?productid=' .  $product['id'] . '" role="button"><i class="bi bi-trash-fill"></i></a></td>'; ?>
                    </td>

                </tr>
            <?php } ?>
        </tbody>
    </table>
    <!--Bootsrap-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>
