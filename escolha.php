<?php
require 'php/vendor/autoload.php';
use PontosDeVida\Connection as Connection;
use PontosDeVida\PontosDeVidaFuncoes as PontosDeVidaFuncoes;
session_start();

try {
	$pdo = Connection::get()->connect();
  $chamador = new PontosDeVidaFuncoes($pdo);
  $figurinhas = $chamador->mostrarTemplate();
} catch (\PDOException $e) {
	 echo $e->getMessage();
}
//echo var_dump($figurinhas);
//echo var_dump($figurinhas);
echo htmlspecialchars($figurinhas[0]['imagem']);
echo htmlspecialchars($figurinhas[1]['imagem']);
echo htmlspecialchars($figurinhas[2]['imagem']);
echo htmlspecialchars($figurinhas[3]['imagem']);

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
            <div id="escolha_title" class="mdl-grid">
                <div class="mdl-layout-spacer"></div>
                <p>Escolha 4 Figurinhas:</p>
                <div class="mdl-layout-spacer"></div>
            </div>
            <div id="escolha_figuras" class="mdl-grid">
                <div class="mdl-layout-spacer"></div>
                <div class="mdl-card mdl-cell mdl-cell--3-col"> <!-- inicio da estrutura do álbum-->
                    <div id="album-line" class="mdl-grid"> <!--Primeira linha do álbum> -->
                        <div class="mdl-cell mdl-cell--1-col album-space card-spot">
                            <img style="height: 42px;" class="" src="img/fig/03gaspar.jpg" />
                        </div>
                        <div class="mdl-cell mdl-cell--1-col album-space card-spot">
                            <img style="height: 42px;" class="" src="img/fig/03obsequio.jpg"/>
                        </div>
                        <div class="mdl-cell mdl-cell--1-col album-space card-spot">
                            <img style="height: 42px;" class="" src="img/fig/03vampirinho.jpg"/>
                        </div>
                    </div>
                    <div class="mdl-grid"> <!--Segunda linha do álbum> -->
                        <div class="mdl-cell mdl-cell--1-col album-space card-spot">
                            <img style="height: 42px;" class="" src="img/fig/03gaspar.jpg"/>
                        </div>
                        <div class="mdl-cell mdl-cell--1-col album-space card-spot">
                            <img style="height: 42px;" class="" src="img/fig/03obsequio.jpg"/>
                        </div>
                        <div class="mdl-cell mdl-cell--1-col album-space card-spot">
                            <img style="height: 42px;" class="" src="img/fig/03vampirinho.jpg"/>
                        </div>
                    </div>
                    <div class="mdl-grid"> <!--Terceira linha do álbum> -->
                        <div class="mdl-cell mdl-cell--1-col album-space card-spot">
                            <img class="" style="height: 42px;" src="img/fig/03water.jpg"/>
                        </div>
                        <div class="mdl-cell mdl-cell--1-col album-space card-spot">
                            <img style="height: 42px;" class="" src="img/fig/03water.jpg"/>
                        </div>
                    </div>
                </div>
                <div class="mdl-layout-spacer"></div>
            </div>

            <div class="mdl-grid">
                <div class="mdl-layout-spacer"></div>
                    <button class="mdl-button" id="coletar_button" onclick="">
                        Coletar
                    </button>
                <div class="mdl-layout-spacer"></div>
            </div>
        </content>
    </body>
</html>
