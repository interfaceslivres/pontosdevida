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

      //criar figurinhas fixas
      $validas=range(0,15);
      for ($i = 1; $i < 4; $i++) {
        $selecionada=0;
        $posicao = array_rand($validas);
        $selecionada=1;
        $max=ceil(($posicao+1)/4)*4;
        for($j=$posicao;$j<$max;$j++){
          unset($validas[$j]);
        }
        $min=floor($posicao/4)*4;
        for($j=$posicao-1;$j>=$min;$j--){
          unset($validas[$j]);
        }
        for($j=$posicao+4;$j<16;$j+=4){
          unset($validas[$j]);
        }
        for($j=$posicao-4;$j>=0;$j-=4){
          unset($validas[$j]);
        }
        $tabuleiro = 1;
        $fixa = 1;
        $dono = ($_SESSION['username']);
        $inserir = new PontosDeVidaFuncoes($pdo);
        $templates=$inserir->mostrarTemplates();
        $otemplate = $templates[array_rand($templates)]['nome'];
        $inserir->criarFigurinha($posicao,$tabuleiro,$fixa,$dono,$otemplate);
      }
        //criar notificacao inicial
      $inserir->criarNotifica($dono, 11);
      header('location:editarperfil.php');
    }
    else{
      unset ($_SESSION['username']);
      $_SESSION['loginerro'] = $msg;
      header('location:index.php');

      }

  };

function cadastrar($email, $nome, $login_usuario, $senha ,$sexo) {
   try {
    // connect to the mysql database
	  $pdo = Connection::get()->connect();
    $InserirDados = new PontosDeVidaFuncoes($pdo);
    $biografia = "";
    $data_nascimento = "1991-01-01";
    $tipo_sangue = "";
    // inserir dados do usuario na tabela usuario
    $InserirDados->criarUsuario($nome, $login_usuario, $senha, $email, $biografia, $data_nascimento,$sexo, $tipo_sangue);

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

    <style>

    #caixaselecaocadastro {
          width: 150px;
          overflow: hidden;
          height: 30px;
          border: 1.4px solid white;
          border-radius: 15px;
          margin-bottom: 20px;
          color: white;
          padding: 20px 0px;
    }


    #caixaselecaocadastro select {
      border: 0;
      background: #1F1E1E;
      width: 162px;
      height: 38px;
      font-family: Arial, Helvetica, sans-serif;
      font-size: 11.5px;
      color: #fff;
      position: absolute;
      top: 0px;
      left: 18px;
}


    #caixaselecaocadastro select option:disabled{
      background: #1F1E1E;
      color: #1F1E1E;
}

    #caixaselecaocadastro select option{
      color: #fff;
}



    </style>



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
						if( isset($_POST['cadastrobutton']) ){
							$nome = $_POST['nome-c']; $login_usuario = $_POST['user-c']; $senha = $_POST['senha-c']; $email = $_POST['mail-c'];$sexo=$_POST['sex-c'];
							cadastrar($email, $nome, $login_usuario, $senha,$sexo);
						}
					?>
          <form  method="post" action="" id="cadastroform">

					<div id="caixalogin" class="mdl-textfield mdl-js-textfield">
							<input name="nome-c" class="mdl-textfield__input" type="text" id="user" pattern="([A-z0-9À-ž\s]){2,}">
						<label class="mdl-textfield__label" for="name">NOME COMPLETO</label>
					</div>
					<div id="caixalogin" class="mdl-textfield mdl-js-textfield">
							<input name="mail-c" class="mdl-textfield__input" required type="email" id="user">
						<label class="mdl-textfield__label" for="email">E-MAIL</label>
					</div>
					<div id="caixalogin" class="mdl-textfield mdl-js-textfield">
							<input name="user-c" class="mdl-textfield__input" type="text" id="user" required pattern="[A-Z,a-z,0-9,_,-,., ]*">
						<label class="mdl-textfield__label" for="user">NOME DE USUÁRIO</label>
					</div>
					<div id="caixaselecaocadastro" class="mdl-textfield mdl-js-textfield">
						<select name="sex-c">
              <option disabled selected="selected">Sexo</option>
							<option value="M"  >Masculino</option>
							<option value="F" >Feminino</option>
						</select>
					</div>
					<div id="caixalogin" class="mdl-textfield mdl-js-textfield">
							<input  name="senha-c" class="mdl-textfield__input" type="password" id="password" required pattern="[A-Z,a-z,0-9]*">
						<label class="mdl-textfield__label" for="user">SENHA</label>
						<!--<span class="mdl-textfield__error">*Insira apenas letras e números neste campo*</span>-->
					</div>
				</form>

				<button type="submit" form="cadastroform" value="Submit" name="cadastrobutton" id="entrarbt" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored">
					Cadastre-se
				</button>
				</div>
			</div>
		<div class="mdl-layout-spacer"></div>
		</div>

		<div class="mdl-grid">
			<div class="mdl-layout-spacer"></div>
				<p id="avisotermos">Ao se cadastrar, você concorda<br> com nossos <a style="color:#fff" href="termos.php">Termos de Serviço</a>.</p>
			<div class="mdl-layout-spacer"></div>
		</div>

		<div class="mdl-grid">
			<div class="mdl-layout-spacer"></div>
				<p id="ctaconectar">Tem uma conta? <a id="linkcadastrar" href="index.php">Conecte-se</a></p>
			<div class="mdl-layout-spacer"></div>
		</div>
	</body>
</html>
