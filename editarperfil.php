<?php
require 'php/vendor/autoload.php';
use PontosDeVida\Connection as Connection;
use PontosDeVida\PontosDeVidaFuncoes as PontosDeVidaFuncoes;
session_start();

try {
	$pdo = Connection::get()->connect();
  $chamador = new PontosDeVidaFuncoes($pdo);
  $dados = $chamador->meusDados();
} catch (\PDOException $e) {
	 echo $e->getMessage();
}
//
// try {
//  // connect to the mysql database
//  $pdo = Connection::get()->connect();
//  $AlterarDados = new PontosDeVidaFuncoes($pdo);
//  $login_usuario = $_SESSION['username'];
//   // alterar dados do usuario na tabela usuario
//  $AlterarDados->configUsuario($login_usuario, $senha,
// 																 $email,$nome,$biografia,$data_nascimento,
// 																 $privacidade,$tipo_sangue,$tempo_retorno,$foto);
// } catch (\PDOException $e) {
// 	 echo $e->getMessage();
// }
  //
	// header('Location: ' . $_SERVER['HTTP_REFERER']);
	// exit;

// };


?>

<html lang="pt-br">
<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
        <link rel="stylesheet" type="text/css" href="style.css">
        <link rel="stylesheet" href="mdl/material.min.css">
        <script src="mdl/material.min.js" id="mdl-script"></script>
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
</head>
<body>
    <content class="mdl-grid">
        <div class="mdl-layout-spacer"></div>

        <div class="demo-card-square mdl-card mdl-cell mdl-cell--4-col">
            <!--
            <p class="categorias margemcat">
                <span class="pontos">.</span><span>Perfil</span>
            </p>

            <div id="img_infos" class="margemcat">
                <a href="#">
                    <div id="imgperfil"></div>
                    <div id="badgeperfil">
                        <i class="material-icons">photo_camera</i>
                    </div>
                </a>

                <div id="perfilinfos">
                    <p class="titulo">
                        <span id="perfilnome">Billy</span>,
                        <span id="perfilidade">12</span>
                        <span><a href="#"><i class="material-icons">border_color</i></a></span>
                    </p>
                    <p id="perfilbio">Olá, sou um West Highland White Terrier, amante da natureza e doador desde os 5 anos.</p>
                    <p id="perfiltiposanguineo">A+</p>
                </div>
            </div>
        -->
            <?php
    	      // if( isset($_POST['SalvarButton']) )
    	      // {
    				// 	$login=$_POST['Login'];
    				// 	$senha=$_POST['Senha'];
    				// 	logar($login,$senha);
						//
    	      //     //then you can use them in a PHP function.
    	      // }
    	      ?>
          <form method="post" action="" id="editarperfil">
            <p class="categorias margemcat">
                <span class="pontos">.</span><spam>Configurações</spam>
            </p>

            <p class="titulo margem">Conta e notificações</p>
            <span>
                <p class="subtitulos margem">E-mail</p>
                <p class="dados margem"><?php echo htmlspecialchars($dados['email']) ?></p>
                <input type="text" placeholder="<?php echo htmlspecialchars($dados['email']) ?>">
            </span>

            <span>
                <p class="subtitulos margem">Nome</p>
                <input type="text" placeholder="<?php echo htmlspecialchars($dados['nome']) ?>">
            </span>

            <span>
                <p class="subtitulos margem">Biografia</p>
                <input type="text" placeholder="<?php echo htmlspecialchars($dados['biografia']) ?>">
            </span>

            <span>
                <p class="subtitulos margem">Data de Nascimento</p>
                <input type="text" placeholder="<?php echo htmlspecialchars($dados['data_nascimento']) ?>">
            </span>

            <span>
                <p class="subtitulos margem">Privacidade</p>
                <input type="text" placeholder="<?php echo htmlspecialchars($dados['privacidade']) ?>">
            </span>

            <span>
                <p class="subtitulos margem">Tipo Sanguíneo</p>
                <input type="text" placeholder="<?php echo htmlspecialchars($dados['tipo_sangue']) ?>">
            </span>
            <span>
                <p class="subtitulos margem">Notificações</p>
                <input type="text" placeholder="<?php echo htmlspecialchars($dados['tempo_retorno']) ?>">
            </span>
            <span>
                <p class="subtitulos margem">Foto</p>
                <div id="imgperfil"><img src="<?php echo htmlspecialchars($dados['foto']); ?>"></div>
                <input type="file">
            </span>



             <span>
                <label class="mdl-switch mdl-js-switch mdl-js-ripple-effect" for="switch-1">
                <input type="checkbox" id="switch-1" class="mdl-switch__input">
                <span class="mdl-switch__label subtitulos">Notificações</span>
                </label>
                </form>

              <button type="submit" form="editarperfil" value="Submit" name="SalvarButton" id="entrarbt" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored">
              Salvar
              </button>
              <button type="submit" form="" value="Submit" name="" id="entrarbt" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored">
              Cancelar
              </button>
            </span>
        </div>

        <div class="mdl-layout-spacer"></div>
    </content>
</body>
</html>
