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
				$e="";
				if( isset($_POST['esquecibutton']) ){
					$login_usuario=$_POST['F_usuario'];
					$email=$_POST['F_email'];
					try {
						$pdo = Connection::get()->connect();
						$chamador = new PontosDeVidaFuncoes($pdo);

						$dadosusuario=$chamador->mostrarUsuario($login_usuario);
						if($dadosusuario[0]['email']==$email){
							$senhanova=randomPassword();
							$chamador->alteraSenha($login_usuario, md5($senhanova));
							$to=$email;
							$subject="Pontos de Vida:Senha resetada";
							$message="Caro(a) ".$dadosusuario[0]['nome']." , " 	. "\r\n" .
							""													. "\r\n" .
							"Foi requisitada uma nova senha para sua conta,"	. "\r\n" .
							"sua nova senha é " . $senhanova . " ." 			. "\r\n" .
							"Caso o reset de senha não tenha sido solicitado "	. "\r\n" .
							"voce pode retornar a sua senha antiga pelo menu"	. "\r\n" .
							"de edição de perfil."								. "\r\n" .
							"Estamos melhorando o sistema para evitar casos"	. "\r\n" .
							"como esse."										. "\r\n" .
							""													. "\r\n" .
							"Obrigado pela compreenção,"						. "\r\n" .
							"Equipe Pontos de Vida.";
							$headers = array(
								'From' => 'noreply@pontosdevida.org',
								'Reply-To' => 'paulohsms+pontosdevida@gmail.com',
								'X-Mailer' => 'PHP/' . phpversion()
							);
							mail($to,$subject,$message,$headers);
							header("Location: index.php");
						}
						else{
							$e="Email e usuario não correspondem";
						}
					} catch (\PDOException $e) {
						echo $e->getMessage();
					}
				}
				function randomPassword() {
					$alphabet = "abcdefghjklmnopqrstuwxyzABCDEFGHJKLMNOPQRSTUWXYZ123456789";
					for ($i = 0; $i < 5; $i++) {
						$n = rand(0, strlen($alphabet)-1);
						$pass[$i] = $alphabet[$n];
					}
					return implode("",$pass);
				}
		      ?>
			  <div> <?php echo $e; ?> </div>
          <form  method="post" action="" id="esqueciform">

					<div id="caixalogin" class="mdl-textfield mdl-js-textfield">
							<input name="F_usuario" class="mdl-textfield__input" type="text" id="user" pattern="[A-Z,a-z,0-9,_,-,., ]*">
						<label class="mdl-textfield__label" for="name">Usuário</label>
					</div>
					<div id="caixalogin" class="mdl-textfield mdl-js-textfield">
							<input name="F_email" class="mdl-textfield__input" required type="email" id="email">
						<label class="mdl-textfield__label" for="email">E-MAIL</label>
					</div>
				</form>

				<button type="submit" form="esqueciform" value="Submit" name="esquecibutton" id="esquecibtn" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored">
					Resgatar Senha
				</button>
				</div>
			</div>
		<div class="mdl-layout-spacer"></div>
		</div>

		<div class="mdl-grid">
			<div class="mdl-layout-spacer"></div>
				<p id="avisotermos">Ao resgatar sua senha, uma nova senha aleatória será enviada por e-mail, por favor, verifique a caixa de spam (estamos tentando corrigir isso) você pode alterar sua senha no menu de configurações.</p>
			<div class="mdl-layout-spacer"></div>
		</div>
	</body>
</html>
