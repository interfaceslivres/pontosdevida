<?php

       require 'php/vendor/autoload.php';
       use PontosDeVida\Connection as Connection;
       use PontosDeVida\PontosDeVidaFuncoes as PontosDeVidaFuncoes;
       session_start();

       try {
           $pdo = Connection::get()->connect();
         $chamador = new PontosDeVidaFuncoes($pdo);
         $dados = $chamador->meusDados();
         $amigos = $chamador->mostrarAmigos();
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
</head>
<body onload="incentivaAmigos()">
    <div class="mdl-tabs mdl-js-tabs">
        <div class="mdl-grid">
        <div class="mdl-layout-spacer"></div>
            <div id="tabsamigos" class="mdl-tabs__tab-bar">
                <a href="#tab1" id="categorias-amigos" class="mdl-tabs__tab is-active tab-title"><span class="pontos">.</span><span>Amigos</span></a>
                <!-- <a href="#tab2" id="categorias-amigos" class="mdl-tabs__tab tab-title"><span class="pontos">.</span><span>Clã</span></a>
                <a href="#tab3" id="categorias-amigos" class="mdl-tabs__tab tab-title"><span class="pontos">.</span><span>Chat</span></a> -->
            </div>
        <div class="mdl-layout-spacer"></div>
        </div>


        <div id="tab1" class="mdl-tabs__panel is-active">
            <div class="mdl-grid">
                <div class="mdl-layout-spacer"></div>
                <div id="boxes" class="mdl-cell mdl-cell--3-col">

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

            <!--<div class="mdl-grid">
                <div class="mdl-layout-spacer"></div>
                    <div id="cta_codigocla" class="mdl-cell mdl-cell--8-col">
                        <p id="codigocla_title">Adicionar Novo Amigo:</p>
                        <?php
                            if(isset($_POST['F_Adiciona'])){
                                echo $chamador->solicitaAmizade($_POST['F_Amigo']);
                            }
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
            </div>-->


            <!--
            <p class="categorias subcategorias-amigos">
                <span class="pontos">.</span><span>Facebook</span>
            </p>

            <div id="amigos-rolagem" class="mdl-grid">
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
            </div>
            -->

            </div>
            <div class="mdl-layout-spacer"></div>
            </div>

            <div id="cta_addamigo" class="mdl-grid">
                <div class="mdl-layout-spacer"></div>
                    <div id="cta_codigocla" class="mdl-cell mdl-cell--2-col">
                        <p id="codigocla_title">Adicionar Amigo:</p>

                        <?php
                            if(isset($_POST['F_Adiciona'])){
                                echo $chamador->solicitaAmizade($_POST['F_Amigo']);
                            }
                        ?>
                        <form  method="post" action="" id="adicionarAmigo">
                        <p id="adicionaAmigo" class="mdl-textfield mdl-js-textfield">
                            <input name="F_Amigo" class="mdl-textfield__input" type="text" id="inpuAmigo" placeholder="NOME DE USUÁRIO">
                        </p>
                        </form>
                    </div>

                    <div id="adicionaBtn_box" class="mdl-cell mdl-cell--1-col">
                        <button type="submit" form="adicionarAmigo" value="Submit" name="F_Adiciona" id="adicionaBtn" class="mdl-button mdl-js-button mdl-button--raised"><img id="copy_icon" src="img/adicionaramigo.png" height="23px"></button>
                    </div>
                <div class="mdl-layout-spacer"></div>
            </div>
        </div>

        <!-- <div id="tab2" class="mdl-tabs__panel">

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
                                    <span id="perfilnome">Doadores DEMID</span>
                                    <span><a href="#"><i class="material-icons">border_color</i></a></span>
                                </p>
                                <p id="perfilbio">Clã dos doadores do Curso de Comunicação em Mídias Digitais da UFPB.</p>
                                <a id="cla-sair" href="#"><p id="cla-sair">sair do clã</p></a>
                            </div>
                        </div>
                    </div>
                </div>

                <p class="categorias subcategorias-amigos" style="margin-top: 44px;">
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
                    </div>

                    <p class="categorias subcategorias-amigos" style="margin-top: 30px;">
                    <span class="pontos">.</span><span>Membros</span> <span class="quantidades">(6)</span>
                    </p>

                    <div id="membros-rolagem" class="mdl-grid">
                    <ul id="amigos-facebook" class="mdl-list">
                        <li class="mdl-list__item mdl-list__item--two-line">
                            <span class="mdl-list__item-primary-content">
                                <span class="contador__lista-icone" data-percent="67">
                                    <span class="imagem_perfil"></span>
                                </span>
                                <span>Roberto</span>
                                <span class="mdl-list__item-sub-title">Tipo B-</span>
                            </span>
                        </li>
                        <li class="mdl-list__item mdl-list__item--two-line">
                            <span class="mdl-list__item-primary-content">
                                <span class="contador__lista-icone" data-percent="80">
                                    <span class="imagem_perfil"></span>
                                </span>
                                <span>João Victor</span>
                                <span class="mdl-list__item-sub-title">Tipo A+</span>
                            </span>
                        </li>
                        <li class="mdl-list__item mdl-list__item--two-line">
                            <span class="mdl-list__item-primary-content">
                                <span class="contador__lista-icone" data-percent="30">
                                    <span class="imagem_perfil"></span>
                                </span>
                                <span>Samiss</span>
                                <span class="mdl-list__item-sub-title">Tipo B+</span>
                            </span>
                        </li>
                        <li class="mdl-list__item mdl-list__item--two-line">
                            <span class="mdl-list__item-primary-content">
                                <span class="contador__lista-icone" data-percent="30">
                                    <span class="imagem_perfil"></span>
                                </span>
                                <span>Nathália</span>
                                <span class="mdl-list__item-sub-title">Tipo B+</span>
                            </span>
                        </li>
                        <li class="mdl-list__item mdl-list__item--two-line">
                            <span class="mdl-list__item-primary-content">
                                <span class="contador__lista-icone" data-percent="30">
                                    <span class="imagem_perfil"></span>
                                </span>
                                <span>Rodolfo</span>
                                <span class="mdl-list__item-sub-title">Tipo B+</span>
                            </span>
                        </li>
                        <li class="mdl-list__item mdl-list__item--two-line">
                            <span class="mdl-list__item-primary-content">
                                <span class="contador__lista-icone" data-percent="30">
                                    <span class="imagem_perfil"></span>
                                </span>
                                <span>Paulo</span>
                                <span class="mdl-list__item-sub-title">Tipo B+</span>
                            </span>
                        </li>
                    </ul>
                </div>

                </div>

                <div class="mdl-layout-spacer"></div>
            </div>

            <div class="mdl-grid">
                <div class="mdl-layout-spacer"></div>
                    <div id="cta_codigocla" class="mdl-cell mdl-cell--2-col">
                        <p id="codigocla_title">Código do Clã:</p>
                        <p id="codigocla">89625jl21526p21</p>
                    </div>

                    <div id="copy_button_box" class="mdl-cell mdl-cell--1-col">
                        <button id="copy_button" class="mdl-button"><img id="copy_icon" src="img/copiar.png" height="23px"></button>
                    </div>
                <div class="mdl-layout-spacer"></div>
            </div>

        </div> -->

        <!-- Início do Chat do Clã -->

        <!-- <div id="tab3" class="mdl-tabs__panel">
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
        </div>  -->
        <!-- acima o fim da tab 3 -->
    </div>

<script>

function incentivaAmigos(){

      if (document.getElementById('amigos-facebook').getElementsByTagName('li').length >= 1) {
        return;
      } else {
        document.getElementById('amigos-facebook').innerHTML =
        "<li><p>Você ainda não adicionou nenhum amigo, comece adicionando a nossa <a href='creditos.php'>equipe de desenvolvimento</a>.</li>"
      }

}


</script>




</body>
</html>
