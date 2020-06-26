<?php

	require 'php/vendor/autoload.php';
	use PontosDeVida\Connection as Connection;
	use PontosDeVida\PontosDeVidaFuncoes as PontosDeVidaFuncoes;
	session_start();

	try {
		$pdo = Connection::get()->connect();
		$chamador = new PontosDeVidaFuncoes($pdo);
		if(isset($_POST['SairCla']) && $_POST['SairCla']=='Submit'){
			$chamador->criarAlocacao($_SESSION['username'], NULL);
		}
		if(isset($_POST['CriarCla']) && $_POST['CriarCla']=='Submit'){
			$chamador->criarCla("Doadores 123", "Descrição 123", "https://i2.wp.com/www.everydaydogmom.com/wp-content/uploads/2015/09/5-essential-oils-for-dogs-featured-1.jpg?resize=400%2C400&ssl=1");
		}
		if(isset($_POST['EntrarCla']) && $_POST['EntrarCla']=='Submit'){
			$idCla = $chamador->mostrarIdClaByCodigo($_POST['codigo_cla']);
			$chamador->criarAlocacao($_SESSION['username'], $idCla);
		}
		$dados         = $chamador->meusDados();
		$amigos        = $chamador->mostrarAmigos();
		$meuCla        = $chamador->meuCla();
		$participantes = $chamador->participantesCla($meuCla["id_cla"]);
	} catch (\PDOException $e) {
		echo $e->getMessage();
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
    <script>
        MaterialTabs.prototype.setTab = function(index) {
            this.resetTabState_();
            this.resetPanelState_();
            if (index > 0) {
                if (index < this.tabs_.length) {
                    this.tabs_[index].classList.add(this.CssClasses_.ACTIVE_CLASS);
                }
                if (index < this.panels_.length) {
                    this.panels_[index].classList.add(this.CssClasses_.ACTIVE_CLASS);
                }
            }
        };
    </script>

</head>
<body onload="incentivaAmigos()">
    <div id="myTabs" class="mdl-tabs mdl-js-tabs">
        <div class="mdl-grid">
        <div class="mdl-layout-spacer"></div>
            <div id="tabsamigos" class="mdl-tabs__tab-bar">
                <a href="#tab1" id="categorias-amigos" class="mdl-tabs__tab is-active tab-title"><span class="pontos">.</span><span>Amigos</span></a>
                <a href="#tab2" id="categorias-amigos" class="mdl-tabs__tab tab-title"><span class="pontos">.</span><span>Clã</span></a>
                <a href="#tab3" id="categorias-amigos" class="mdl-tabs__tab tab-title"><span class="pontos">.</span><span>Chat</span></a>
            </div>
        <div class="mdl-layout-spacer"></div>
        </div>


        <div id="tab1" class="mdl-tabs__panel is-active">

            <div class="mdl-grid">
                <div class="mdl-layout-spacer"></div>
                <div id="boxes" class="mdl-cell mdl-cell--3-col">

                                        <div id="cta_addamigo" class="mdl-grid">
                                            <div class="mdl-layout-spacer"></div>
                                                <div id="cta_codigocla" class="mdl-cell mdl-cell--2-col">
                                                    <p id="codigocla_title">Adicionar Amigo:</p>
                                                    <form  method="post" action="" id="adicionarAmigo">
                                                    <p id="adicionaAmigo" class="mdl-textfield mdl-js-textfield">
                                                        <input name="F_Amigo" class="mdl-textfield__input" type="text" id="inpuAmigo" placeholder="NOME DE USUÁRIO">
                                                    </p>
                                                    </form>
                                                    <p id="mensagem-erro">
                                                      <?php
                                                          if(isset($_POST['F_Adiciona'])){
                                                              echo $chamador->solicitaAmizade($_POST['F_Amigo']);
                                                          }
                                                      ?>
                                                    </p>
                                                </div>

                                                <div id="adicionaBtn_box" class="mdl-cell mdl-cell--1-col">
                                                    <button type="submit" form="adicionarAmigo" value="Submit" name="F_Adiciona" id="adicionaBtn" class="mdl-button mdl-js-button mdl-button--raised"><img id="copy_icon" src="img/adicionaramigo.png" height="23px"></button>
                                                </div>
                                            <div class="mdl-layout-spacer"></div>
                                        </div>

              <div id="amigos-rolagem" class="mdl-grid">
                <ul id="amigos-facebook" class="mdl-list">
                <?php
                    foreach ($amigos as $i=>$v){
                    $amigo=$chamador->mostrarUsuario($v)[0];
                    $sangue="";
                    if($amigo['privacidade']){
                        $sangue=$amigo['tipo_sangue'];
                    }
                    ?>

                        <li class="mdl-list__item mdl-list__item--two-line">
                            <a href="exibicao.php?user=<?php echo htmlspecialchars($v)?>">
                                <span class="mdl-list__item-primary-content">
                                    <span class="contador__lista-icone" data-percent="67">
                                    <span class="imagem_perfil"><img src="<?php echo htmlspecialchars($amigo['foto']."?".time());?>"></span>

                                    </span>
                                    <span><?php echo htmlspecialchars($amigo['nome']);?></span>
                                    <span class="mdl-list__item-sub-title"><?php if($sangue!="")echo "Tipo ";?> <?php echo htmlspecialchars($sangue); ?></span>
                                </span>
                            </a>
                        </li><?php

                    }
                ?>
            </ul>
            </div>

            <!-- <div class="mdl-grid">
                <div class="mdl-layout-spacer"></div>
                    <div id="cta_codigocla" class="mdl-cell mdl-cell--8-col">
                        <p id="codigocla_title">Adicionar Novo Amigo:</p>
                        <?php
                        //    if(isset($_POST['F_Adiciona'])){
                        //        echo $chamador->solicitaAmizade($_POST['F_Amigo']);
                        //    }
                        ?>
                        <form  method="post" action="" id="adicionarAmigo">
                            <div id="adicionaAmigo" class="mdl-textfield mdl-js-textfield">
                                <input name="F_Amigo" class="mdl-textfield__input" type="text" id="inpuAmigo" placeholder="Login Do Amigo">
                            </div>
                        </form>

                        <button type="submit" form="adicionarAmigo" value="Submit" name="F_Adiciona" id="adicionaBtn" class="mdl-button mdl-js-button mdl-button--raised">
                            Enviar Solicitacao
                        </button>
                    </div>
                <div class="mdl-layout-spacer"></div>
            </div> -->


<!--
            <p class="categorias subcategorias-amigos">
                <span class="pontos">.</span><span>Facebook</span>
            </p> -->

            <!-- <div id="amigos-rolagem" class="mdl-grid">
            <ul id="amigos-facebook" class="mdl-list">
                <li class="mdl-list__item mdl-list__item--two-line">
                    <span class="mdl-list__item-primary-content">
                        <span class="contador__lista-icone" data-percent="67">
                            <span class="imagem_perfil"></span>
                        </span>
                        <span>Roberto</span>
                        <span class="mdl-list__item-sub-title">Convidar</span>
                    </span>
                </li>
                <li class="mdl-list__item mdl-list__item--two-line">
                    <span class="mdl-list__item-primary-content">
                        <span class="contador__lista-icone" data-percent="80">
                            <span class="imagem_perfil"></span>
                        </span>
                        <span>João Victor</span>
                        <span class="mdl-list__item-sub-title">Convidar</span>
                    </span>
                </li>
                <li class="mdl-list__item mdl-list__item--two-line">
                    <span class="mdl-list__item-primary-content">
                        <span class="contador__lista-icone" data-percent="30">
                            <span class="imagem_perfil"></span>
                        </span>
                        <span>Samiss</span>
                        <span class="mdl-list__item-sub-title">Convidar</span>
                    </span>
                </li>
                <li class="mdl-list__item mdl-list__item--two-line">
                    <span class="mdl-list__item-primary-content">
                        <span class="contador__lista-icone" data-percent="30">
                            <span class="imagem_perfil"></span>
                        </span>
                        <span>Samiss</span>
                        <span class="mdl-list__item-sub-title">Convidar</span>
                    </span>
                </li>
                <li class="mdl-list__item mdl-list__item--two-line">
                    <span class="mdl-list__item-primary-content">
                        <span class="contador__lista-icone" data-percent="30">
                            <span class="imagem_perfil"></span>
                        </span>
                        <span>Samiss</span>
                        <span class="mdl-list__item-sub-title">Convidar</span>
                    </span>
                </li>
                <li class="mdl-list__item mdl-list__item--two-line">
                    <span class="mdl-list__item-primary-content">
                        <span class="contador__lista-icone" data-percent="30">
                            <span class="imagem_perfil"></span>
                        </span>
                        <span>Samiss</span>
                        <span class="mdl-list__item-sub-title">Convidar</span>
                    </span>
                </li>
                <li class="mdl-list__item mdl-list__item--two-line">
                    <span class="mdl-list__item-primary-content">
                        <span class="contador__lista-icone" data-percent="30">
                            <span class="imagem_perfil"></span>
                        </span>
                        <span>Samiss</span>
                        <span class="mdl-list__item-sub-title">Convidar</span>
                    </span>
                </li>
            </ul>
            </div> -->


            </div>
            <div class="mdl-layout-spacer"></div>
            </div>

        </div>

         <div id="tab2" class="mdl-tabs__panel">

            <?php if($meuCla!=NULL){ ?>
            <div class="mdl-grid">
                <div class="mdl-layout-spacer"></div>
                <div id="boxes" class="mdl-cell mdl-cell--3-col">

                    <div class="mdl-grid">
                        <div id="cla-infos" class="mdl-cell mdl-cell--3-col" style="margin-top: 3px">
                            <div id="img_infos">
                                <a href="#">
                                    <div id="cla-img"></div>
                                    <div id="badgeperfil">
                                        <i class="material-icons">photo_camera</i>
                                    </div>
                                </a>

                                <div id="perfilinfos" style="margin-top: -5px;">
                                    <p class="titulo">
                                        <span id="perfilnome"><?php echo $meuCla["nome"]; ?></span>
                                        <span><a href="#"><i class="material-icons">border_color</i></a></span>
                                    </p>
                                    <p id="perfilbio"><?php echo $meuCla["descricao"]; ?></p>
                                    <form action="amigos.php" method="POST" id="saircla">
                                    <input type="hidden" name="SairCla" value="Submit">
                                    <a id="cla-sair" href="#" onclick="document.getElementById('saircla').submit()">
                                        <p id="cla-sair">sair do clã</p>
                                    </a>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- <p class="categorias subcategorias-amigos" style="margin-top: 44px;">
                        <span class="pontos">.</span><span>Conquistas</span> <span class="quantidades">(6)</span>
                        </p>
                        <div class="mdl-grid">
                            <div id="conquistas-rolagem" class="mdl-grid">
                                    <img class="conquistas-cla" src="img/claouro.png">
                                    <img class="conquistas-cla" src="img/claprata.png">
                                    <img class="conquistas-cla" src="img/clabronze.png">
                                    <img class="conquistas-cla" src="img/claouro.png">
                                    <img class="conquistas-cla" src="img/claprata.png">
                                    <img class="conquistas-cla" src="img/clabronze.png">
                        </div>
                        </div> -->

                    <p class="categorias subcategorias-amigos" style="margin-top: 30px;">
                        <span class="pontos">.</span><span>Membros</span> <span class="quantidades">(<?php echo count($participantes); ?>)</span>
                    </p>

                    <div id="membros-rolagem" class="mdl-grid">
                        <ul id="amigos-facebook" class="mdl-list">

                            <?php 
                            for($i=0; $i<count($participantes); $i++){
                            ?>
                            <li class="mdl-list__item mdl-list__item--two-line">
                                <span class="mdl-list__item-primary-content">
                                    <span class="contador__lista-icone" data-percent="67">
                                        <span class="imagem_perfil"></span>
                                    </span>
                                    <span><?php echo $participantes[$i]["nome"]; ?></span>
                                    <span class="mdl-list__item-sub-title"><?php echo $participantes[$i]["tipo_sangue"]; ?></span>
                                </span>
                            </li>
                            <?php 
                            }
                            ?>

                        </ul>
                    </div>

                </div>
                <div class="mdl-layout-spacer"></div>
            </div>
            <div class="mdl-grid">
                <div class="mdl-layout-spacer"></div>
                    <div id="cta_codigocla" class="mdl-cell mdl-cell--2-col">
                        <p id="codigocla_title">Código do Clã:</p>
                        <p id="codigocla"><?php echo $meuCla["codigo_cla"]; ?></p>
                    </div>

                    <div id="copy_button_box" class="mdl-cell mdl-cell--1-col">
                        <button id="copy_button" class="mdl-button"><img id="copy_icon" src="img/copiar.png" height="23px"></button>
                    </div>
                <div class="mdl-layout-spacer"></div>
            </div>
            
            <?php } else { ?>


            
            <div class="mdl-grid">
                <div class="mdl-layout-spacer"></div>
                <div id="boxes" class="mdl-cell mdl-cell--3-col">
                    <div id="cta_avisonenhum" class="mdl-grid">
                        <p>Você ainda não está em nenhum clã.</p>
                    </div>
                    <div id="cta_aviso2" class="mdl-grid">
                        <p>Entre em um clã usando o código:</p>
                    </div>
                    <form action="amigos.php" method="POST" id="entrarCla">
                    <div id="cta_addamigo" class="mdl-grid">
                        <div class="mdl-layout-spacer"></div>
                        <div id="cta_codigocla" class="mdl-cell mdl-cell--2-col">
                            <p id="codigocla_title" style="margin-top: 5px;">Entrar no clã:</p>
                            <p id="adicionaAmigo" class="mdl-textfield mdl-js-textfield has-placeholder is-upgraded" data-upgraded=",MaterialTextfield">
                                <input name="codigo_cla" style="margin-top: -45px !important;margin-left: 10px;" class="mdl-textfield__input" type="text" id="inpuAmigo" placeholder="CÓDIGO DO CLÃ">
                            </p>
                        </div>

                        <div id="adicionaBtn_box" class="mdl-cell mdl-cell--1-col">
                            <button type="submit" form="entrarCla" value="Submit" name="EntrarCla" id="adicionaBtn" class="mdl-button mdl-js-button mdl-button--raised" data-upgraded=",MaterialButton"><img id="copy_icon" src="img/adicionaramigo.png" height="23px"></button>
                        </div>
                        <div class="mdl-layout-spacer"></div>
                    </div>
                    </form>
                </div>
                <div class="mdl-layout-spacer"></div>
            </div>
            <div class="mdl-grid" style="margin-top:-180px">
                <div class="mdl-layout-spacer"></div>
                <div id="boxes" class="mdl-cell mdl-cell--3-col">
                    <div id="cta_avisonenhum" class="mdl-grid">
                        <p>Ou crie o seu próprio clã:</p>
                    </div>
                </div>
                <div class="mdl-layout-spacer"></div>
            </div>
            <div class="mdl-grid" style="margin-top:-105px;width:275px" id="mdl-grid-codigo-criar-cla">
                <div class="mdl-layout-spacer"></div>

                    <div id="copy_button_box_cla" class="mdl-cell mdl-cell--4-col">
                        <form action="amigos.php" method="POST" id="criarcla">
                            <button type="submit" form="criarcla" value="Submit" name="CriarCla" class="mdl-button" id="itemPositionButton" style="width:100%">
                                Criar Clã
                            </button>
                        </form>
                    </div>

                <div class="mdl-layout-spacer"></div>
            </div>
            <?php } ?>
        </div>

        <!-- Início do Chat do Clã -->

         <div id="tab3" class="mdl-tabs__panel">
            <div class="mdl-grid">
                <div class="mdl-layout-spacer"></div>
                    <div class="mdl-grid">
                        <p id="chat-title"><span id="chat-title-space">⠀<span id="chat-title-txt">Clã Doadores DEMID</span>⠀</span></p>
                    </div>
                <div class="mdl-layout-spacer"></div>
            </div>

            <div class="mdl-grid">
                <div class="mdl-layout-spacer"></div>
                    <div id="chat_box" class="mdl-grid">
                        <div id="chat_msamigos" class="mdl-grid">
                            <div class="chat_imagem"></div>
                            <div class="chat_msbox">
                                <p id="chat_user">Roberto</p>
                                <p id="chat_mensagem">
                                    Boa noite, clã! Viram o multirão de carnaval? Alguém esta pensando em participar? Acho que vou doar lá.
                                </p>
                            </div>
                        </div>

                        <div id="chat_msamigos" class="mdl-grid">
                            <div class="chat_imagem"></div>
                            <div class="chat_msbox">
                                <p id="chat_user">João Victor</p>
                                <p id="chat_mensagem">
                                    Não posso. Ainda faltam 30 dias para o meu contador zerar :/
                                </p>
                            </div>
                        </div>

                        <div id="chat_msamigos" class="mdl-grid">
                            <div class="chat_imagem"></div>
                            <div class="chat_msbox">
                                <p id="chat_user">Samiss</p>
                                <p id="chat_mensagem">
                                    Eu quero. Vamos?
                                </p>
                            </div>
                        </div>

                        <div id="chat_mspropria" class="mdl-grid">
                            <div class="chat_imagem"></div>
                            <div class="chat_msbox">
                                <p id="chat_user">Billy</p>
                                <p id="chat_mensagem">
                                    Faltam 12 dias para mim :(
                                </p>
                            </div>
                        </div>
                    </div>
                <div class="mdl-layout-spacer"></div>
            </div>

            <div class="mdl-grid">
                <div class="mdl-layout-spacer"></div>
                    <span id="chat_line"></span>
                <div class="mdl-layout-spacer"></div>
            </div>

            <div class="mdl-grid">
                <div class="mdl-layout-spacer"></div>
                    <div id="ms_input_box" class="mdl-cell mdl-cell--1-col">
                        <form action="#">
                            <div class="mdl-textfield mdl-js-textfield">
                                <textarea class="mdl-textfield__input" type="text" rows= "2" id="sample5" ></textarea>
                                <label id="ms_input" class="mdl-textfield__label" for="sample5">Mensagem</label>
                            </div>
                        </form>
                    </div>

                    <div id="chat_button_box" class="mdl-cell mdl-cell--1-col">
                        <button id="chat_button" class="mdl-button"><img id="send_icon" src="img/enviar.png" height="23px"></button>
                    </div>
                <div class="mdl-layout-spacer"></div>
            </div>
        </div>
        <!-- acima o fim da tab 3 -->
    </div>

<script>

function incentivaAmigos(){

      if (document.getElementById('amigos-facebook').getElementsByTagName('li').length >= 1) {
        return;
      } else {
        document.getElementById('amigos-facebook').innerHTML =
        "<li><p>Você ainda não adicionou nenhum amigo. <!-- , comece adicionando a nossa <a href='creditos.php'>equipe de desenvolvimento</a>.--></li>"
      }

}


</script>


    <?php
        if((isset($_POST['CriarCla']) && $_POST['CriarCla']=='Submit') ||
           (isset($_POST['EntrarCla']) && $_POST['EntrarCla']=='Submit') ||
           (isset($_POST['SairCla']) && $_POST['SairCla']=='Submit')){
     ?>
    <script>
        document.body.onload = function(){
            var myTabs  = document.getElementById('myTabs');
            var mdlTabs = myTabs.MaterialTabs;
            mdlTabs.setTab(1);
        }
    </script>
    <?php
        }
     ?>



</body>
</html>
