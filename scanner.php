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
            <video autoplay id="camsource"></video>
        </div>
    </div>

    <script src="js/jsqrcode.js"></script>
    <script src="app.js"></script>
    <script>
        if(!iOS()){
        let qrDialog = document.getElementById("qrCodeDialog");


        // script que programa o funcionamento do leitor de QR Code //

        // -- aqui cria um canvas que exibe a imagem da camera --
        let qrCanvas = document.createElement('canvas');
        qrCanvas.id = 'qr-canvas';
        qrCanvas.style.display = 'none';
        qrDialog.appendChild(qrCanvas);
        addEventListener
        // -- aqui configura a tag video para exibir a imagem da webcam --
        let qrVideo = qrDialog.querySelector('#camsource');
        let videoOptions = {
            "audio": false,
            "video": { facingMode: "environment"  }
        };

        // -- aqui configura a webcam como fonte de imagem da tag vídeo

        var stream = new MediaSource();

        // console.assert(navigator.getUserMedia, 'navigator.getUserMedia not defined')
        
        
       

            navigator.getUserMedia(videoOptions, function (stream) {
            qrVideo.srcObject = stream;
        }, (error)=> {
            console.log(error);
            alert('Camera traseira desativada');
        });

        // aqui armazena a informação recebida pelo Leitor

        qrcode.callback = function read(qrCodeValue){
                // console.log(qrCodeValue);
                var parts = qrCodeValue.split('/');
                var lastSegment = parts.pop() || parts.pop();  // handle potential trailing slash

                // console.log(lastSegment);
                if(lastSegment=='retorno.php'){
                    window.location.href = '/'+lastSegment;
                }
            
				

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
            } catch(error) {
                console.log('jsqrcode', error);
				// alert('Não consigo ler o QrCode');
                var foundResult = false;
            };

            return foundResult;
        }

        // -- Iniciando o leitor

            scanVideoNow()
            setInterval(() => {scanVideoNow()}, 500);
        }
        else{
            window.location.href = 'ios.php';
        }
        function iOS() {

        var iDevices = [
        'iPad Simulator',
        'iPhone Simulator',
        'iPod Simulator',
        'iPad',
        'iPhone',
        'iPod'
        ];

        if (!!navigator.platform) {
        while (iDevices.length) {
            if (navigator.platform === iDevices.pop()){ return true; }
        }
        }

        return false;
        }



    </script>
</body>
</html>
