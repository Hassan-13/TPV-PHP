<?
if (!isset($_SESSION)) session_start();
include_once('functions.php');
$correct_pwd = null;

//unset($_SESSION['users']);

if (!isset($_SESSION['user_Logged'])) {
    $_SESSION['user_Logged'] = array();
}
if (!isset($_SESSION['users'])) {
    $date = new DateTime('now', new DateTimeZone('Europe/Madrid'));
    $_SESSION['users'] = [
        [
            'id' => 1,
            'username' => 'Admin',
            'password' => 'admin',
            'admin' => true,
            'hora' => $date
        ],
        [
            'id' => 2,
            'username' => 'Hassan',
            'password' => 'shah',
            'admin' => false,
            'hora' => $date,
            'orders' => []
        ],
        [
            'id' => 3,
            'username' => 'Francisco',
            'password' => 'franco',
            'admin' => false,
            'hora' => $date,
            'orders' => []
        ]
    ];
}

//Crating products array
if (!isset($_SESSION['products'])) {
    $date = new DateTime('now', new DateTimeZone('Europe/Madrid'));
    $_SESSION['products'] = [
        [
            'id' => 1,
            'nom' => 'Pa',
            'desc' => 'Una barra de pa recent fete',
            'hora' => $date,
            'preu' => 0.50
        ],
        [
            'id' => 2,
            'nom' => 'Llauna de refresc',
            'desc' => 'Llauna de 33cl',
            'hora' => $date,
            'preu' => 0.75
        ],
        [
            'id' => 3,
            'nom' => 'Durex',
            'desc' => 'Ultra invisibles',
            'hora' => $date,
            'preu' => 9.5
        ],
        [
            'id' => 4,
            'nom' => 'Lays',
            'desc' => 'Patates chips Lays',
            'hora' => $date,
            'preu' => 1.75
        ],
        [
            'id' => 5,
            'nom' => 'Aigua petita',
            'desc' => 'Ampolla d\'aigua 50cl',
            'hora' => $date,
            'preu' => 0.75
        ],
        [
            'id' => 6,
            'nom' => 'Pizza vegetal',
            'desc' => 'Pizza individual vegetal 50cm',
            'hora' => $date,
            'preu' => 5
        ],
        [
            'id' => 7,
            'nom' => 'Chupa chup',
            'desc' => 'Chupa chup',
            'hora' => $date,
            'preu' => 0.25
        ],
        [
            'id' => 8,
            'nom' => 'Pasta',
            'desc' => 'Pasta per cuinar',
            'hora' => $date,
            'preu' => 2.5
        ],
        [
            'id' => 9,
            'nom' => 'Llet',
            'desc' => 'Una caixa de 6 unitats',
            'hora' => $date,
            'preu' =>5
        ],
        [
            'id' => 10,
            'nom' => 'Cafe',
            'desc' => 'Tot tipus de cafe',
            'hora' => $date,
            'preu' => 2
        ],
        [
            'id' => 11,
            'nom' => 'Fruita',
            'desc' => 'Totes les ruites Preu / K',
            'hora' => $date,
            'preu' => 2
        ]

    ];
}


/*echo '<pre>';
var_dump($_SESSION['users']);
echo '</pre>';*/


if (isset($_POST['btn_login'])) {
    $usr = $_POST['username'];
    $pwd = $_POST['password'];

    $result = validateUser($usr, $pwd);

    if (is_null($result)) {
        $correct_pwd = false;
    } else {
        $correct_pwd = true;
        $_SESSION['user_Logged'] = $result;
        if ($result['admin']) {
            header('Location:adminView.php');
            die();
        }
        header('Location:tpv.php');
    }
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

<body style="height: 100vh;" class="d-flex justify-content-center align-items-center">
    <div class="mx-auto border p-5 col-4 bg-light ">
        <h1>Login</h1>
        <form action="#" method="post">
            <div class="form-group">
                <label for="exampleInputEmail1">Username</label>
                <input name="username" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Username">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Password:</label>
                <input name="password" type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
            </div>
            <button type="submit" class="btn btn-primary mt-2" name="btn_login">Login</button>
        </form>
        </br>
        <?php
        if (!is_null($correct_pwd)) {
            if (!$correct_pwd) {
                echo "<small class='text-danger'>Incorrect credentials!</small>";
            }
        }
        ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>