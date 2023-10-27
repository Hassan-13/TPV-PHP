<?php
if (!isset($_SESSION)) session_start();

foreach ($_SESSION['users'] as $u) {
    if ($_GET['userid'] == $u['id']) {
        foreach ($u['orders'] as $o) {
            if ($_GET['orderid'] == $o['order_id']) {
                $order = $o;
                $user = $u;
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UsersList | TPV</title>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>

<body>
    <?php require_once('templates/nav_tpv.php'); ?>
    <div class="buttons table mx-auto my-5 d-flex justify-content-between" style="width: 60vw;">
        <?php
        if ($_SESSION['user_Logged']['admin']) {
        ?>
            <button type="button" class="btn btn-dark" onclick="window.location.href='orders_controller.php'"><i class="bi bi-arrow-left"></i>Tornar</button>
        <?php
        } else {
        ?>
            <button type="button" class="btn btn-dark" onclick="window.location.href='user_orders.php'"><i class="bi bi-arrow-left"></i>Tornar</button>
        <?php
        }
        ?>
    </div>
    <div class="buttons table mx-auto my-5 d-flex justify-content-between" style="width: 60vw;">
        <span style="font-size: 30px;font-weight:800;">#<?php if (isset($order)) echo $order['order_id']; ?></span>
        <span style="font-size: 30px;font-weight:800;"><?php if (isset($user)) echo $user['username']; ?></span>
        <span style="font-size: 30px;font-weight:800;"><?php if (isset($order)) echo $order['order_time']->format("d/m/Y - h:i:s"); ?></span>
        <span style="font-size: 30px;font-weight:800;"><?php if (isset($order)) echo $order['order_total']; ?>€</span>
    </div>
    <table class="table mx-auto" style="width: 60vw;">
        <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Producte</th>
                <th scope="col">Quantitat</th>
                <th scope="col">Preu individual</th>
                <th scope="col">Preu total</th>
            </tr>
        </thead>
        <tbody class="table-group-divider">
            <?php
            if (isset($order)) {
                foreach ($order['order_lines'] as $line) {
            ?>
                    <tr>
                        <th><?php echo $line['id']; ?></th>
                        <th><?php echo $line['name']; ?></th>
                        <th><?php echo $line['quantity']; ?></th>
                        <td><?php echo $line['price'] . "€"; ?></td>
                        <td><?php echo $line['total'] . "€"; ?></td>
                    </tr>
            <?php
                }
            }
            ?>
        </tbody>
    </table>
    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>
