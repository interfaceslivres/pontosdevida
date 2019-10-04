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
      
        <div id="qrCodeDialog">
            <button class="mdl-button mdl-js-button mdl-button--fab close">x</button>
            <video autoplay id="camsource"></video>
        </div>        
    </div>

    <script src="./js/jsqrcode.js"></script>
    <script src="app.js"></script>
    <script>
 

        // script que abre o leitor de QR Code

        let qrDialog = document.getElementById("qrCodeDialog");


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
        document.addEventListener('onload',() =>{
            scanVideoNow();
        })
  

    </script>
</body>
</html>