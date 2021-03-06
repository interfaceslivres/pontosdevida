<?php
require 'php/vendor/autoload.php';
use PontosDeVida\Connection as Connection;
use PontosDeVida\PontosDeVidaFuncoes as PontosDeVidaFuncoes;
session_start();
// teste de atualizacao n+1

try {
	$pdo = Connection::get()->connect();
  $chamador = new PontosDeVidaFuncoes($pdo);
  $dados = $chamador->meusDados();
} catch (\PDOException $e) {
	 echo $e->getMessage();
};

try {
	$pdo = Connection::get()->connect();
  $chamador = new PontosDeVidaFuncoes($pdo);
  $dadosfigurinha = $chamador->mostrarFigurinha($_SESSION['username']);
} catch (\PDOException $e) {
	 echo $e->getMessage();
};

// pegar posição da url e alterar posicao da figurinha no album
	$url = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
	if (strpos($url,'noalbum') !== false) {
			$posicoes = $_GET['noalbum'];
			$arrayPosicoes = explode(',', $posicoes);
		  $numeroid = array();
		  $numeroposicao = array();
			for ($i = 0; $i < sizeof($arrayPosicoes); $i++) {
			    if ($i % 2 == 0) {
							array_push($numeroid, $arrayPosicoes[$i]);
			    }
			    else {
							array_push($numeroposicao, $arrayPosicoes[$i]);
			    }
			}
			try {
				$pdo = Connection::get()->connect();
				$InserirDados = new PontosDeVidaFuncoes($pdo);
				$tabuleiroaqui = 1;
				//echo sizeof($numeroid);
					for ($j = 0; $j < (sizeof($numeroid)); $j++) {
						$InserirDados->alterarFigurinha($numeroid[$j], $numeroposicao[$j], $tabuleiroaqui);
					}
			} catch (\PDOException $e) {
				echo $e->getMessage();
			}
			// ALERTA DE GAMBIARRA FEIA ABAIXO:
			header("Refresh: 0; url=album.php");
		}
