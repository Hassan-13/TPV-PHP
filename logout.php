<?php
if(!isset($_SESSION)) session_start();
unset($_SESSION['user_Logged']);
header('Location:index.php');