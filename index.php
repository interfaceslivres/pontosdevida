<!--
Tela: Login
Aplicativo: Pontos de Vida
Desenvolvido por: Interfaces Livres
-->
<?php 
                if(isset($_POST['logoutButton'])){
					session_start();
                    session_destroy();
                    session_start();
                    $_SESSION["msglogout"] = 'You have cleaned session';
                    header('location:index.php');
				}
				else{
					session_start();
					if(isset($_SESSION['username'])){
						header('location:home.php');
					}
				}
				
            ?>
<?php
	require 'php/vendor/autoload.php';
	use PontosDeVida\Connection as Connection;
	use PontosDeVida\PontosDeVidaLogin as PontosDeVidaLogin;

	function logar($login, $senha){
		session_start();
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
			header('location:home.php');
		}
		else{
		  unset ($_SESSION['username']);
		  $_SESSION['loginerro'] = $msg;
		  header('location:index.php');

		  }


	}


 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Pontos de Vida</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">
	<link rel="stylesheet" type="text/css" href="style.css">
	<link rel="stylesheet" href="mdl/material.min.css">
	<script src="mdl/material.min.js"></script>
	<script src="app.js"></script>
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
</head>

<body class="login-bg">
	<div class="mdl-grid">
		<div class="mdl-layout-spacer"></div>
			<img id="logopdv" src="img/logo.png" height="180px">
    	<div class="mdl-layout-spacer"></div>
	</div>

	<div class="mdl-grid">
    <div class="mdl-layout-spacer"></div>
		<div class="demo-card-square mdl-card mdl-cell mdl-cell--4-col">
		  <div class="mdl-card__supporting-text">
				<?php
	      if( isset($_POST['LoginButton']) )
	      {
					$login=$_POST['Login'];
					$senha=$_POST['Senha'];
					logar($login,$senha);

	          //then you can use them in a PHP function.
	      }
	      ?>
			<form method="post" action="" id="loginform">
			  <div id="caixalogin" class="mdl-textfield mdl-js-textfield">
			      <input name="Login" class="mdl-textfield__input" type="text" id="user" pattern="[A-Z,a-z,0-9,_,-,., ]*" >
				  <label class="mdl-textfield__label" for="user">USUÁRIO</label>
			  </div>

			  <div id="caixalogin" class="mdl-textfield mdl-js-textfield">
			      <input name="Senha" class="mdl-textfield__input" type="password" id="password" pattern="[A-Z,a-z,0-9]*" >
				  <label class="mdl-textfield__label" for="user">SENHA</label>
				  <!--<span class="mdl-textfield__error">*Insira apenas letras e números neste campo*</span>-->
			  </div>
			</form>

			<!-- <button id="facebookbt" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored">
			  <img src="img/facebook.png" height="20px">
			</button>

			<button id="gmailbt" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored">
			  <img src="img/gmail.png" height="20px">
			</button> -->

			<button type="submit" form="loginform" value="Submit" name="LoginButton" id="entrarbt" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored">
			  Entrar
			</button>
		  </div>
		</div>
	<div class="mdl-layout-spacer"></div>
	</div>

	<div class="mdl-grid">
		<div class="mdl-layout-spacer"></div>
			<p id="ctaredefinir"><a id="linkcadastrar" href="#">Esqueceu a senha?</a></p>
		<div class="mdl-layout-spacer"></div>
	</div>

	<div class="mdl-grid">
		<div class="mdl-layout-spacer"></div>
			<p id="ctacadastrar">Não tem uma conta? <a id="linkcadastrar" href="cadastro.php">Cadastre-se</a></p>
		<div class="mdl-layout-spacer"></div>
	</div>
</body>
</html>
