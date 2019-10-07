<?php
require 'php/vendor/autoload.php';
use PontosDeVida\Connection as Connection;
use PontosDeVida\PontosDeVidaFuncoes as PontosDeVidaFuncoes;
session_start();

try {
	$pdo = Connection::get()->connect();
  $chamador = new PontosDeVidaFuncoes($pdo);
  $templates = $chamador->mostrarTemplates();
} catch (\PDOException $e) {
	 echo $e->getMessage();
}
//echo var_dump($figurinhas);
//echo var_dump($figurinhas);
// echo htmlspecialchars($figurinhas[0]['imagem']);
// echo htmlspecialchars($figurinhas[1]['imagem']);
// echo htmlspecialchars($figurinhas[2]['imagem']);
// echo htmlspecialchars($figurinhas[3]['imagem']);
// echo rand(5, 15);

if( isset($_POST['salvarretorno']) )
{
	$inserir = new PontosDeVidaFuncoes($pdo);
	$inserir->alterarTempo($_POST['tempo_retorno']);

// CRIAR DOACAO - VINDA DE retorno.php
//	$local = "Hemocentro-JP";
//	$inserirDoacao = new PontosDeVidaFuncoes($pdo);
//	$inserirDoacao->criarDoacao($local);
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
        <link rel="stylesheet" href="css/dialog-polyfill.css">

				<style>



/*
.selecionado {
  animation: pulse 1s;
}

}

@keyframes pulse {
} */

.selecionado{
	border-radius: 50% !important;
	transition: all 0.4s ease 0s;
		box-sizing: border-box;
		-moz-box-sizing: border-box;
		-webkit-box-sizing: border-box;
		border: 3px solid #b3d4fc;
	}

.selecionado img{
	border-radius: 50%;
	margin-top: -3px;
	transition: all 0.5s ease 0s;



	}

div.album-space img{
	transition: all 0.6s ease 0s;
}


				</style>




    </head>

    <body>
        <content>
            <div id="escolha_title" class="mdl-grid">
                <div class="mdl-layout-spacer"></div>
                <p id="faltanada">Escolha <span id='faltam'>5</span> figurinhas:</p>
                <div class="mdl-layout-spacer"></div>
            </div>
            <div id="escolha_figuras" class="mdl-grid">
                <div class="mdl-layout-spacer"></div>
                <div class="mdl-card mdl-cell mdl-cell--3-col"> <!-- inicio da estrutura do álbum-->
                    <div id="album-line" class="mdl-grid"> <!--Primeira linha do álbum> -->
												 <?php
												$i = 0;
												$total = (count($templates) - 1);
												while ($i < 3):
												?>
													<div class="mdl-cell mdl-cell--1-col album-space card-spot" onclick="trocaClasse(this);">
															<img style="height: 42px;" class="" src="img/fig/<?php echo htmlspecialchars($templates[rand(0,$total)]['imagem']); ?>" />
													</div>
												<?php
												    $i++;
												endwhile;
												 ?>
                    </div>

                    <div class="mdl-grid"> <!--Segunda linha do álbum> -->
												<?php
											 $i = 0;
											 $total = (count($templates) - 1);
											 while ($i < 3):
											 ?>
												 <div class="mdl-cell mdl-cell--1-col album-space card-spot" onclick="trocaClasse(this);">
														 <img style="height: 42px;" class="" src="img/fig/<?php echo htmlspecialchars($templates[rand(0,$total)]['imagem']); ?>" />
												 </div>
											 <?php
													 $i++;
											 endwhile;
												?>
									 </div>
                    <div class="mdl-grid"> <!--Terceira linha do álbum> -->
												<?php
											 $i = 0;
											 $total = (count($templates) - 1);
											 while ($i < 3):
											 ?>
												 <div class="mdl-cell mdl-cell--1-col album-space card-spot" onclick="trocaClasse(this);">
														 <img style="height: 42px;" class="" src="img/fig/<?php echo htmlspecialchars($templates[rand(0,$total)]['imagem']); ?>" />
												 </div>
											 <?php
													 $i++;
											 endwhile;
												?>
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

				<script>

				// função para contabilizar figurinhas selecionadas.
					function trocaClasse(elemento){
						elemento.classList.toggle("selecionado");
						selecionados = numeroSelecionados();
						if (selecionados > 5) {
						document.getElementById("faltanada").innerHTML = ("passou do limite");
						var todos = document.getElementsByClassName('selecionado');
						while (todos[0]) {
							todos[0].classList.remove('selecionado')
						}
						selecionados2 = numeroSelecionados();
						setTimeout(function(){ document.getElementById("faltanada").innerHTML = ("Escolha <span id='faltam'>" + (5 - parseInt(selecionados2)) + "</span> figurinhas:"); }, 1000);
			  	 	}
							 	 if (selecionados < 5) {
							 	 document.getElementById("faltanada").innerHTML = ("Escolha <span id='faltam'>" + (5 - parseInt(selecionados)) + "</span> figurinhas:");
									 if (selecionados == 4){
									 document.getElementById("faltanada").innerHTML = ("Só mais <span id='faltam'>1</span> figurinha:");
									 }
							} if (selecionados == 5) {
									document.getElementById("faltanada").innerText = ("boa escolha!");
							}

					}

					// funcao para pegar o numero de elementos com classe selecionado
					function numeroSelecionados(){
						return document.getElementsByClassName("selecionado").length;
					}

				</script>


    </body>
</html>
