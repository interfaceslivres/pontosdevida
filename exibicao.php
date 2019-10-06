<?php
require 'php/vendor/autoload.php';
use PontosDeVida\Connection as Connection;
use PontosDeVida\PontosDeVidaFuncoes as PontosDeVidaFuncoes;
session_start();
// teste de atualizacao n+1
$User=$_GET['user'];
if($User==$_SESSION["username"] and $User!=""){
    header("Location: album.php");
}

try {
    $pdo = Connection::get()->connect();
  $chamador = new PontosDeVidaFuncoes($pdo);
  $boolamigos=$chamador->saoAmigos($User,$_SESSION["username"]);
} catch (\PDOException $e) {
	 echo $e->getMessage();
};

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
        <link rel="stylesheet" href="css/dialog-polyfill.css">

				<style>
					.invisivel {display: block;}
					.visivel {display: block;}
				</style>


    </head>
    <body>
    <div class="mdl-grid">
    <form action="amigos.php" id='back'>
        <button type="submit" form="back" value="Submit" name="BackButton" id="voltarBtn" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored">
            Voltar
        </button>
    </form>
    </div>
    <?php if($boolamigos){
        $dados=$chamador->mostrarUsuario($User)[0];
        $sangue="";
        if($dados['privacidade']){
            $sangue=$dados['tipo_sangue'];
        }
        $figurinhas=$chamador->mostrarFigurinha($User);

                    ?>
      <content>
          <div class="mdl-tabs__panel">
          <div id="perfil-div" class="mdl-grid">
              <div class="mdl-layout-spacer"></div>
              <div id="album-box" class="mdl-cell mdl-cell--3-col">

                  <div class="mdl-grid">
                      <div id="cla-infos" class="mdl-cell mdl-cell--3-col">

                          <div id="img_infos">
                            <div id="imgperfil"><img src="<?php echo htmlspecialchars($dados['foto']); ?>"></div>
                              

                              <div id="perfilinfos">
                                  <p class="titulo">
                                      <span id="perfilnome"><?php echo htmlspecialchars($dados['nome']) ?></span>
                                    </p>
                                  <p id="perfilbio"><?php echo htmlspecialchars($dados['biografia']); ?></p>
                                  <p id="perfiltiposanguineo"><?php if($sangue!="")echo "Tipo ";?> <?php echo htmlspecialchars($sangue); ?></p>
                              </div>
                          </div>
                      </div>
                  </div>

              </div>
              <div class="mdl-layout-spacer"></div>
              </div>
          </div>

          <div class="mdl-tabs mdl-js-tabs">
              <div id="categorias-albumatual-bottom" class="mdl-grid">
                  <div class="mdl-layout-spacer"></div>
                  <div id="categorias-albumatual" class="mdl-tabs__tab-bar">
                          <p id="categoria-album">
                          <span class="pontos">.</span><span>Álbum</span>
                          </p>
                  </div>
                  <div class="mdl-layout-spacer"></div>
              </div>

              <div class="mdl-tabs__panel is-active" id="albuns"> <!-- Primeira Aba -->

                  <div class="mdl-grid">
                  <div class="mdl-layout-spacer"></div>
                      <p id="album-title"><span id="album-title-space">⠀<span id="album-title-txt">Toda jornada tem um começo</span>⠀</span></p>
                  <div class="mdl-layout-spacer"></div>
                  </div>

                  <div id="figuras-grade" class="mdl-grid">
                      <div class="mdl-layout-spacer"></div>
                      <div class="mdl-card mdl-cell mdl-cell--4-col"> <!-- inicio da estrutura do álbum-->
                      <div class="mdl-grid">
                        <?php 
                        for($i=0;$i<16;$i++){
                            $figurinha=NULL;
                            foreach($figurinhas as $fig=>$v){
                                if($v['posicao']==$i){
                                    $figurinha=$v;
                                    break;
                                }
                                else{
                                    $figurinha=NULL;
                                }
                            }
                             
                             ?><div class="mdl-cell mdl-cell--1-col album-space card-spot"><?php 
                             if($figurinha!=NULL){
                                echo '<img style="height: 42px" src="img/fig/' . ($figurinha["imagem"]) . '"/>';
                             }
                            ?></div><?php 
                            if ($i+1==16){
                                echo '</div>';
                                
                            }
                            else {
                                if( ( ($i+1) % 4) ==0){
                                echo '</div>
                                <div class="mdl-grid">' ;
                            }}
                        }
                            ?>
                          <div class="mdl-grid">
                          </div> 
                      </div>
                      <div class="mdl-layout-spacer"></div>
                  </div>
                </div>
          </div>
          <div id="bottom-space" class="mdl-grid"></div>
      </content>
      <?php } 
      else{?>
      
        <!-- AJUSTAR PAGINA DE ERRO  AQUI-->
        <div class="mdl-grid"> 
            VOCE NAO TEM ACESSO AO PERFIL DESTA PESSOA, POR FAVOR VOLTE AO MENU DE AMIGOS E TENTE NOVAMENTE.
        </div>



        <?php } ?>
        
        <script src="app.js"></script>
    </body>
</html>
