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

<style>
.custom-select {
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    height: 38px;
    width: 185px;
    padding: 10px 38px 10px 16px;
    background: #fff url("img/setabaixo.png") no-repeat right 16px center;
    background-size: 10px;
    transition: border-color .1s ease-in-out,box-shadow .1s ease-in-out;
    border: 1px solid #ddd;
    border-radius: 3px;
    font-size: 1em !important;
    color: #4d4d4d !important;
}
.custom-select:hover {
    border: 1px solid #999;
}
.custom-select:focus {
    border: 1px solid #999;
    box-shadow: 0 3px 5px 0 rgba(0,0,0,.2);
    outline: none;
}
/* remove default arrow in IE */
select::-ms-expand {
    display:none;
}

h1 {
	font-family: Merriweather, serif;
}
a {
    color: #333;
    font-weight: 700;
    text-decoration: none;
}
a:hover {
    text-decoration: underline;
}
.custom-select {
    font-family: "Source Sans Pro", sans-serif;
    font-size: 1.6rem;
}

#retorno .alinhaesquerda {
  text-align: left;
}
#retorno .alinhaesquerda {
  text-align: left;
}

</style>

</head>
<body>
  <content>
        <div id="cabecalho_editar_perfil" class="mdl-grid">
            <div class="mdl-layout-spacer"></div>
                <div id="figura_cabecalho" class="mdl-card">
                    <p id="figura_title">
                        <span class="pontos">.</span><span>Tutorial</span>
                    </p>
                </div>
            <div class="mdl-layout-spacer"></div>
        </div>

          <div id="conteudo_retorno" class="mdl-grid">
              <div class="mdl-layout-spacer"></div>
              <div class="mdl-card">

              <div id="retorno">
                  <span>
                        <div class="mdl-layout-spacer"></div>

                        <p class="alinhaesquerda">
                          <span>1. Procure o QR-Code</span>
                        </p>
                        <p class="alinhaesquerda">
                          No prédio do hemocentro tem um banner do Pontos de Vida. Procure o banner, aperte em: <img width="33" height="33" src="img/icone-qr.png"> e aponte para o QR-Code.
                        </p>

                        <p class="alinhaesquerda">
                          <span>2. Colecione Figurinhas</span>
                        </p>
                        <p class="alinhaesquerda">
                          O QR-Code registra a sua doação e te oferece figurinhas informativas para você <b>escolher</b> e colecionar.
                        </p>

                        <p class="alinhaesquerda">
                          <span>3. Complete o álbum</span>
                        </p>
                        <p class="alinhaesquerda">
                          Você começa com 3 figurinhas fixas, seu objetivo é descobrir a lógica do posionamento no álbum para conseguir <b>8 combinações únicas</b> e completá-lo.
                        </p>

                        <p class="alinhaesquerda">
                          <span>4. Divirta-se com amigos</span>
                        </p>
                        <p class="alinhaesquerda">
                          <b>Chame</b> os amigos e forme um grupo de doação, é mais divertido.
                        </p>

                        <p class="alinhaesquerda">
                          <span>5. Instale o Pontos de Vida</span>
                        </p>
                        <p class="alinhaesquerda">
                          Se você estiver gostando muito, procure a opção "Instalar" no seu navegador ou "Adicionar à tela inicial". A gente <b>vira um aplicativo</b> bem levinho.
                        </p>
                        <p><br></p>

                        <div id="inventariobotoes" style="justify-content: center; margin-top: 10px; margin-left: 0;" class="mdl-cell mdl-cell--4-col">
                          <form action="album.php" method='post'  id='voltar'>
                            <button type="submit"  form="voltar" value="Submit" name="voltarButton" class="mdl-button" id="salvar_retorno_button">
                              Continue
                            </button>
                          </form>
                        </div>
                        <p><br></p>
                        <p><br></p>
                        <p><br></p>

                        <div class="mdl-layout-spacer"></div>
                  </span>
              </div>

            </div>
              <div class="mdl-layout-spacer"></div>
          </div>
    </content>




</body>
</html>
