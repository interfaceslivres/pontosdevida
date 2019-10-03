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
    	      if( isset($_POST['SalvarButton']) )
    	      {
                $login=$_POST['Login'];
                $senha=$_POST['Senha'];
                logar($login,$senha);
                
    	      }
    	      ?>
          <form method="post" action="" id="editarperfil">
            <p class="categorias margemcat">
                <span class="pontos">.</span><spam>Configurações</spam>
            </p>

            <p class="titulo margem">Conta e notificações</p>
            <span>
                <p class="subtitulos margem">E-mail</p>
                <input type="text" id="F_email" nome="F_email" >
                <script type="text/javascript">
                    document.getElementById('F_email').value = "<?php echo htmlspecialchars($dados['email'])  ?>";
                </script>
            </span>

            <span>
                <p class="subtitulos margem">Nome</p>
                <input name="F_nome" id="F_nome" type="text" >
                <script type="text/javascript">
                    document.getElementById('F_nome').value = "<?php echo htmlspecialchars($dados['nome'])  ?>";
                </script>
            </span>

            <span>
                <p class="subtitulos margem">Biografia</p>
                <input name="F_biografia" type="text" id="F_biografia" placeholder="">
                <script type="text/javascript">
                    document.getElementById('F_biografia').value = " <?php echo htmlspecialchars($dados['biografia']) ?> ";
                </script>
            </span>

            <span>
                <p class="subtitulos margem">Data de Nascimento</p>
                <?php 
                    $nascimento=strrev($dados['data_nascimento']);
                    $nascimento=str_replace('-', '/', $nascimento);
                ?>
                <input name="F_data_nascimento" id="F_data_nascimento" type="text" >
                <script type="text/javascript">
                    document.getElementById('F_data_nascimento').value = " <?php echo htmlspecialchars($nascimento) ?> ";
                </script>
            </span>

            <span>
                
                <label class="mdl-switch mdl-js-switch mdl-js-ripple-effect" for="switch-1">
                    <input name="F_privacidade"  type="checkbox" <?php if($dados['privacidade']) echo "checked"; ?> style="display:none;"id="switch-1" class="mdl-switch__input">
                    <span class="mdl-switch__label subtitulos">Ocultar Tipo Sanguíneo</span>
                </label>
            </span>

            <span>
                <p class="subtitulos margem">Tipo Sanguíneo</p>
                <select name="F_tipo_sanguineo" placeholder="Tipo sanguíneo"> 
						<option value=""    <?php  if($dados['tipo_sangue']==NULL) echo "selected";  ?>></option>
						<option value="A+"  <?php  if($dados['tipo_sangue']=="A+") echo "selected";  ?>>A+</option>
						<option value="A-"  <?php  if($dados['tipo_sangue']=="A-") echo "selected";  ?>>A-</option>
						<option value="B+"  <?php  if($dados['tipo_sangue']=="B+") echo "selected";  ?>>B+</option>
						<option value="B-"  <?php  if($dados['tipo_sangue']=="B-") echo "selected";  ?>>B-</option>
						<option value="AB+" <?php  if($dados['tipo_sangue']=="AB+") echo "selected";  ?>>AB+</option>
						<option value="AB-" <?php  if($dados['tipo_sangue']=="AB-") echo "selected";  ?>>AB-</option>
						<option value="O+"  <?php  if($dados['tipo_sangue']=="O+") echo "selected";  ?>>O+</option>
						<option value="O-"  <?php  if($dados['tipo_sangue']=="O-") echo "selected";  ?>>O-</option>
				</select>
            </span>
            <span>
                <p class="subtitulos margem">Pretendo Voltar em</p>
                <select name="F_tempo_retorno" form="carform">
                    <option value="90"  <?php  if($dados['tempo_retorno']==90) echo "selected";  ?>>3 Meses</option>
                    <option value="180" <?php  if($dados['tempo_retorno']==180) echo "selected";  ?>>6 Meses</option>
                    <option value="360" <?php  if($dados['tempo_retorno']==360) echo "selected";  ?>>1 ano</option>
                    <option value=""    <?php  if($dados['tempo_retorno']==NULL) echo "selected";  ?>>Nunca</option>
                </select>
            </span>
            <span>
                <p class="subtitulos margem">Foto</p>
                <div id="imgperfil"><img src="<?php echo htmlspecialchars($dados['foto']); ?>"></div>
                <input type="file">
            </span>



             <span>
                
            </form>
              <div class='mdl-grid'>
              <button type="submit" form="editarperfil" value="Submit" name="SalvarButton" id="entrarbt" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored">
              Salvar
              </button>
              <form action="album.php" id='back'>
                <button type="submit" form="back" value="Submit" name="BackButton" id="entrarbt" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored">
                    Cancelar
                </button>
              </form>
              
              </div>
            </span>
        </div>

        <div class="mdl-layout-spacer"></div>
    </content>
</body>
</html>
