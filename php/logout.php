<?php 
    session_start();
	session_destroy();
	session_start();
    $_SESSION["msglogout"] = 'You have cleaned session';
    header('location:index.php');
?>