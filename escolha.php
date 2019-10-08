<?php
require 'php/vendor/autoload.php';
use PontosDeVida\Connection as Connection;
use PontosDeVida\PontosDeVidaFuncoes as PontosDeVidaFuncoes;
session_start();

try {
	$pdo = Connection::get()->connect();
  $chamador = new PontosDeVidaFuncoes($pdo);
  $templates = $chamador->mostrarTemplates();
	$posicaoultima= $chamador->mostrarUltimaPosicao($_SESSION['username']);
} catch (\PDOException $e) {
	 echo $e->getMessage();
}
//echo var_dump($templates);
//echo var_dump($figurinhas);
//echo htmlspecialchars($templates[0]['nome']);
// echo htmlspecialchars($figurinhas[1]['imagem']);
// echo htmlspecialchars($figurinhas[2]['imagem']);
// echo htmlspecialchars($figurinhas[3]['imagem']);
// echo rand(5, 15);



if($chamador->diasDesdaDoacao()==-1 or $chamador->diasDesdaDoacao()>60){

	if (isset($_POST['figurasselecionadas'])){
		$template = explode(",", $_POST['figurasselecionadas']);
		for ($i = 0; $i < 5; $i++) {
			if($posicaoultima<16){
				$posicaoultima=16;
			}
			$posicao = $posicaoultima +$i;
			$tabuleiro = 1;
			$fixa = 0;
			$dono = ($_SESSION['username']);
			$otemplate = $template[$i];
			$inserir = new PontosDeVidaFuncoes($pdo);
			$inserir->criarFigurinha($posicao,$tabuleiro,$fixa,$dono,$otemplate);

		}
		$inserir->criarDoacao();
		header("Refresh: 0; url=album.php");
	}
}
else{
	header("Refresh: 0; url=jadoou.php");
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
		<script src="app.js" ></script>
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
												$indice = rand(0,$total);
												?>
													<div class="mdl-cell mdl-cell--1-col album-space card-spot" data-id="<?php echo htmlspecialchars($templates[$indice]['nome']); ?>" onclick="trocaClasse(this);">
															<img style="height: 42px;" class="" src="img/fig/<?php echo htmlspecialchars($templates[$indice]['imagem']); ?>" />
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
 										$indice = rand(0,$total);
 										?>
 										<div class="mdl-cell mdl-cell--1-col album-space card-spot" data-id="<?php echo htmlspecialchars($templates[$indice]['nome']); ?>" onclick="trocaClasse(this);">
 													<img style="height: 42px;" class="" src="img/fig/<?php echo htmlspecialchars($templates[$indice]['imagem']); ?>" />
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
										 $indice = rand(0,$total);
										 ?>
											 <div class="mdl-cell mdl-cell--1-col album-space card-spot" data-id="<?php echo htmlspecialchars($templates[$indice]['nome']); ?>" onclick="trocaClasse(this);">
													 <img style="height: 42px;" class="" src="img/fig/<?php echo htmlspecialchars($templates[$indice]['imagem']); ?>" />
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

										<form  method="post" action="" id="enviarfiguras">
    										<input type="hidden" value="" id="selecionadas"  name="figurasselecionadas">

										</form>

                    <button class="mdl-button" id="coletar_button" name="submitbutton">
                        Coletar
                    </button>
                <div class="mdl-layout-spacer"></div>
            </div>
        </content>

				<script>

				 var nomeTemplates = new Array();
				// função para contabilizar figurinhas selecionadas e criar array com nome do template;
					function trocaClasse(elemento){
						elemento.classList.toggle("selecionado");
						 nomedoElemento = elemento.getAttribute("data-id");
						 if (elemento.classList.contains("selecionado")){
							 nomeTemplates.push(nomedoElemento);
					   } else {
							 var index = nomeTemplates.indexOf(nomedoElemento);    // <-- Not supported in <IE9
							 if (index !== -1) {
							    nomeTemplates.splice(index, 1);
							 }
					   };


						selecionados = numeroSelecionados();
						if (selecionados > 5) {
						document.getElementById("faltanada").innerHTML = ("passou do limite");
						var todos = document.getElementsByClassName('selecionado');
						while (todos[0]) {
							todos[0].classList.remove('selecionado')
						}
						selecionados2 = numeroSelecionados();
						setTimeout(function(){ document.getElementById("faltanada").innerHTML = ("Escolha <span id='faltam'>" + (5 - parseInt(selecionados2)) + "</span> figurinhas:"); }, 1000);
						// zera o array da selecao
						nomeTemplates = [];
			  	 	}
							 	 if (selecionados < 5) {
							 	 document.getElementById("faltanada").innerHTML = ("Escolha <span id='faltam'>" + (5 - parseInt(selecionados)) + "</span> figurinhas:");
									 if (selecionados == 4){
									 document.getElementById("faltanada").innerHTML = ("Só mais <span id='faltam'>1</span> figurinha:");
									 }
							} if (selecionados == 5) {
									document.getElementById("faltanada").innerText = ("boa escolha!");
							}
							coletarFigurinhas(nomeTemplates);
					}

					// funcao para pegar o numero de elementos com classe selecionado
					function numeroSelecionados(){
						return document.getElementsByClassName("selecionado").length;
					}
					// ve se tem a className
					function hasClass(element, cls) {
					    return (' ' + element.className + ' ').indexOf(' ' + cls + ' ') > -1;
					};


					// funcao para coletar os valores e dar um $POST

						function coletarFigurinhas(e){
								document.getElementById("coletar_button").onclick = function() {
								 if (e.length == 5) {
    					 		 document.getElementById("selecionadas").value = e;
							  	 document.getElementById('enviarfiguras').submit();

									 // for (i=0;i<=e.length;i++){
									 //
									 //
									 // }
									//
									//  <?php
									// $i = 0;
									// $total = (count($templates) - 1);
									// while ($i < 3):
									// $indice = rand(0,$total);
									// ?>
									// 	<div class="mdl-cell mdl-cell--1-col album-space card-spot" data-id="<?php echo htmlspecialchars($templates[$indice]['nome']); ?>" onclick="trocaClasse(this);">
									// 			<img style="height: 42px;" class="" src="img/fig/<?php echo htmlspecialchars($templates[$indice]['imagem']); ?>" />
									// 	</div>
									// <?php
									// 		$i++;
									// endwhile;
									//  ?>
									//


								 } else {
				 				 document.getElementById("faltanada").innerHTML = ("coleta incompleta");
								 }
								}
						}

				</script>



    </body>
</html>
