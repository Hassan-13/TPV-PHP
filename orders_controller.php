<?php
if (!isset($_SESSION)) session_start();
include_once('./functions.php');

if(!$_SESSION['user_Logged']['admin']) header('Location:403.php');

if (isset($_GET['userid'])) {
    $filter_user = get_user_by_id($_GET['userid']);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comandes | TPV</title>
    <!--Bootsrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>

<body>
    <?php require_once('templates/nav.php'); ?>
    <div class="buttons table mx-auto my-5 d-flex justify-content-between" style="width: 60vw;">
        <button type="button" class="btn btn-dark" onclick="window.location.href='adminView.php'"><i class="bi bi-arrow-left"></i>Tornar</button>
        <select class="bg-transparent border px-3" aria-label="Default select example">
            <option selected disabled>Selecciona un treballador</option>
            <option onclick="window.location.href='?userid=tots'">Tots</option>
            <?php
            foreach ($_SESSION['users'] as $user) {
                if (!$user['admin']) { ?>
                    <option onclick="window.location.href='?userid=<?php echo $user['id'] ?>'"><?php echo $user['username'] ?></option>
                    
            <?php }
            }
            ?>
        </select>
        <span></span>
        <!--<button type="button" class="btn btn-primary" onclick="window.location.href='register.php'">Afegir Comanda</button>-->
    </div>
    <p  class="text-left mx-auto" style="width: 60vw; font-size:14px;">*Pot ser que hi hagin id's repetitis ja que començen des de 1 per cada usuari independenment </p>
    <table class="table mx-auto" style="width: 60vw;">
        <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Treballador</th>
                <th scope="col">Hora</th>
                <th scope="col">Import</th>
            </tr>
        </thead>
        <tbody class="table-group-divider">
            <?php
            if(isset($filter_user)){
                foreach ($filter_user['orders'] as $order) {
                    ?>
                        <tr>
                            <th><?php echo $order['order_id'] ?></th>
                            <th><?php echo $filter_user['username']?></th>
                            <td><?php echo $order['order_time']->format("d/m/Y - h:i:s") ?></td>
                            <td><?php echo $order['order_total'] . "€" ?></td>
                            <td>
                                <?php echo '<td><a href="./remove_order.php?userid=' . $filter_user['id'] . '&orderid=' .  $order['order_id'] . '" role="button"><i class="bi bi-trash-fill"></i></a></td>'; ?>
                            </td>
                        </tr>
                    <?php
                    }
            }else{
                foreach ($_SESSION['users'] as $user) {
                    if (!$user['admin']) {
                        foreach ($user['orders'] as $order) {
                            ?>
                                <tr>
                                    <th><?php echo $order['order_id'] ?></th>
                                    <th><?php echo $user['username']?></th>
                                    <td><?php echo $order['order_time']->format("d/m/Y - h:i:s") ?></td>
                                    <td><?php echo $order['order_total'] . "€" ?></td>
                                    <td>
                                        <?php echo '<td><a href="./view_order.php?userid=' . $user['id'] . '&orderid=' .  $order['order_id'] . '" role="button"><i class="bi bi-eye-fill"></i></a></td>'; ?>
                                    </td>
                                    <td>
                                        <?php echo '<td><a href="./remove_order.php?userid=' . $user['id'] . '&orderid=' .  $order['order_id'] . '" role="button"><i class="bi bi-trash-fill"></i></a></td>'; ?>
                                    </td>
                                </tr>
                            <?php
                        }
                    }
                }
            }
            ?>
        </tbody>
    </table>
    <!--Bootsrap-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>
