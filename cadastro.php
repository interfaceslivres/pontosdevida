<!--
Tela: Cadastro
Aplicativo: Pontos de Vida
Desenvolvido por: Interfaces Livres
-->
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

  };
use PontosDeVida\PontosDeVidaFuncoes as PontosDeVidaFuncoes;
function cadastrar($email, $nome, $login_usuario, $senha) {
    echo("to auqi");
   try {
    // connect to the mysql database
	  $pdo = Connection::get()->connect();
    $InserirDados = new PontosDeVidaFuncoes($pdo);
    $biografia = "";
    $data_nascimento = "1991-01-01";
    $tipo_sangue = "";
    // inserir dados do usuario na tabela usuario
    $InserirDados->criarUsuario($nome, $login_usuario, $senha, $email, $biografia, $data_nascimento, $tipo_sangue);

    logar($login_usuario, $senha);
	} catch (\PDOException $e) {
	    echo $e->getMessage();
	}
  //
	// header('Location: ' . $_SERVER['HTTP_REFERER']);
	// exit;

};


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
		<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	</head>

	<body class="cadastro-bg">
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
		      if( isset($_POST['cadastrobutton']) )
		      {
            echo("to");
						$nome = $_POST['nome-c']; $login_usuario = $_POST['user-c']; $senha = $_POST['senha-c']; $email = $_POST['mail-c'];
						cadastrar($email, $nome, $login_usuario, $senha);

		          //then you can use them in a PHP function.
		      }
		      ?>
          <form  method="post" action="" id="cadastroform">

					<div id="caixalogin" class="mdl-textfield mdl-js-textfield">
							<input name="nome-c" class="mdl-textfield__input" type="text" id="user" pattern="[A-Z,a-z, ]*">
						<label class="mdl-textfield__label" for="name">NOME COMPLETO</label>
					</div>
					<div id="caixalogin" class="mdl-textfield mdl-js-textfield">
							<input name="mail-c" class="mdl-textfield__input" type="text" id="user" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2, 3}$">
						<label class="mdl-textfield__label" for="email">E-MAIL</label>
					</div>
					<div id="caixalogin" class="mdl-textfield mdl-js-textfield">
							<input name="user-c" class="mdl-textfield__input" type="text" id="user" pattern="[A-Z,a-z,0-9,_,-,., ]*">
						<label class="mdl-textfield__label" for="user">NOME DE USUÁRIO</label>
					</div>
					<div id="caixalogin" class="mdl-textfield mdl-js-textfield">
							<input  name="senha-c" class="mdl-textfield__input" type="password" id="password" pattern="[A-Z,a-z,0-9]*">
						<label class="mdl-textfield__label" for="user">SENHA</label>
						<!--<span class="mdl-textfield__error">*Insira apenas letras e números neste campo*</span>-->
					</div>
				</form>

				<!-- <button id="facebookbt" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored social-midia-button">
					<img src="img/facebook.png" height="20px">
				</button>

				<button id="gmailbt" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored social-midia-button">
					<img src="img/gmail.png" height="20px">
				</button> -->

				<button type="submit" form="cadastroform" value="Submit" name="cadastrobutton" id="entrarbt" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored">
					Cadastre-se
				</button>
				</div>
			</div>
		<div class="mdl-layout-spacer"></div>
		</div>

		<div class="mdl-grid">
			<div class="mdl-layout-spacer"></div>
				<p id="avisotermos">Ao se cadastrar, você concorda com nossos <b>Termos</b>, <b>Política de Dados</b> e <b>Política de Cookies</b>.</p>
			<div class="mdl-layout-spacer"></div>
		</div>

		<div class="mdl-grid">
			<div class="mdl-layout-spacer"></div>
				<p id="ctaconectar">Tem uma conta? <a id="linkcadastrar" href="index.php">Conecte-se</a></p>
			<div class="mdl-layout-spacer"></div>
		</div>
	</body>
</html>
