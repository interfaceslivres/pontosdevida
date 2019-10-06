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

?>
<?php
    class imageUploader
    {
      const UPLOADS_FOLDER = './img/Users';

      static function upload()
      {
        $imagefile = $_FILES;

        if( !isset($imagefile['F_foto']['error']) )
          throw new RuntimeException('Invalid parameters.');

        //multiple uploads not permitted. you should queue file uploads from the client
        if(is_array($imagefile['F_foto']['error']))
          throw new RuntimeException('Only one file allowed.');

        switch ($imagefile['F_foto']['error']) {
          case UPLOAD_ERR_OK:
            break;
          case UPLOAD_ERR_NO_FILE:
            throw new RuntimeException('No file sent.');
          case UPLOAD_ERR_INI_SIZE:
          case UPLOAD_ERR_FORM_SIZE:
            throw new RuntimeException('Exceeded filesize limit.');
          default:
            throw new RuntimeException('Unknown errors.');
        }

        $max = 5*1048576;
        if ($imagefile['F_foto']['size'] > $max)
            throw new RuntimeException('Exceeded filesize limit.');

        //check the file type - but not the one sent by the browser instead use finfo
        $finfo = new finfo(FILEINFO_MIME_TYPE);
        $mime = $finfo->file($_FILES['F_foto']['tmp_name']);
        $allowed = array('jpg' => 'image/jpeg', 'png' => 'image/png', 'gif' => 'image/gif');
        $ext = array_search($mime, $allowed, true);

        if(false === $ext)
          throw new RuntimeException('Invalid file format.');

        $path = sprintf( self::UPLOADS_FOLDER . '/%s.%s', $_SESSION['username'] ,"jpg");
        if (!move_uploaded_file( $imagefile['F_foto']['tmp_name'],$path))
          throw new RuntimeException('Failed to move uploaded file.');
        else
            compressImage($path,$path,25,$mime) ;
            return true;
      }
    }
    function compressImage($source, $destination, $quality,$mime) {

        $info = getimagesize($source);

        if ($mime == 'image/jpeg')
          $image = imagecreatefromjpeg($source);

        elseif ($mime == 'image/gif')
          $image = imagecreatefromgif($source);

        elseif ($mime == 'image/png')
          $image = imagecreatefrompng($source);

        imagejpeg($image, $destination, $quality);

      }
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
    <content>
        <div id="cabecalho_editar_perfil" class="mdl-grid">
            <div class="mdl-layout-spacer"></div>
                <div id="figura_cabecalho" class="mdl-card">
                    <p id="figura_title">
                        <span class="pontos">.</span><span>Editar Perfil</span>
                    </p>
                </div>
            <div class="mdl-layout-spacer"></div>
        </div>
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
              $erroFoto="";
    	      if( isset($_POST['SalvarButton']) )
    	      {


                $pdo = Connection::get()->connect();
                $chamador = new PontosDeVidaFuncoes($pdo);
                $login_usuario=$_SESSION['username'];
                $email=$_POST['F_email'];
                $nome=$_POST['F_nome'];

                $biografia=$_POST['F_biografia'];
                if( isset($_POST['F_data_nascimento'])){
                    $data_nascimento=strrev($_POST['F_data_nascimento']);
                    $data_nascimento=str_replace('/', '-', $data_nascimento);
                    $data_nascimento=str_replace(' ', '', $data_nascimento);
                }
                else{
                    $data_nascimento=NULL;
                }

                if( isset($_POST['F_privacidade'])){
                    $privacidade=1;
                }
                else{
                    $privacidade=0;
                }
                $tipo_sangue=$_POST['F_tipo_sanguineo'];
                if( isset($_POST['F_tempo_retorno'])){
                    $tempo_retorno=$_POST['F_tempo_retorno'];
                }
                else{
                    $tempo_retorno=NULL;
                }

                $senha=$_POST['F_senha'];
                if($chamador->confirmaSenha($senha)){
                    try {
                        $Continue=1;
                        $isUploaded = imageUploader::upload();
                        } catch (Exception $e) {
                            #echo '<pre>'; var_dump($e);
                            $Continue=0;
                        }
                        if( isset($isUploaded)){
                            $foto="img/Users/".$_SESSION['username'].".jpg";
                            //LOCAL PARA RECARREGAR CASO NAO DE VIA JS
                        }
                        else{
                            $foto=$dados['foto'];
                        }
                        if($Continue){
                            $chamador->configUsuario($login_usuario,
                            $email,$nome,$biografia,$data_nascimento,
                            $privacidade,$tipo_sangue,$tempo_retorno,$foto);
                            //REDIRECT PARA ALBUM
                            header("Location: album.php");
                        }
                        else{
                            //RETORNAR ERRO NO ENVIO DA FOTO
                            $erroFoto="Erro ao enviar a foto";
                        }



                }

    	      }
    	      ?>

          <div id="conteudo_editar_perfil" class="mdl-grid">
                <div class="mdl-layout-spacer"></div>
                

          <form method="post" action="" id="editarperfil" enctype="multipart/form-data">

            <div class="mdl-grid">
                <div class="mdl-layout-spacer"></div>
                    <div class="mdl-cell mdl-cell--6-col-desktop mdl-cell--4-col-tablet mdl-cell--2-col-phone">
                        <!-- CRIAR ESPACO PARA MENSAGEM DE ERRO DA FOTO -->
                        <div id="errorimg"> <?php echo $erroFoto;?></div>
                        <div id="foto_editar_perfil" class="foto_editar_perfil"><img src="<?php echo htmlspecialchars($dados['foto']."?".time()); ?>"></div>
                        <input name="F_foto" id="F_foto" type="file">
                        <label id="alterar_foto_button" for='F_foto'>ALTERAR FOTO</label>
                    </div>
                <div class="mdl-layout-spacer"></div>
            </div>
            
            <div class="mdl-cell">
                <p class="label_editar_perfil">E-mail:</p>
                <input type="text" id="F_email" class="caixa_edicaoperfil" name="F_email" required>
                <script type="text/javascript">
                    document.getElementById('F_email').value = "<?php echo htmlspecialchars($dados['email'])  ?>";
                </script>
            </div>
        
            <div class="mdl-cell">
                <p class="label_editar_perfil">Nome:</p>
                <input name="F_nome" id="F_nome" class="caixa_edicaoperfil" type="text" required>
                <script type="text/javascript">
                    document.getElementById('F_nome').value = "<?php echo htmlspecialchars($dados['nome'])  ?>";
                </script>
            </div>

            <div class="mdl-cell">
                <p class="label_editar_perfil">Biografia:</p>
                <input name="F_biografia" type="text" id="F_biografia" class="caixa_edicaoperfil" placeholder="">
                <script type="text/javascript">
                    document.getElementById('F_biografia').value = " <?php echo htmlspecialchars($dados['biografia']) ?> ";
                </script>
            </div>
            
            <div class="mdl-cell">
                <p class="label_editar_perfil">
                    Data de Nascimento <span class="sublabel_editar_perfil">(DD/MM/AAAA)</span>:
                </p>
                <?php
                    $nascimento=strrev($dados['data_nascimento']);
                    $nascimento=str_replace('-', '/', $nascimento);
                ?>
                <input name="F_data_nascimento" id="F_data_nascimento" class="caixa_edicaoperfil" type="text" >
                <script type="text/javascript">
                    document.getElementById('F_data_nascimento').value = " <?php echo htmlspecialchars($nascimento) ?> ";
                </script>
            </div>

            <span>

                <label class="mdl-switch mdl-js-switch mdl-js-ripple-effect" for="switch-1">
                    <span class="mdl-switch__label subtitulos">Mostrar Tipo Sanguíneo</span>
                    <input name="F_privacidade"  type="checkbox" <?php if($dados['privacidade']) echo "checked"; ?> style="display:none;"id="switch-1" class="mdl-switch__input">
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

            <div class="mdl-cell">
                <p class="label_editar_perfil">Confirmar Senha:</p>
                <input name="F_senha" id="F_senha" class="caixa_edicaoperfil" type="password" >
            </div>

            </form>

                <div class="mdl-layout-spacer"></div>
            </div>

            <div class="mdl-grid">
                <div class="mdl-layout-spacer"></div>
                <div id="figura_desc_buttons" class="mdl-cell mdl-cell--1-col">
                    <button type="submit" form="editarperfil" value="Submit" name="SalvarButton" class="mdl-button" id="salvar_edicao_button">
                        Salvar
                    </button>
                    <form action="album.php" id='back'>
                        <button type="submit" form="back" value="Submit" name="BackButton" class="mdl-button" id="cancelar_edicao_button">
                            Cancelar
                        </button>
                    </form>
                </div>
                <div class="mdl-layout-spacer"></div>
            </div>

              <!-- <div class='mdl-grid'>
              <button type="submit" form="editarperfil" value="Submit" name="SalvarButton" id="entrarbt" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored">
              Salvar
              </button>

              <form action="album.php" id='back'>
                <button type="submit" form="back" value="Submit" name="BackButton" id="sairbt" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored">
                    Cancelar
                </button>
              </form>

              </div> -->
    </content>
</body>
</html>
