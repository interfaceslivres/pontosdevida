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

.accordion {
  background-color: #F5F4F4;
  color: #545353;
  cursor: pointer;
  height: 40px;
  border-radius: 6px;
  padding-left: 18px;
  padding-right: 18px;
  width: 100%;
  border: none;
  text-align: left;
  outline: none;
  font-size: 16px;
  font-family: 'Jaldi', sans-serif !important;
  transition: 0.4s;
  margin-top: 20px;
}

.active, .accordion:hover {
  background-color: #F5F4F4; 
}

.panel {
  margin-top: -10px;
  padding: 0 18px;
  display: none;
  background-color: white;
  overflow: hidden;
  padding-top: 20px;
  padding-bottom: 10px;
  border-radius: 6px;
  border: 1px solid #F5F4F4;
}

#about-title {
    color: #545353;
    font-weight: bold;
    font-size: 0.9em;
    text-transform: uppercase;
    width: 275px;
    height: 11px !important;
    margin-top: 0px;
    margin-bottom: 0px;
    text-align: center;
    border-bottom: 1px solid #dfdfdf;
}

#about-title-space {
    background-color: white;
}

.about-team {
  font-size: 14px !important;
  font-family: 'Jaldi', sans-serif !important;
  margin-bottom: 0 !important;
  color: #545353;
}

.accordion-team {
  margin-bottom: 100px !important;
}

#about-desc {
  line-height: 1.2;
  font-size: 14px !important;
  font-family: 'Jaldi', sans-serif !important;
  color: #545353;
  text-align: center;
}

#about-logo-box {
  display: flex;
  justify-content: center;
  padding-top: 14px;
  padding-bottom: 8px;
}

#about-logo {
  height: 110px;
}

#about-social-instagram {
  height: 23px;
  margin-top: 6px;
}

#about-social-github {
  height: 35px;
  margin-top: 7px;
  margin-left: -1px;
}

#about-social-tab a {
  margin-top: 5px;
}

#about-social-tab a:first-child {
  margin-right: 12px;
}

#about-social-button {
  height: 35px;
  width: 35px;
  background-color: #c22e30;
  border-radius: 50%;
  box-shadow: 0 2px 2px 0 rgba(0,0,0,.14), 0 3px 1px -2px rgba(0,0,0,.2), 0 1px 5px 0 rgba(0,0,0,.12);
  display: flex;
  justify-content: center;
  vertical-align: middle;
}
</style>

