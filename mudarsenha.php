<!--
Tela: Cadastro
Aplicativo: Pontos de Vida
Desenvolvido por: Interfaces Livres
-->
<?php

require 'php/vendor/autoload.php';
use PontosDeVida\Connection as Connection;
use PontosDeVida\PontosDeVidaLogin as PontosDeVidaLogin;
use PontosDeVida\PontosDeVidaFuncoes as PontosDeVidaFuncoes;



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
				session_start();
				$e="";
				if( isset($_POST['mudarbutton']) ){
					$Antiga = $_POST['F_Senha_Antiga'];
					$Nova = $_POST['F_Senha_Nova'];
					$Confirma = $_POST['F_Senha_Confirma'];
					if($Nova!=$Confirma){
						$e="Senhas diferentes.";
					}
					else{
						$pdo = Connection::get()->connect();
						$chamador = new PontosDeVidaFuncoes($pdo);
						if($chamador->confirmaSenha($Antiga)){
							$chamador->alteraSenha($_SESSION['username'],md5($Nova));
							$e="Senha alterada com sucesso.";
							header("Location: home.php");
						}
						else{
							$e="Senha atual errada.";
						}
					}
							
				}
		      	?>
          		<form  method="post" action="" id="mudarsenhaform">
				  <?php echo $e; ?>
					<div id="caixaSenhaAntiga" class="mdl-textfield mdl-js-textfield">
						<input name="F_Senha_Antiga" class="mdl-textfield__input" required type="password" pattern="[A-Z,a-z,0-9]*">
						<label class="mdl-textfield__label" for="name">Senha antiga</label>
					</div>
					<div id="caixaSenha" class="mdl-textfield mdl-js-textfield">
						<input name="F_Senha_Nova" class="mdl-textfield__input" required type="password" pattern="[A-Z,a-z,0-9]*">
						<label class="mdl-textfield__label" for="name">Nova senha</label>
					</div>
					<div id="caixaConfirmarSenha" class="mdl-textfield mdl-js-textfield">
						
						<input name="F_Senha_Confirma" class="mdl-textfield__input" required type="password" pattern="[A-Z,a-z,0-9]*">
						<label class="mdl-textfield__label" for="name">Confirmar nova senha</label>
					</div>
				</form>
				<button type="submit" form="mudarsenhaform" value="Submit" name="mudarbutton" id="entrarbt" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored">
					Mudar Senha
				</button>
				</div>
			</div>
		<div class="mdl-layout-spacer"></div>
		</div>
	</body>
</html>
