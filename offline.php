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
                        <span class="pontos">.</span><span>Você Está Offline</span>
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
                          <span>Verifique sua conexão com a internet</span>
                        </p>
                        <div class="mdl-layout-spacer"></div>
                  </span>
              </div>

            </div>
              <div class="mdl-layout-spacer"></div>
          </div>
    </content>
</body>
</html>
