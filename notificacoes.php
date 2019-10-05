<?php
require 'php/vendor/autoload.php';
use PontosDeVida\Connection as Connection;
use PontosDeVida\PontosDeVidaFuncoes as PontosDeVidaFuncoes;
session_start();

try {
	$pdo = Connection::get()->connect();
  $chamador = new PontosDeVidaFuncoes($pdo);
  $notificacoes = $chamador->verNotifica($_SESSION['username']);
} catch (\PDOException $e) {
	 echo $e->getMessage();
};



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
<body>

    <div class="mdl-grid">
        <div class="mdl-layout-spacer"></div>
        <a id="categoria-notificacoes">
            <span class="pontos">.</span><span>Notificações</span>
        </a>
        <div class="mdl-layout-spacer"></div>
    </div>

    <div id="notificacoes-amigos" class="mdl-grid">
        <div class="mdl-layout-spacer"></div>


        <?php
        foreach ($notificacoes as $i => $j) {
            if(isset($notificacoes[$i]['cla'])){
                if(isset($notificacoes[$i]['remetente'])){
                    //convite ou solicitacao cla
                }
                else{
                    ?><div class="solicitacao_amizade" class="mdl-grid">
                    <div class="chat_imagem"></div>
                    <div class="solicitacao_amizade_desc">
                        <span>O clã <b>Doadores DEMID</b> fez 5.000 doações! Aqui vai uma recompensa pelo esforço:
                        </span>
                        <div class="mdl-grid">
                            <div id="amizade-buttons" class="mdl-cell mdl-cell--1-col">
                                <button class="mdl-button" id="amizade-button" onclick="">
                                    Abrir
                                </button>
    
                                <button class="mdl-button" id="amizade-button">
                                    Guardar
                                </button>
                            </div>
                        </div>
                    </div>
                </div><?php
                }
            }
            else{
                
                if(isset($notificacoes[$i]['remetente'])){
                    $dadosAmigo=$chamador->mostrarUsuario($notificacoes[$i]['remetente']);
                    ?><div class="solicitacao_amizade" class="mdl-grid">
                        <div class="">
                        <span class="imagem_perfil"><img src="<?php echo htmlspecialchars($dadosAmigo['foto']."?".time());?>"></span>
                        </div>
                        <div class="solicitacao_amizade_desc">
                            <span id="solicitacao_amigo_user"><?php echo htmlspecialchars($dadosAmigo['nome']) ?></span>
                            <span id="chat_mensagem">
                                enviou uma solicitação de amizade.
                            </span>

                            <div class="mdl-grid">
                                <div id="amizade-buttons" class="mdl-cell mdl-cell--1-col">
                                    <button class="mdl-button" id="amizade-button" onclick="">
                                        Aceitar
                                    </button>

                                    <button class="mdl-button" id="amizade-button">
                                        Recusar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div><?php
                }
                else{
                    ?><div class="solicitacao_amizade" class="mdl-grid">
                        <div class=""><!-- COMENTEI O CHAT_IMAGEM AQUI  -->
                        <span class="imagem_perfil"><img src="img/icone-72px.png" style=""></span>
                        </div>
                        <div class="solicitacao_amizade_desc">
                            <span id="solicitacao_amigo_user">Pontos de Vida <br></span>
                            <span id="chat_mensagem">
                                <?php echo htmlspecialchars($notificacoes[$i]['texto']) ?>
                            </span>
                        </div>
                    </div><?php
                }
            }
        }
        ?>

        <div class="mdl-layout-spacer"></div>
    </div>
    <div id="bottom-space" class="mdl-grid"></div>
</body>
</html>
