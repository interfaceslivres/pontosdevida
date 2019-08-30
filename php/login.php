<?php 
	require 'vendor/autoload.php'; 
	use PontosDeVida\Connection as Connection;
	use PontosDeVida\PontosDeVidaLogin as PontosDeVidaLogin;

	session_start();

	$login = $_POST['FL_login'];
	$senha = $_POST['FL_senha'];

	$pdo = Connection::get()->connect();
	$loginU = new PontosDeVidaLogin($pdo);

	$logInfo = $loginU->login($login, $senha);

	$valid = $logInfo['valid'];
	$timeout = $logInfo['timeout'];
	$username = $logInfo['username'];
	$msg = $logInfo['msg'];

	echo $msg;


	if($valid == true ){
		$_SESSION['valid'] = $valid;
		$_SESSION['timeout'] = $timeout;
		$_SESSION['username'] = $username;
		echo $msg;
		header('location:site.php');
	}
	else{
	  unset ($_SESSION['username']);
	  $_SESSION['loginerro'] = $msg;
	  header('location:index.php');
	   
	  }

?>