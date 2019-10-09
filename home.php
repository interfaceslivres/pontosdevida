<!--
Tela: Perfil
Aplicativo: Pontos de Vida
Desenvolvido por: Interfaces Livres
-->
<?php
require 'php/vendor/autoload.php';
use PontosDeVida\Connection as Connection;
use PontosDeVida\PontosDeVidaFuncoes as PontosDeVidaFuncoes;
session_start();
if((!isset ($_SESSION['username']) == true) and (!isset ($_SESSION['valid']) == true))
{
  unset($_SESSION['username']);
  unset($_SESSION['valid']);
  header('location:index.php');
}

try {
	$pdo = Connection::get()->connect();
  $chamador = new PontosDeVidaFuncoes($pdo);
  $dados = $chamador->meusDados();
  if($dados['sexo']=='M'){
    $cdmin=60;
  }
  else{
    $cdmin=90;
  }
} catch (\PDOException $e) {
	 echo $e->getMessage();
}

?>


<!DOCTYPE html>
<html>
<head>
	<title>Pontos de Vida</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
	<link rel="stylesheet" type="text/css" href="style.css">
	<link rel="stylesheet" href="mdl/material.min.css">
	<script src="mdl/material.min.js" id="mdl-script"></script>
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link rel="manifest" href="manifest.webmanifest">

<style>

.CDcompleto {


}

</style>


</head>

<body>
    <div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
        <header id="fixedheader" class="mdl-layout__header">
            <div class="mdl-layout__header-row">
                <a href="#" onclick="include('./editarperfil.php')"><span class="level mdl-badge mdl-badge--overlap" data-badge="⚙️" data-percent="0">
                    <span class="imagem_perfil"><img src="<?php echo htmlspecialchars($dados['foto']."?".time());?>"></span>
                </span>
                </a>

                <div class="mdl-layout-spacer"></div>
                <img id="simbolo" src="img/simbolo.png" height="65%">
                <div class="mdl-layout-spacer"></div>

                <span id="porcentagem" class="contador" data-percent="0">
                        <span class="texto_canvas"></span>
                </span>
            </div>
        </header>


						<main id="conteudo" class="mdl-layout__content">
								<iframe src="album.php" onload="trocaIcone(this);" frameborder="0" width="100%" height="100%"></iframe>
								<!-- Aqui é inserido o conteúdo dos componentes através do iframe -->
						</main>

        <footer>
            <div class="mdl-layout__header-row">
                <div class="mdl-layout-spacer"></div>
                <button id="botaocontatos" class="mdl-button mdl-js-button" onclick="include('./amigos.php')">
                    <div class="mdl-layout-spacer"></div>
                    <img id="iconcontatos" src="img/amigos.png" height="25px">
                    <div class="mdl-layout-spacer"></div>
                </button>

                <div class="mdl-layout-spacer"></div>
                <button id="botaocentro" class="mdl-button mdl-js-button mdl-button--fab mdl-button--colored" onclick="include('./scanner.php')">
                <p><img id="iconcentro" src="img/qrcode.png" height="30px"></p>
                </button>
                <div class="mdl-layout-spacer"></div>

                <button id="botaoalbuns" class="mdl-button mdl-js-button" onclick="include('./notificacoes.php')">
                    <div class="mdl-layout-spacer"></div>
                    <img class="iconalbuns" src="img/notificacoes.png" height="25px">
                    <div class="mdl-layout-spacer"></div>
                </button>
                <div class="mdl-layout-spacer"></div>
            </div>
        </footer>
    </div>

    <script src="./js/easypiechart.js"></script>
    <script src="./js/w3.js"></script>
    <script src="./js/dialog-polyfill.js"></script>
    <script src="./js/jsqrcode.js"></script>
    <script src="app.js"></script>
    <script>
        if('serviceWorker' in navigator) {
            window.addEventListener('load', () => {
                navigator.serviceWorker.register("sw.js")
                .then(() => {
                })
                .catch(() => {
                })
            })
        };
        <?php
        $dias = $chamador->diasDesdaDoacao();
        if($dias == -1){
          $cooldown = 0;
        } elseif ($dias <= $cdmin) {
          $cooldown = ($cdmin - $dias);
        }
        else  {
        $cooldown = 0;
       }



        ?>
        // programação do contador regressivo para doação
        document.addEventListener('DOMContentLoaded', () => {

            var itemporcentagem = document.getElementById('porcentagem');
            var percento = (<?php echo $cdmin; ?> - (<?php echo $cooldown; ?> * 1)) / <?php echo $cdmin; ?> * 100;
            itemporcentagem.setAttribute("data-percent", percento);

            // if (percento == 100) {
            // itemporcentagem.setAttribute('class', 'contador CDcompleto');
            // };


            var contador = document.querySelector('.contador');
            new EasyPieChart(contador, {
                barColor: function (percent) {
                  return (percent < 50 ? '#cb3935' : percent < 85 ? '#f0ad4e' : '#5cb85c');
                },
                lineWidth: 5,
                scaleColor: false,
                size: 41,
                lineCap: 'butt',
                onStep: function(from, to, percent) {
                    this.el.children[0].innerHTML = <?php echo $cooldown; ?>;
                }
            });



        });

        // programação do contador de nível
        document.addEventListener('DOMContentLoaded', () => {
            var contador = document.querySelector('.level');
            new EasyPieChart(contador, {
                lineWidth: 5,
                scaleColor: false,
                size: 41,
                lineCap: 'butt',
            });
        });

        // programação que chama o conteúdo do ifrawindow.location.pathnameme
        function include(caminho){
            let pagina = document.getElementsByTagName("iframe")[0];
            pagina.setAttribute("src", caminho);

        };

				function trocaIcone(obj) {
						url = (obj.contentWindow.location.pathname);
						album = "album";
						if (url.includes(album)) {
							 document.getElementById('iconcentro').setAttribute('src', 'img/qrcode.png');
					     document.getElementById('botaocentro').setAttribute('onclick', "include('./scanner.php')")
						} else{
                document.getElementById('iconcentro').setAttribute('src', 'img/inicio.png');
                document.getElementById('botaocentro').setAttribute('onclick', "include('./album.php')")
            }
				};

    </script>
</body>
</html>