// fim de pegar a url e alterar posicao da figurinha no album
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
					.invisivel {display: none;}
					.visivel {display: block;}
					.centraliza-album {
						display: -webkit-flex;
				    display: -ms-flexbox;
				    display: flex;
				    -webkit-flex-direction: column;
				    -ms-flex-direction: column;
				    flex-direction: column;
					}

          .naomova-especial {
            position: relative;
          }
          .naomova-especial::after {
                content: "🔒";
                position: absolute;
                bottom: 3px;
                right: 1px;
                background: #fff;
                border-radius: 50%;
                font-size: 11px;
                width: 17px;
                color: #919191;
                height: 17px;
                padding-left: 0.5px;
          }

					.disabled {
						cursor: not-allowed;
				    pointer-events: none;
					}


				</style>


    </head>
    <body>

			<!-- teste do album agora vai cade? bo9ra ?!!?!??!?!?!
     <tr>
			<td><?php echo htmlspecialchars($dadosfigurinha[0]['posicao']) ?></td>
			<td><?php echo htmlspecialchars($dadosfigurinha[0]['tabuleiro']) ?></td>
			<td><?php echo htmlspecialchars($dadosfigurinha[0]['fixa']) ?></td>
			<td><?php echo htmlspecialchars($dadosfigurinha[0]['dono']) ?></td>
			<td><?php echo htmlspecialchars($dadosfigurinha[0]['template']) ?></td>
			<td><?php echo htmlspecialchars($dadosfigurinha[0]['imagem']) ?></td>
			<td><?php echo htmlspecialchars($dadosfigurinha[0]['id']) ?></td>
			<td><?php echo htmlspecialchars($dadosfigurinha[0]['tipo']) ?></td>
         <td><?php echo htmlspecialchars($dados['email']) ?></td>
          <td></td>
          <td><?php echo htmlspecialchars($dados['data_nascimento']); ?></td>
          <td></td>
          <td><?php echo htmlspecialchars($dados['nivel']); ?></td>
          <td><?php echo htmlspecialchars($dados['oauth']); ?></td>
          <td><?php echo htmlspecialchars($dados['smtoggle']) ?></td>
          <td><?php echo htmlspecialchars($dados['privacidade']); ?></td>
          <td><?php echo htmlspecialchars($dados['foto']); ?></td>
      </tr> -->
      <content>
          <div class="mdl-tabs__panel">
              <!-- <div class="mdl-grid">
                  <div class="mdl-layout-spacer"></div>
                  <a id="categoria-perfil">
                      <span class="pontos">.</span><span>Perfil</span>
                  </a>
                  <div class="mdl-layout-spacer"></div>
              </div> -->
          <div id="perfil-div" class="mdl-grid">
              <div class="mdl-layout-spacer"></div>
              <div id="album-box" class="mdl-cell mdl-cell--3-col">

                  <div class="mdl-grid">
                      <div id="cla-infos" class="mdl-cell mdl-cell--3-col">

                          <div id="img_infos">
                              <a href="editarperfil.php">
                                  <div id="imgperfil"><img src="<?php echo htmlspecialchars($dados['foto']); ?>"></div>
                                  <div id="badgeperfil">
                                    <p>📷</p>
                                  </div>
                              </a>

                              <div id="perfilinfos">
                                  <p class="titulo">
                                      <span id="perfilnome"><?php echo htmlspecialchars($dados['nome']) ?></span>
                                      <!-- <span id="perfilidade">12</span> -->
                                      <span><a href="editarperfil.php"><i class="material-icons">border_color</i></a></span>
                                  </p>
                                  <p id="perfilbio"><?php echo htmlspecialchars($dados['biografia']); ?></p>
                                  <p id="perfiltiposanguineo"><?php echo htmlspecialchars($dados['tipo_sangue']) ?></p>
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
                      <a href="#albuns" class="mdl-tabs__tab is-active tab-title">
                        <p id="categoria-album">
                          <span class="pontos">.</span><span>Álbum</span>
                        </p>
                      </a>
                      <!--<a href="#inventorio" class="mdl-tabs__tab tab-title">
                        <p id="categoria-album">
                          <span class="pontos">.</span><span>Arquivo</span> <span class="quantidades">(2)</span>
                        </p>
                      </a>-->
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
                      <div class="centraliza-album mdl-cell mdl-cell--4-col"> <!-- inicio da estrutura do álbum-->
                          <div class="mdl-grid"> <!--Primeira linha do álbum> -->
                              <div class="mdl-cell mdl-cell--1-col album-space card-spot"></div>
                              <div class="mdl-cell mdl-cell--1-col album-space card-spot"></div>
                              <div class="mdl-cell mdl-cell--1-col album-space card-spot"></div>
                              <div class="mdl-cell mdl-cell--1-col album-space card-spot"></div>
                          </div>
                          <div class="mdl-grid"> <!--Segunda linha do álbum> -->
                              <div class="mdl-cell mdl-cell--1-col album-space card-spot"></div>
                              <div class="mdl-cell mdl-cell--1-col album-space card-spot"></div>
                              <div class="mdl-cell mdl-cell--1-col album-space card-spot"></div>
                              <div class="mdl-cell mdl-cell--1-col album-space card-spot"></div>
                          </div>
                          <div class="mdl-grid"> <!--Terceira linha do álbum> -->
                              <div class="mdl-cell mdl-cell--1-col album-space card-spot"></div>
                              <div class="mdl-cell mdl-cell--1-col album-space card-spot"></div>
                              <div class="mdl-cell mdl-cell--1-col album-space card-spot"></div>
                              <div class="mdl-cell mdl-cell--1-col album-space card-spot"></div>
                          </div>
                          <div class="mdl-grid"> <!--Quarta linha do álbum> -->
                              <div class="mdl-cell mdl-cell--1-col album-space card-spot"></div>
                              <div class="mdl-cell mdl-cell--1-col album-space card-spot"></div>
                              <div class="mdl-cell mdl-cell--1-col album-space card-spot"></div>
                              <div class="mdl-cell mdl-cell--1-col album-space card-spot"></div>
                          </div>
                          <div class="mdl-grid">
                              <div class="mdl-cell mdl-cell--1-col infosalbum">
                                  <p id="contador-cartas" class="albuminfos">04/16 figurinhas</p>
                                  <p id="contador-comb" class="albuminfos">1 combinação</p>
                              </div>
                          </div>
                      </div>
                      <div class="mdl-layout-spacer"></div>
                  </div>
                  <div class="mdl-grid" >
                      <div class="mdl-layout-spacer"></div>
                          <p id="inventario-title">⇵⠀Arraste um item para cima • Não esqueça de salvar ⇵</p>
                      <div class="mdl-layout-spacer"></div>
                      </div>

                  <div class="mdl-grid" style="height: 153px;">
                    <div class="mdl-layout-spacer"></div>
                      <div class="centraliza-album mdl-cell mdl-cell--4-col"> <!-- inicio da estrutura do Inventário-->
                          <div id="inventario-rolagem" class="mdl-grid"> <!--Primeira linha do Inventário> -->
	                              <div id="album-figura" class="visivel mdl-cell mdl-cell--1-col album-space card-spot"></div>
	                              <div id="album-figura" class="invisivel mdl-cell mdl-cell--1-col album-space card-spot"></div>
	                              <div id="album-figura" class="invisivel mdl-cell mdl-cell--1-col album-space card-spot"></div>
	                              <div id="album-figura" class="invisivel mdl-cell mdl-cell--1-col album-space card-spot"></div>
	                              <div id="album-figura" class="invisivel mdl-cell mdl-cell--1-col album-space card-spot"></div>
	                              <div id="album-figura" class="invisivel mdl-cell mdl-cell--1-col album-space card-spot"></div>
	                              <div id="album-figura" class="invisivel mdl-cell mdl-cell--1-col album-space card-spot"></div>
	                              <div id="album-figura" class="invisivel mdl-cell mdl-cell--1-col album-space card-spot"></div>
				                              <div id="album-figura" class="invisivel mdl-cell mdl-cell--1-col album-space card-spot"></div>
				                              <div id="album-figura" class="invisivel mdl-cell mdl-cell--1-col album-space card-spot"></div>
				                              <div id="album-figura" class="invisivel mdl-cell mdl-cell--1-col album-space card-spot"></div>
				                              <div id="album-figura" class="invisivel mdl-cell mdl-cell--1-col album-space card-spot"></div>
				                              <div id="album-figura" class="invisivel mdl-cell mdl-cell--1-col album-space card-spot"></div>
				                              <div id="album-figura" class="invisivel mdl-cell mdl-cell--1-col album-space card-spot"></div>
				                              <div id="album-figura" class="invisivel mdl-cell mdl-cell--1-col album-space card-spot"></div>
				                              <div id="album-figura" class="invisivel mdl-cell mdl-cell--1-col album-space card-spot"></div>
							                              <div id="album-figura" class="invisivel mdl-cell mdl-cell--1-col album-space card-spot"></div>
							                              <div id="album-figura" class="invisivel mdl-cell mdl-cell--1-col album-space card-spot"></div>
							                              <div id="album-figura" class="invisivel mdl-cell mdl-cell--1-col album-space card-spot"></div>
							                              <div id="album-figura" class="invisivel mdl-cell mdl-cell--1-col album-space card-spot"></div>
							                              <div id="album-figura" class="invisivel mdl-cell mdl-cell--1-col album-space card-spot"></div>
							                              <div id="album-figura" class="invisivel mdl-cell mdl-cell--1-col album-space card-spot"></div>
							                              <div id="album-figura" class="invisivel mdl-cell mdl-cell--1-col album-space card-spot"></div>
							                              <div id="album-figura" class="invisivel mdl-cell mdl-cell--1-col album-space card-spot"></div>
                              <!-- <div style="min-width: 0.2px;"></div> -->
                          </div>

                          <div class="mdl-grid">
                              <div class="mdl-layout-spacer"></div>
                              <div id="inventariobotoes" class="mdl-cell mdl-cell--4-col">
                                  <div class="mdl-layout-spacer"></div>
                                  <button class="mdl-button" id="itemPositionButton" onclick="dragmeToogle()">
                                      Salvar
                                  </button>
                                  <div class="mdl-layout-spacer"></div>
                              </div>
                          </div>
                      </div>
                      <div class="mdl-layout-spacer"></div>
                  </div>
 							<!-- Segunda aba
              <div id="inventorio" class="mdl-tabs__panel">
                  <div class="mdl-grid">
                  <div class="mdl-layout-spacer"></div>
                      <p id="album-title"><span id="album-title-space">⠀<span id="album-title-txt">Álbum II: Memes Brasileiros</span>⠀</span></p>
                  <div class="mdl-layout-spacer"></div>
                  </div>

                  <div id="figuras-grade" class="mdl-grid">
                      <div class="mdl-layout-spacer"></div>



                      <div class="mdl-layout-spacer"></div>
                  </div>

                  <div class="mdl-grid">
                  <div class="mdl-layout-spacer"></div>
                      <p id="album-title"><span id="album-title-space">⠀<span id="album-title-txt">Álbum I: Literatura Brasileira</span>⠀</span></p>
                  <div class="mdl-layout-spacer"></div>
                  </div>

                  <div id="figuras-grade" class="mdl-grid">
                      <div class="mdl-layout-spacer"></div>
                      <div class="mdl-card mdl-cell mdl-cell--4-col"> <!-- inicio da estrutura do 2o álbum completo
                          <div class="mdl-grid"> <!--Primeira linha do álbum>
                              <a href="#"><div class="mdl-cell mdl-cell--1-col album-space"><img style="height: 42px;" src="img/gota.png"></div></a>
                              <a href="#"><div class="mdl-cell mdl-cell--1-col album-space"><img style="height: 42px;" src="img/gota.png"></div></a>
                              <a href="#"><div class="mdl-cell mdl-cell--1-col album-space"><img style="height: 42px;" src="img/gota.png"></div></a>
                              <a href="#"><div class="mdl-cell mdl-cell--1-col album-space"><img style="height: 42px;" src="img/gota.png"></div></a>
                          </div>
                          <div class="mdl-grid"> <!--Segunda linha do álbum>
                              <a href="#"><div class="mdl-cell mdl-cell--1-col album-space"><img style="height: 42px;" src="img/gota.png"></div></a>
                              <a href="#"><div class="mdl-cell mdl-cell--1-col album-space"><img style="height: 42px;" src="img/gota.png"></div></a>
                              <a href="#"><div class="mdl-cell mdl-cell--1-col album-space"><img style="height: 42px;" src="img/gota.png"></div></a>
                              <a href="#"><div class="mdl-cell mdl-cell--1-col album-space"><img style="height: 42px;" src="img/gota.png"></div></a>
                          </div>
                          <div class="mdl-grid"> <!--Terceira linha do álbum>
                              <a href="#"><div class="mdl-cell mdl-cell--1-col album-space"><img style="height: 42px;" src="img/gota.png"></div></a>
                              <a href="#"><div class="mdl-cell mdl-cell--1-col album-space"><img style="height: 42px;" src="img/gota.png"></div></a>
                              <a href="#"><div class="mdl-cell mdl-cell--1-col album-space"><img style="height: 42px;" src="img/gota.png"></div></a>
                              <a href="#"><div class="mdl-cell mdl-cell--1-col album-space"><img style="height: 42px;" src="img/gota.png"></div></a>
                          </div>
                          <div class="mdl-grid"> <!--Quarta linha do álbum>
                              <a href="#"><div class="mdl-cell mdl-cell--1-col album-space"><img style="height: 42px;" src="img/gota.png"></div></a>
                              <a href="#"><div class="mdl-cell mdl-cell--1-col album-space"><img style="height: 42px;" src="img/gota.png"></div></a>
                              <a href="#"><div class="mdl-cell mdl-cell--1-col album-space"><img style="height: 42px;" src="img/gota.png"></div></a>
                              <a href="#"><div class="mdl-cell mdl-cell--1-col album-space"><img style="height: 42px;" src="img/gota.png"></div></a>
                          </div>
                          <div class="mdl-grid">
                              <div class="mdl-cell mdl-cell--1-col infosalbum">
                                  <p class="albuminfos">16/16 figurinhas</p>
                                  <p class="albuminfos">10 combinações</p>
                              </div>
                          </div>
                      </div>
                      <div class="mdl-layout-spacer"></div>
                  </div>

              </div>  fim da segunda aba -->
          </div>
          <div id="bottom-space" class="mdl-grid"></div>
      </content>

        <!-- Caixa de díalogo que avisa sobre novo nível -->

        <dialog class="mdl-dialog" id="newLevelDialog">
            <button id="dialog-close" class="mdl-button mdl-js-button mdl-button--fab mdl-button--mini-fab close"> x </button>
            <h4 id="dialog-title" class="mdl-dialog__title">Nível 8<br>Concluído</h4>
            <img src="img/levelUp_icon.png" width="200px" id="levelUpIcon">
            <p id="levelup-subtitle">Você salvou 12 vidas!</p>
            <button id="dialog-button" class="mdl-button">Continuar</button>
        </dialog>

        <!-- Caixa de diálogo que avisa sobre nova recompensa -->

        <dialog class="mdl-dialog" id="newItemDialog">
            <button id="dialog-close" class="mdl-button mdl-js-button mdl-button--fab mdl-button--mini-fab close"> x </button>
            <h4 id="dialog-title" class="mdl-dialog__title">Você ganhou<br>uma recompensa!</h4>
            <canvas id="levelUpCanvas">Seu browser não tem suporte para canvas</canvas>
            <button id="dialog-button" class="mdl-button">Abrir</button>
        </dialog>

        <script src="js/dialog-polyfill.js"></script>
        <script src="js/open_chest.js"></script>
        <script src="app.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@shopify/draggable@1.0.0-beta.8/lib/draggable.bundle.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@shopify/draggable@1.0.0-beta.8/lib/swappable.js"></script>

        <script>


						//function changeTabTitle(title) {
           //     document.getElementById("tab-title").innerText = title;
           // }

					 //Swappable das cartas
           var container = document.querySelectorAll('.card-spot');
            const draggable = new Swappable.default(container, {
                draggable: '.drag-me',
                dropzone: '.card-spot',

            });
            draggable.on('swappable:swapped', () => {
                verificaImg();
            })
            draggable.on('swappable:stop', () => {
                verificaImg();
            })


	            //Sript que armazena o posicionamento das cartas no Local Storage
	            var spots = document.getElementsByClassName('card-spot');

							getPositionByDB();
							exibeEspacoInventario();



							function getPositionByDB(){
									localStorage.clear();
							<?php
											$tamanho = count($dadosfigurinha);
											for ($i = 0; $i < $tamanho; $i++) {
													if(!$dadosfigurinha[$i]['fixa']){
														if ($dadosfigurinha[$i]['posicao'] > 15){ ?>
														 localStorage.setItem('item<?php echo $dadosfigurinha[$i]['posicao'] ?>', `<?php echo "<a href='descricao.php?template=".$dadosfigurinha[$i]['imagem']."&exibicao=1' data-id='".$dadosfigurinha[$i]['id']."' data-cardtype='".$dadosfigurinha[$i]['tipo']."'><img  style='height: 42px' src='img/fig/min/".$dadosfigurinha[$i]['imagem']."'/></a>";?>`);
														 <?php } else {?>

														localStorage.setItem('item<?php echo $dadosfigurinha[$i]['posicao'] ?>', `<?php echo "<a href='descricao.php?template=".$dadosfigurinha[$i]['imagem']."&exibicao=1' data-id='".$dadosfigurinha[$i]['id']."' data-cardtype='".$dadosfigurinha[$i]['tipo']."'><img  style='height: 42px' src='img/fig/min/".$dadosfigurinha[$i]['imagem']."'/></a>";?>`);

													<?php }} else {
													?>
													localStorage.setItem('item<?php echo $dadosfigurinha[$i]['posicao'] ?>', `<?php echo "<a href='descricao.php?template=".$dadosfigurinha[$i]['imagem']."&exibicao=1' class='dont-move' data-id='".$dadosfigurinha[$i]['id']."' data-cardtype='".$dadosfigurinha[$i]['tipo']."'><img  style='height: 42px' src='img/fig/min/".$dadosfigurinha[$i]['imagem']."'/></a>";?>`);
													<?php };
									    };?>

									if (window.location.href.indexOf("noalbum") > -1) {

										document.getElementById("albuns").innerHTML = '<div class="mdl-grid"><div class="mdl-layout-spacer"></div><p id="album-title"><span id="album-title-space">⠀<img src="img/spinner.gif">⠀</span></p><div class="mdl-layout-spacer"></div>';
									} else {
										setPosition();
				            verificaImg();
									};
							};



            function getPosition(){
                var fignoalbum =[];
                var inv=0;
                var count=16;
                var pos=0;
                for(i=0; i< spots.length; i++){
                    if(spots[i].children[0].hasChildNodes()){
                        var espaco = spots[i].innerHTML;
                        localStorage.setItem(`item${i}`, espaco);
                        let id_figura = (spots[i].children[0].getAttribute('data-id')) * 1;
                        if(i>=16){
                            inv=1;
                        }
                        if(inv){
                            pos=count;
                            count=count+1;
                        }
                        else{
                            pos=i
                        }
                        if(id_figura != 0){

                            fignoalbum.push([id_figura,pos]);
                        }


                    }
                }
                var out = '';
                for (var i in fignoalbum) {
                    out += i + ": " + fignoalbum[i] + "\n";
                }
                window.location.href = "album.php?noalbum=" + fignoalbum;
            }


            //Script que obtém as posições das cartas através do local Storage e as coloca no tabuleiro
            function setPosition() {
							var countbreak=0;
                if(window.localStorage.length > 0){
                    for(i=0; i<spots.length; i++){
                        spots[i].innerHTML = localStorage.getItem(`item${i}`);

                    }
                }
            }

            // Script que ativa o reposicionamento das cartas //
            var dragmeIsActive = false;
            var emptySpace = `<img style="height: 42px;" class="drag-me" src="img/vazio.png">`;

            function dragmeToogle(){
                if(dragmeIsActive == false) {
                    for(i = 0; i< spots.length; i++){
                        if(spots[i].hasChildNodes()){
                            let spotChild = spots[i].children;
                                if(!spotChild[0].classList.contains("dont-move")){
                                    spotChild[0].classList.add('drag-me');
                                }
                        } else {
                            spots[i].innerHTML = emptySpace;
                        }
                    }
                   dragmeIsActive = !dragmeIsActive;
                   document.getElementById("itemPositionButton").innerText = 'Salvar';

                } else if (dragmeIsActive == true){
                    for(i = 0; i< spots.length; i++){
                        if(spots[i].hasChildNodes()){
                            let spotChild = spots[i].children;
                            if(spots[i].innerHTML == emptySpace){
                                spots[i].innerHTML = '';
                            } else {
                                spotChild[0].classList.remove('drag-me');
                            }
                        }
                    }
                    dragmeIsActive = !dragmeIsActive;
                    getPosition();

                }

            }

            // Script que permite o reposicionamento das cartas //
            var dropSpot = document.getElementsByClassName('card-spot');
            var oldFather;

						// deletar talvez
            // for(i=0; i < dropSpot.length; i++){
            //     dropSpot[i].setAttribute('ondrop', 'drop(event)');
            //     dropSpot[i].setAttribute('ondragover', 'allowdrop(event)');
            // }

            function allowdrop(event){
                event.preventDefault();

            }

            function drag(event){
                oldFather = event.target.parentNode;
                event.dataTransfer.setData('text', event.target.id);
            }

            function drop(event){
                event.preventDefault();
                var data = event.dataTransfer.getData('text');
                if(event.target.hasChildNodes()){
                    var child = event.target.childNodes;
                    oldFather.appendChild(child[0]);
                    event.target.appendChild(document.getElementById(data));
                } else if(event.target.className == 'drag-me'){
                    let targetParent = event.target.parentNode;
                    targetParent.appendChild(document.getElementById(data));
                    oldFather.appendChild(event.target);
                } else {
                    event.target.appendChild(document.getElementById(data));

                }

                verificaImg();

            }
            // script que conta a quantidade de cartas posicionadas no album
						document.addEventListener("drag:stop", contaCartas);
            function contaCartas(){
									var qntCartas = 0;
									for (i = 0; i < 16; i++){
											if(spots[i].children[0].hasChildNodes()){
													if(spots[i].innerHTML == emptySpace){
															qntCartas = qntCartas -1 ;
													} else {
															qntCartas++;
													}
											}
									}
									document.getElementById('contador-cartas').innerText = `${qntCartas}/16 figurinhas`;
            };

            // Script que verifica as combinações

            // 1 - soma as linhas do jogo
            var data_types = [];
            var numComb = 0;
            function verificaImg(){
                data_types = [];
                for(i = 0; i< spots.length; i++){
                    if(spots[i].hasChildNodes()){
                        let spotChild = spots[i].children;
                        let value = parseInt(spotChild[0].getAttribute('data-cardtype'));
                        data_types.push(value);
                    } else {
                        let value = 0;
                        data_types.push(value);
                    }
                }
                somaLinhas();
            }

            function somaLinhas(){
                let somaCol1 = [data_types[0], data_types[4], data_types[8], data_types[12]].reduce(function(anterior, atual) {
                    return anterior + atual;
                });
                let somaCol2 = [data_types[1], data_types[5], data_types[9], data_types[13]].reduce(function(anterior, atual) {
                    return anterior + atual;
                });
                let somaCol3 = [data_types[2], data_types[6], data_types[10], data_types[14]].reduce(function(anterior, atual) {
                    return anterior + atual;
                });
                let somaCol4 = [data_types[3], data_types[7], data_types[11], data_types[15]].reduce(function(anterior, atual) {
                    return anterior + atual;
                });
                let somaLin1 = data_types.slice(0,4).reduce(function(anterior, atual) {
                    return anterior + atual;
                });
                let somaLin2 = data_types.slice(4,8).reduce(function(anterior, atual) {
                    return anterior + atual;
                });
                let somaLin3 = data_types.slice(8,12).reduce(function(anterior, atual) {
                    return anterior + atual;
                });
                let somaLin4 = data_types.slice(12, 16).reduce(function(anterior, atual) {
                    return anterior + atual;
                });

                // 2 - Confirma as combinações
                numComb = 0;

                if(somaCol1 === 33){
                    numComb++;
                }
                if(somaCol2 === 33){
                    numComb++;
                }
                if(somaCol3 === 33){
                    numComb++;
                }
                if(somaCol4 === 33){
                    numComb++;
                }
                if(somaLin1 === 33){
                    numComb++
                }
                if(somaLin2 === 33){
                    numComb++
                }
                if(somaLin3 === 33){
                    numComb++
                }
                if(somaLin4 === 33){
                    numComb++
                }

                document.getElementById('contador-comb').innerText = `${numComb}/8 combinações`;
            }



            document.addEventListener("drag:stop", exibeEspacoInventario);

						function exibeEspacoInventario(){
							if (window.location.href.indexOf("noalbum") > -1) {
								return
								} else {
								var figurinhas = document.getElementById("inventario-rolagem").querySelectorAll('[data-id]') ;
								figurinhas = figurinhas.length;
								for (i = 0; i < figurinhas; i++){
								 elemento = document.getElementById('inventario-rolagem').children[i].children[0];
								 if (elemento != undefined){
	 							 	 var divpai2 = document.getElementById('inventario-rolagem').children[(i+1)];
									 divpai2.classList.remove("invisivel");
									 divpai2.classList.add("visivel");
								 }
								}
								}
							};


                            function starbtn(){
                                for(i = 0; i< spots.length; i++){
                                if(spots[i].hasChildNodes()){
                                    let spotChild = spots[i].children;
                                        if(!spotChild[0].classList.contains("dont-move")){
                                            spotChild[0].classList.add('drag-me');
                                        }
                                } else {
                                    spots[i].innerHTML = emptySpace;
                                }
                                    }
                                dragmeIsActive = !dragmeIsActive;

                            }

        starbtn();

									 var naomova = document.getElementsByClassName('dont-move');
									 for (i=0; i< naomova.length; i++){
										 naomova[i].parentNode.classList.add("naomova-especial");
									 }

contaCartas();
        </script>

    </body>
</html>
