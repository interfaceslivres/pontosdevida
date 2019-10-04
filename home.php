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

try {
	$pdo = Connection::get()->connect();
  $chamador = new PontosDeVidaFuncoes($pdo);
  $dados = $chamador->meusDados();
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
	<link rel="stylesheet" href="css/dialog-polyfill.css">
</head>

<body>
    <div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
        <header id="fixedheader" class="mdl-layout__header">
            <div class="mdl-layout__header-row">
                <a href="#" onclick="include('editalperfil.php')"><span class="level mdl-badge mdl-badge--overlap" data-badge="5" data-percent="45">
                    <span class="imagem_perfil"><img src="<?php echo htmlspecialchars($dados['foto'])."?".time());?>"></span>
                </span>
                </a>

                <div class="mdl-layout-spacer"></div>
                <img id="simbolo" src="img/simbolo.png" height="65%">
                <div class="mdl-layout-spacer"></div>

                <span class="contador" data-percent="75">
                        <span class="texto_canvas"></span>
                </span>
            </div>
        </header>


						<main id="conteudo" class="mdl-layout__content">
								<iframe src="album.php" frameborder="0" width="100%" height="100%"></iframe>
								<!-- Aqui é inserido o conteúdo dos componentes através do iframe -->
						</main>

        <footer>
            <div class="mdl-layout__header-row">
                <div class="mdl-layout-spacer"></div>
                <button id="botaocontatos" class="mdl-button mdl-js-button" onclick="include('./pages/amigos.html')">
                    <div class="mdl-layout-spacer"></div>
                    <img id="iconcontatos" src="img/amigos.png" height="25px">
                    <div class="mdl-layout-spacer"></div>
                </button>

                <div class="mdl-layout-spacer"></div>
                <button id="botaocentro" class="mdl-button mdl-js-button mdl-button--fab mdl-button--colored" onclick="include('album.php')">
                <p><img id="iconcentro" src="img/inicio.png" height="30px"></p>
                </button>
                <div class="mdl-layout-spacer"></div>

                <button id="botaoalbuns" class="mdl-button mdl-js-button" onclick="include('./pages/notificacoes.html')">
                    <div class="mdl-layout-spacer"></div>
                    <img class="iconalbuns" src="img/notificacoes.png" height="25px">
                    <div class="mdl-layout-spacer"></div>
                </button>
                <div class="mdl-layout-spacer"></div>
            </div>
        </footer>
    </div>

    <dialog class="mdl-dialog" id="qrCodeDialog">
        <button class="mdl-button mdl-js-button mdl-button--fab close">x</button>
        <video autoplay id="camsource"></video>
    </dialog>

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
                    console.log('O Service Worker foi registrado corretamente');

                })
                .catch(() => {
                    console.warn('O Service Worker Falhou!');
                })
            })
        }

        // programação do contador regressivo para doação


        document.addEventListener('DOMContentLoaded', () => {
            var contador = document.querySelector('.contador');
            new EasyPieChart(contador, {
                lineWidth: 5,
                scaleColor: false,
                size: 41,
                lineCap: 'butt',
                onStep: function(from, to, percent) {
                    this.el.children[0].innerHTML = 12;
                }
            });
        })

        // programação do contador de nível


        document.addEventListener('DOMContentLoaded', () => {
            var contador = document.querySelector('.level');
            new EasyPieChart(contador, {
                lineWidth: 5,
                scaleColor: false,
                size: 41,
                lineCap: 'butt',
            });
        })



        // programação que chama o conteúdo do iframe

        function include(caminho){

        let pagina = document.getElementsByTagName("iframe")[0];
        pagina.setAttribute("src", caminho);
        }


        // script que abre o leitor de QR Code

        // let qrDialog = document.getElementById("qrCodeDialog");
        // let showQrDialog = document.getElementById('botaocentro');

        if(!qrDialog.showModal){
            dialogPolyfill.registerDialog(qrDialog);
        };

        showQrDialog.addEventListener('click', ()=> {
            qrDialog.showModal();
        });

        qrDialog.querySelector('.close').addEventListener('click', ()=> {
            qrDialog.close();
        })

        // script que programa o funcionamento do leito de QR Code //

        // -- aqui cria um canvas que exibe a imagem da camera --
        let qrCanvas = document.createElement('canvas');
        qrCanvas.id = 'qr-canvas';
        qrCanvas.style.display = 'none'
        qrDialog.appendChild(qrCanvas);

        // -- aqui configura a tag video para exibir a imagem da webcam --
        let qrVideo = qrDialog.querySelector('#camsource');
        let videoOptions = {
            "audio": false,
            "video": true
        };

        // -- aqui configura a webcam como fonte de imagem da tag vídeo

        var stream = new MediaSource();

        console.assert(navigator.getUserMedia, 'navigator.getUserMedia not defined')
        navigator.getUserMedia(videoOptions, function (stream) {
            qrVideo.srcObject = stream;
        }, (error)=> {
            console.log(error);
        });

        // aqui armazena a informação recebida pelo Leitor

        qrcode.callback = function read(qrCodeValue){
            alert(qrCodeValue);
        };

        // -- função que escaneia o vídeo

        function scanVideoNow() {

            if(qrVideo.videoWidth === 0) return;

            let scale = 0.5
            let qrCanvas = qrDialog.querySelector("#qr-canvas");
            let context = qrCanvas.getContext('2d');
            qrCanvas.width = qrVideo.videoWidth * scale;
            qrCanvas.height = qrVideo.videoHeight * scale;
            context.drawImage(qrVideo, 0, 0, qrCanvas.width, qrCanvas.height);

            try {
                qrcode.decode();
                var foundResult = true;
            } catch(erro) {
                console.log('jsqrcode', error);
                var foundResult = false;
            };

            return foundResult;
        }

        // -- Iniciando o leitor

        // scanVideoNow();
        // setInterval(()=>{
        //     scanVideoNow()
        // }, 1000);

    </script>
</body>
</html>