</head>
<body>
  <div class="mdl-tabs mdl-js-tabs">
        <div class="mdl-grid">
        <div class="mdl-layout-spacer"></div>
            <div id="tabsamigos" class="mdl-tabs__tab-bar">
                <a href="#tab1" id="categorias-amigos" class="mdl-tabs__tab is-active tab-title" style="text-decoration: none;"><span class="pontos">.</span><span>Tutorial</span></a>
                <a href="#tab2" id="categorias-amigos" class="mdl-tabs__tab tab-title" style="text-decoration: none;"><span class="pontos">.</span><span>Sobre</span></a>
            </div>
        <div class="mdl-layout-spacer"></div>
        </div>

        
        <div id="tab1" class="mdl-tabs__panel is-active">
            <div class="mdl-grid">
                <div class="mdl-layout-spacer"></div>
                <div id="boxes" class="mdl-cell mdl-cell--3-col">
                  <div id="retorno">
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

                        <div class="mdl-grid" style="padding: 0 !important; margin-top: -7px !important;">
                        <div class="mdl-layout-spacer"></div>
                          <p id="about-title">
                            <span id="about-title-space">
                            </span>
                          </p>
                        <div class="mdl-layout-spacer"></div>
                      </div>

                      <div id="inventariobotoes" style="justify-content: center; margin-top: 0; margin-left: 0; margin-bottom: 0;" class="mdl-cell mdl-cell--4-col">
                          <form action="album.php" method='post'  id='voltar'>
                            <button type="submit"  form="voltar" value="Submit" name="voltarButton" class="mdl-button" id="salvar_retorno_button" style="width: 275px; margin-top: 24.5px;">
                                Continue
                            </button>
                          </form>
                      </div>

                        <div class="mdl-layout-spacer"></div>
              </div>
                </div>
            <div class="mdl-layout-spacer"></div>
            </div>
        </div>

        <div id="tab2" class="mdl-tabs__panel">
        
            <div class="mdl-grid">
                <div class="mdl-layout-spacer"></div>
                <div id="boxes" class="mdl-cell mdl-cell--3-col">
                    <div class="mdl-grid" style="padding: 0 !important; margin-top: 10px;">
                      <div class="mdl-layout-spacer"></div>
                        <p id="about-title">
                          <span id="about-title-space"> 
                            <span id="about-title-txt">⠀Desenvolvido por⠀</span>
                           </span>
                        </p>
                      <div class="mdl-layout-spacer"></div>
                    </div>
                    <div id="about-logo-box">
                      <img src="img/interfaces.png" id="about-logo">
                    </div>

                    <p id="about-desc">O <b>Interfaces Livres</b> é um Projeto de Extensão da Universidade Federal da Paraíba, vinculado ao Departamento de Mídias Digitais. Nele são desenvolvidas pesquisas e produções voltadas às áreas de: Desenvolvimento Web; Comunicação; Produção de Conteúdo; Jogos e Acessibilidade.</p>

                    <div id="about-social-tab" style="display: flex; justify-content: center;">
                      <a class="yLUwa" href="https://instagram.com/interfaceslivres/" rel="me nofollow noopener noreferrer" target="_blank" id="about-social-button"><img src="img/instagram.png" id="about-social-instagram"></a>

                      <a class="yLUwa" href="https://github.com/interfaceslivres" rel="me nofollow noopener noreferrer" target="_blank" id="about-social-button"><img src="img/github.png" id="about-social-github"></a>
                    </div>

                    <div class="mdl-grid" style="padding: 0 !important; margin-top: 28px !important;">
                      <div class="mdl-layout-spacer"></div>
                        <p id="about-title">
                          <span id="about-title-space"> 
                            <span id="about-title-txt">⠀Equipe⠀</span>
                           </span>
                        </p>
                      <div class="mdl-layout-spacer"></div>
                    </div>

                    <button class="accordion">Design de Interface do Usuário</button>
                    <div class="panel">
                      <p class="about-team">Haroldo Carvalho</p>
                      <p class="about-team">Nathália Clementino</p>
                    </div>

                    <button class="accordion">Design de Experiência do Usuário</button>
                    <div class="panel">
                      <p class="about-team">Nathália Clementino</p>
                      <p class="about-team">Paulo Henrique Serrano</p>
                    </div>

                    <button class="accordion">Desenvolvimento Front-End</button>
                    <div class="panel">
                      <p class="about-team">Nathália Clementino</p>
                      <p class="about-team">Rodolfo Marques</p>
                    </div>

                    <button class="accordion">Desenvolvimento Back-End</button>
                    <div class="panel">
                      <p class="about-team">Flávio Eduardo Serrano</p>
                      <p class="about-team">Matheus Danton Queiroga</p>
                      <p class="about-team">Paulo Henrique Serrano</p>
                      <p class="about-team">Rodolfo Marques</p>
                    </div>

                    <button class="accordion">Produção de Conteúdo</button>
                    <div class="panel">
                      <p class="about-team">Fernanda Honorato</p>
                      <p class="about-team">Paulo Henrique Serrano</p>
                    </div>

                    <button class="accordion">Produção de Material Impresso</button>
                    <div class="panel">
                      <p class="about-team">Nathália Clementino</p>
                    </div>

                    <script>
                    var acc = document.getElementsByClassName("accordion");
                    var i;

                    for (i = 0; i < acc.length; i++) {
                      acc[i].addEventListener("click", function() {
                        this.classList.toggle("active");
                        var panel = this.nextElementSibling;
                        if (panel.style.display === "block") {
                          panel.style.display = "none";
                        } else {
                          panel.style.display = "block";
                        }
                      });
                    }
                    </script>

                    <div class="mdl-grid" style="padding: 0 !important; margin-top: 14px !important;">
                      <div class="mdl-layout-spacer"></div>
                        <p id="about-title">
                          <span id="about-title-space">
                          </span>
                        </p>
                      <div class="mdl-layout-spacer"></div>
                    </div>

                    <div id="inventariobotoes" style="justify-content: center; margin-top: 0; margin-left: 0; margin-bottom: 0;" class="mdl-cell mdl-cell--4-col">
                        <form action="album.php" method='post'  id='voltar'>
                          <button type="submit"  form="voltar" value="Submit" name="voltarButton" class="mdl-button" id="salvar_retorno_button" style="width: 275px; margin-top: 24.5px;">
                              Continue
                          </button>
                        </form>
                    </div>
                </div>

                <div class="mdl-layout-spacer"></div>
            </div>
        </div>
    </div>
</body>
</html>
