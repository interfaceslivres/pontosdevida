<?php
require 'php/vendor/autoload.php';
use PontosDeVida\Connection as Connection;
use PontosDeVida\PontosDeVidaFuncoes as PontosDeVidaFuncoes;
session_start();
// teste de atualizacao n+1

$artistas = [
    "01" => "Lucas Freitas e Beatriz Rolim",
    "02" => "Lucas Nóbrega",
    "03" => "Firulas Ilustra",
    "04" => "Jessé Luiz",
    "05" => "Matt Henrique",
    "06" => "Wesley Barbosa",
];

try {
    $pdo = Connection::get()->connect();
    $chamador = new PontosDeVidaFuncoes($pdo);
    $templates=$chamador->mostrarTemplates();
    $gett=$_GET['template'];
    $found=0;
    foreach($templates as $i=>$v){
        if($gett==$v['imagem']){
            $found=1;
            $template=$v;
            $codArtista=substr($template['imagem'], 0, 2);
            break;
        }
    }
    if(!$found){
        if(isset($_SESSION['username'])){
            header("Location: home.php");//MANDA PRO HOME
        }
        else{
            header("Location: index.php");//MANDA PRO LOGIN
        }
    }
    $postado=0;
    if(isset($_POST['figurinha'])){
        $postado=1;
        $figurinha=$_POST['figurinha'];
    }


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
    </head>

    <body>
        <content>
        <script>
        function goBack() {
            window.history.back();
        }
        </script>
        <?php
            if($postado or isset($_GET['exibicao'])){
                echo '<button onclick="goBack()"class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored">
                Voltar
            </button>';
            }
        ?>

            <div class="mdl-grid">
                <div class="mdl-layout-spacer"></div>
                    <div id="figura_cabecalho" class="mdl-card">
                        <p id="figura_title">
                            <span class="pontos">.</span><span><?php echo $template['nome'] ?></span>
                        </p>
                    </div>
                <div class="mdl-layout-spacer"></div>
            </div>
            <div id="escolha_figuras" class="mdl-grid">
                <div class="mdl-layout-spacer"></div>
                <div class="mdl-card">
                    <div id="desc_img" class="mdl-cell mdl-cell--1-col card-spot">
                        <img style="height: 238px;" class="" src=<?php echo '"img/fig/'. $template['imagem'].'"' ?> />
                    </div>
                </div>
                <div class="mdl-layout-spacer"></div>
            </div>

            <div class="mdl-grid">
                <div class="mdl-layout-spacer"></div>
                        <p id="figura_artista">
                            <span>Artista: </span>
                            <span><?php echo $artistas[$codArtista]; ?></span>
                        </p>
                <div class="mdl-layout-spacer"></div>
            </div>

            <div class="mdl-grid">
                <div class="mdl-layout-spacer"></div>
                <div id="figura_descricao">
                    <p>
                    <?php echo $template['descricao']; ?>
                    </p>
                </div>
                <div class="mdl-layout-spacer"></div>
            </div>

            <div class="mdl-grid">
                <div class="mdl-layout-spacer"></div>
                <div id="figura_desc_buttons" class="mdl-cell mdl-cell--1-col">
                    <!-- <button class="mdl-button" id="donate_fig_button" onclick="">
                        Doar Figurinha
                    </button> -->
                    <!-- <button class="mdl-button" id="share_fig_button" onclick="compartilhaAndroid();">
                        <img style="height: 18px;" class="" src="img/compartilhar.png" />
                        COMPARTILHAR
                    </button> -->
                </div>
                <div class="mdl-layout-spacer"></div>
            </div>

            <div class="mdl-grid" >
                <div class="mdl-layout-spacer"></div>
                    <p id="separador_desc"></p>
                <div class="mdl-layout-spacer"></div>
            </div>




        </content>

        <script>


                  if (navigator.share) {
                    document.getElementById('figura_desc_buttons').innerHTML = "<button class='mdl-button' id='share_fig_button' onclick='compartilhaAndroid();'><img style='height: 18px;' class='' src='img/compartilhar.png' />COMPARTILHAR</button>";
                  }


        function compartilhaAndroid(){

          var titulo = '<?php echo $template['nome'] ?>';
          // var urlraiz = window.location.hostname;
          var imagem = '<?php echo $template['imagem']?>';

          if (navigator.share) {
            navigator.share({
                title: titulo,
                text: titulo + ': Doe sangue.',
                url: 'descricao.php?template=' + imagem + '&exibicao=1',
            })
              .then(() => alert('Successful share'))
              .catch((error) => alert('Error sharing', error));
          }
        }

        </script>


    </body>
</html>
