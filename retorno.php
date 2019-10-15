<?php
require 'php/vendor/autoload.php';
use PontosDeVida\Connection as Connection;
use PontosDeVida\PontosDeVidaFuncoes as PontosDeVidaFuncoes;
session_start();
if((!isset ($_SESSION['username']) == true) and (!isset ($_SESSION['valid']) == true))
{
  unset($_SESSION['username']);
  unset($_SESSION['valid']);
  // header('location:www.pontosdevida.org/');
	?>
	<script>
		window.location.href='index.php?doando=TRUE';
	</script>
	<?php
}
try {
	$pdo = Connection::get()->connect();
  $chamador = new PontosDeVidaFuncoes($pdo);
  $dados = $chamador->meusDados();
} catch (\PDOException $e) {
	 echo $e->getMessage();
}
if(!($chamador->diasDesdaDoacao()==-1) and !($chamador->diasDesdaDoacao()>60)){
    header("Refresh: 0; url=jadoou.php");
}
if( isset($_POST['salvarretorno']) )
{
	$inserir = new PontosDeVidaFuncoes($pdo);
	$inserir->alterarTempo($_POST['tempo_retorno']);

// CRIAR DOACAO - VINDA DE retorno.php erro em algum lugar
	// $local = "Hemocentro-JP";
	// $inserirDoacao = new PontosDeVidaFuncoes($pdo);
	// $inserirDoacao->criarDoacao($local);
	header("Refresh: 0; url=escolha.php");
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

</style>

</head>
<body>
     <!-- <tr>

          <td><?php echo htmlspecialchars($dados['tempo_retorno']); ?></td>
      </tr> -->
    <content>
        <div id="cabecalho_editar_perfil" class="mdl-grid">
            <div class="mdl-layout-spacer"></div>
                <div id="figura_cabecalho" class="mdl-card">
                    <p id="figura_title">
                        <span class="pontos">.</span><span>Doação Registrada</span>
                    </p>
                </div>
            <div class="mdl-layout-spacer"></div>
        </div>

          <div id="conteudo_retorno" class="mdl-grid">
              <div class="mdl-layout-spacer"></div>
              <div class="mdl-card">

              <form method="post" action="" id="retorno" enctype="multipart/form-data"> <!-- no destino está a funcao que pega o submit vindo daqui -->
                  <span>
                        <div class="mdl-layout-spacer"></div>
                        <p>
                        <span>PARABÉNS!</span>
                        <br>
                        Você passou pela sala de doação!
                        <br>
                        Esperamos que a sua experiência <br> tenha sido ótima. <br><br>
                        Marque abaixo em quanto tempo <br> você tem intenção de retornar:
                        </p>
                        <select name="tempo_retorno" class="custom-select">
                        <?php
                            if($dados['sexo']=='M'){
                            echo '<option value="60">até 2 Meses</option>'; }
                            ?>
                              <option value="90" >3 meses</option>
                              <option value="180">6 meses</option>
                              <option value="360">1 ano</option>
                              <option value="NULL">Nunca</option>
                        </select>
                        <!-- <input type="text" name="F_tempo_retorno"> -->
                        <div id="inventariobotoes" style="justify-content: center; margin-top: 10px; margin-left: 0;" class="mdl-cell mdl-cell--4-col">
                    <button type="submit" form="retorno" value="Submit" name="salvarretorno" class="mdl-button" id="salvar_retorno_button">
                        Confirmar
                    </button>
                </div>

                        <div class="mdl-layout-spacer"></div>
                  </span>


              </form>

            </div>
              <div class="mdl-layout-spacer"></div>
          </div>

          <!--<div class="mdl-grid">
                <div class="mdl-layout-spacer"></div>
                <div id="inventariobotoes" style="justify-content: center;" class="mdl-cell mdl-cell--4-col">
                    <button type="submit" form="retorno" value="Submit" name="salvarretorno" class="mdl-button" id="salvar_retorno_button">
                        Confirmar
                    </button>
                </div>
                <div class="mdl-layout-spacer"></div>
          </div>-->

           <!--<div class="mdl-grid">
                <div class="mdl-layout-spacer"></div>
                <div id="figura_desc_buttons" class="mdl-cell mdl-cell--1-col">
                    <button type="submit" form="retorno" value="Submit" name="salvarretorno" class="mdl-button" id="salvar_retorno_button">
                        Confirmar
                    </button>
                    <form action="album.php" id='back'>
                        <button type="submit" form="back" value="Submit" name="BackButton" class="mdl-button" id="cancelar_edicao_button">
                            Cancelar
                        </button>
                    </form>
                </div>
                <div class="mdl-layout-spacer"></div>
            </div> -->
    </content>



<script src="app.js"></script>



</body>
</html>
