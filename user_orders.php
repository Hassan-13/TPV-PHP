<?php
if (!isset($_SESSION)) session_start();
//unset($_SESSION['products']);
// echo '<pre>';
// var_dump($_SESSION['users']['1']['orders']);
// echo '</pre>';
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
    <?php require_once('templates/nav_tpv.php'); ?>
    <div class="buttons table mx-auto my-5 d-flex justify-content-between" style="width: 60vw;">
        <button type="button" class="btn btn-dark" onclick="window.location.href='tpv.php'"><i class="bi bi-arrow-left"></i>Tornar</button>
    </div>
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
            foreach ($_SESSION['users'] as $index => $user) {
                if ($user['id'] == $_SESSION['user_Logged']['id']) {
                    foreach ($user['orders'] as $order) {
            ?>
                        <tr>
                            <th><?php echo $order['order_id'] ?></th>
                            <th><?php echo $_SESSION['user_Logged']['username'] ?></th>
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
            } ?>
        </tbody>
    </table>
    <!--Bootsrap-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>
