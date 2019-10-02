<!--
Tela: Cadastro
Aplicativo: Pontos de Vida
Desenvolvido por: Interfaces Livres
-->
<?php

require 'vendor/autoload.php';
use PontosDeVida\Connection as Connection;
use PontosDeVida\PontosDeVidaEnviarDados as PontosDeVidaEnviarDados;
function cadastrar($nome, $login, $senha, $email, $biografia, $data_nascimento, $tipo_sanguineo) {

   try {
    // connect to the PostgreSQL database
	  $pdo = Connection::get()->connect();
    //
    $InserirDados = new PontosDeVidaEnviarDados($pdo);

    // inserir dados do usuario na tabela usuario
    $InserirDados->AdicionarDados($nome, $login,  $senha, $email, $biografia, $data_nascimento, $tipo_sanguineo);

	} catch (\PDOException $e) {
	    echo $e->getMessage();
	}

	header('Location: ' . $_SERVER['HTTP_REFERER']);
	exit;

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
		      if( isset($_POST['LoginButton']) )
		      {
						$nome = $_POST['F_nome']; $login = $_POST['F_login']; $senha = $_POST['F_senha']; $email = $_POST['F_email']; $biografia = $_POST['F_biografia']; $data_nascimento = $_POST['F_data_nascimento']; $tipo_sanguineo = $_POST['F_tipo_sanguineo'];
						cadastrar($nome, $login, $senha, $email, $biografia, $data_nascimento, $tipo_sanguineo);

		          //then you can use them in a PHP function.
		      }
		      ?>
				<form action="#">
					<div id="caixalogin" class="mdl-textfield mdl-js-textfield">
							<input class="mdl-textfield__input" type="text" id="user" pattern="[A-Z,a-z,0-9,_,-,., ]*">
						<label class="mdl-textfield__label" for="email">E-MAIL</label>
					</div>
				</form>

				<form action="#">
					<div id="caixalogin" class="mdl-textfield mdl-js-textfield">
							<input class="mdl-textfield__input" type="text" id="user" pattern="[A-Z,a-z, ]*">
						<label class="mdl-textfield__label" for="name">NOME COMPLETO</label>
					</div>
				</form>

				<form action="#">
					<div id="caixalogin" class="mdl-textfield mdl-js-textfield">
							<input class="mdl-textfield__input" type="text" id="user" pattern="[A-Z,a-z,0-9,_,-,., ]*">
						<label class="mdl-textfield__label" for="user">NOME DE USUÁRIO</label>
					</div>
				</form>

				<form action="#">
					<div id="caixalogin" class="mdl-textfield mdl-js-textfield">
							<input class="mdl-textfield__input" type="text" id="password" pattern="[A-Z,a-z,0-9]*">
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

				<button id="entrarbt" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored">
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
