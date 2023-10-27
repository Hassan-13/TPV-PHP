<?php
if (!isset($_SESSION)) session_start();
include('functions.php');

//Validate if user is logged
if(!isset($_SESSION['user_Logged'])) header('Location:403.php');

//Local time at the moment
$date = new DateTime('now', new DateTimeZone('Europe/Madrid'));

/*echo '<pre>';
var_dump($_SESSION['order_lines']);
echo '</pre>';*/

//Creating a single order
if(!isset($_SESSION['order_lines'])){
    $_SESSION['order_lines'] = [];
}

//When the products are called
if (isset($_GET['id_prod'])) {
    $prod = get_product_by_id($_GET['id_prod']);
}

//When the button 'afegir producte' is called
if (isset($_GET['add_prod'])) {
    $prod = get_product_by_id($_GET['add_prod']);
    $total = $_GET['quant'] * $prod['preu'];
    $line = [
        "id" => get_new_line_id(),
        "name" => $prod['nom'],
        "quantity" => $_GET['quant'],
        "price" => $prod['preu'],
        "total" => $total
    ];
    $_SESSION['order_lines'][] =$line;
}

//Cancel order
if(isset($_GET['cancel_order'])) $_SESSION['order_lines'] = [];

//Declaring the single order array
if(!isset($_SESSION['order'])){
    $_SESSION['order'] = [];
}

//click to 'Finalitzar' & create the order
if(isset($_GET['create_order'])){
    $date = new DateTime('now', new DateTimeZone('Europe/Madrid'));
    if(count($_SESSION['order_lines'])>0){
        $_SESSION['order'] = [
            'order_id' => get_new_order_id(),
            'order_total' => get_total_order(),
            'order_time' => $date,
            'order_lines' => $_SESSION['order_lines']
        ];

        foreach ($_SESSION['users'] as $index => $user) {
            if($user['id'] == $_SESSION['user_Logged']['id']){
                $_SESSION['users'][$index]['orders'][] = $_SESSION['order'];
            }
        }

        $_SESSION['user_Logged']['orders'][] = $_SESSION['order'];
        $_SESSION['order_lines'] = [];
        $_SESSION['order'] = [];
    }   
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Bootstrap import-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>

<body class="" style="background:#afaaaa;">
    <header class="vh-15">
        <?php require_once('templates/nav_tpv.php'); ?>
    </header>
    <div class="Container d-flex gap-5 m-5" style="height:80vh;">
        <div class="col1 d-flex flex-column justify-content-between" style="width: 65%;">
            <div class="orders-history d-flex gap-1 w-75 " style="overflow:auto;">

                <?php
                $last5_orders = array_slice($_SESSION['user_Logged']['orders'], -5);
                foreach ($last5_orders as $order) {
                ?>
                    <div class="card" style="width: 20%">
                        <div class="card-body bg-dark text-white">
                            <h5 class="card-title">Nº<?php echo $order['order_id'] ?></h5>
                            <p class="m-0">Total</p>
                            <h4><?php echo $order['order_total'] ?>€</h4>
                            <br>
                            <p><?php echo $order['order_time']->format('G:i')?>h</p>
                            <p><?php echo $order['order_time']->format('d/m/Y')?></p>
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>
            <div class="products d-flex flex-wrap " style="overflow:auto;height:36vh;">
                <?php
                foreach ($_SESSION['products'] as $p) {
                ?>
                    <input name="btn_prod" onclick="window.location.href='?id_prod=<?php echo $p['id'] ?>'" value="<?php echo $p['nom'] ?>" type="button" style="width:19%; height:12vh;">
                <?php
                }
                ?>

            </div>
        </div>
        <div class="col2 d-flex flex-column justify-content-between" style="width: 35%; ">
            <div class="d-flex gap-1" style="height:12vh;">
                <input type="button" value="Resum de ventes" onclick="window.location.href='user_orders.php'" style=" background:none; border: solid black 1px;width:33%;white-space:normal;" class="bg-dark text-white border ">
                <input type="button" value="Info" style=" background:none; border: solid black 1px;width:33%;" class="bg-dark text-white border">
                <input type="button" value="Sortir" onclick="window.location.href='logout.php'" style=" background:none; border: solid black 1px;width: 33%;" class="bg-dark text-white border">
            </div>
            <table class="order-products border w-100 bg-white" style="overflow:auto;">
                <thead class="border bg-dark text-white">
                    <th class="p-2">Id</th>
                    <th>Nom</th>
                    <th>Quantitats</th>
                    <th>Preu / Unitat</th>
                    <th>Preu</th>
                </thead>
                <tbody>
                    <?php
                    foreach ($_SESSION['order_lines'] as $line) {
                    ?>
                        <tr class="border">
                            <th><?php echo $line['id']?> </th>
                            <td><?php echo $line['name'] ?></td>
                            <td><?php echo $line['quantity'] ?></td>
                            <td><?php echo $line['price'] ?>€</td>
                            <td><?php echo $line['total'] ?>€</td>
                        </tr>
                    <?php
                    }
                    ?>

                </tbody>
            </table>
            <div class="order-price d-flex justify-content-between">
                <div class="quantity d-flex flex-column">
                    <input type="text" name="price_prod" id="price" class="w-50 " value="<?php if (isset($prod)) echo $prod['preu'] ?>" style="font-size:40px;text-align:right;" readonly>
                    <div class="align-middle">
                        <input type="number" name="quantity" id="quantity" style="width:15%;" value="1">
                        <p class="d-inline">Quantitat</p>
                    </div>
                </div>
                <div class="text">
                    <h2>Total</h2>
                    <h3><?php echo get_total_order()?>€</h3>
                </div>
            </div>

            <div class="d-flex gap-1" style="height:12vh;">
                <input type="button" value="Afegir producte" onclick="window.location.href='?add_prod=<?php echo $prod['id'] ?>&quant=' + document.getElementById('quantity').value" style=" border: solid black 1px;width:33%;white-space:normal;background:#75ad7c;" class=" text-white border ">
                <input type="button" value="Cancelar" onclick="window.location.href='?cancel_order'" style=" border: solid black 1px;width:33%;" class="bg-danger text-white border">
                <input type="button" value="Finalitzar" onclick="window.location.href='?create_order'" style=" border: solid black 1px;width: 33%;" class="bg-success text-white border">
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>
