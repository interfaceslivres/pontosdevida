<?php 

    session_start();
    unset($_SESSION["valid"]);
    unset($_SESSION['timeout']);
    unset($_SESSION["username"]);
    $_SESSION["msglogout"] = 'You have cleaned session';
    header('location:index.php');

?>