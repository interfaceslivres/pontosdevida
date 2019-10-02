<!DOCTYPE html>
<html>
<head>
<?php

session_start();
if((!isset ($_SESSION['username']) == true) and (!isset ($_SESSION['valid']) == true))
{
  unset($_SESSION['username']);
  unset($_SESSION['valid']);
  header('location:index.php');
  }

$logado = $_SESSION['username'];
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script src="jquery-3.4.1.min.js" type="text/javascript" ></script>
</head>

<body>

  <?php
  echo" Bem vindo $logado";
  ?>


  <hr>

  <?php
    require 'vendor/autoload.php';
    use PontosDeVida\Connection as Connection;
    use PontosDeVida\PontosDeVidaBuscarDados as PontosDeVidaBuscarDados;
    use PontosDeVida\PontosDeVidaFuncoes as PontosDeVidaFuncoes;
    try{
      $pdo = Connection::get()->connect();
      $pegarDados = new PontosDeVidaBuscarDados($pdo);
      $DadosUsuario = $pegarDados->dadosUsuarioAtivo($_SESSION['username']);
      } catch (\PDOException $e) {
          echo $e->getMessage();
      }


    try{

        $pdo = Connection::get()->connect();
        $chamador =new PontosDeVidaFuncoes($pdo);
        //$Retorno = $chamador->criarTemplate("Joker","Voce e um doador brincalhao","NULL",1);
        //echo $Retorno;
        //$chamador->criarTemplate("Joker","Figurinha bonita","c:/teste",1);
        $result=$chamador->criarCla("OS doadu","A gente doa demais","c:/fotoscla/doadudos");
        $id=$chamador->meuCla();
        $chamador->alterarCla($id,"Os Doadendos","Doa dendo sim","flaviosms","c:/fotoscla/doadudos");
        #$chamador->criarTemplate("Batman","opa","c:/teste",1);
        $idfig=$chamador->criarFigurinha(0,0,0,"flaviosms","Batman");
        #$result=$chamador->doarFigurinha($idfig);
        #$result=$chamador->receberFigurinha(12);

        #$result=$chamador->criarAlocacao("mateusdanton4299",$id);
        $result=$chamador->deletarAlocacao("teste");

        $result=$chamador->criarConquista("Melhorcla2","c:/figconquista","conquista de ser o melhor cla");
        $result=$chamador->alterarConquista("Melhorcla2","c:/figconquistacla","conquista de ser o melhor cla de todos");

        $result=$chamador->criarClaConquista($id,"Melhorcla2");
        $result=$chamador->deletarConquista("Melhorcla2");

        #$result=$chamador->criarMensagem("Oi galera tudo bem");
        $idlocal=$chamador->criarLocal("Hemocentro");
        $result=$chamador->criarDoacao($idlocal);
        $result=$chamador->quantidadeDoacoes();
        $result=$chamador->verMensagens();
        #$result=$chamador->mostrarFigurinhasTemplate();
        echo "<br>";
        echo var_dump($result);
        echo "<br>oioi";
        } catch (\PDOException $e) {

            echo $e->getMessage();
        }
   ?>
<?php foreach ($DadosUsuario as $dado) : ?>
    <p>Nome: <?php echo htmlspecialchars($dado['nome']) ?></p>
    <p>Login: <?php echo htmlspecialchars($dado['login_usuario']); ?></p>
    <p>Senha: <?php echo htmlspecialchars($dado['senha']); ?></p>
    <p>Email:<?php echo htmlspecialchars($dado['email']) ?></p>
    <p>Bio:<?php echo htmlspecialchars($dado['biografia']); ?></p>
    <p>Data de Nascimento: <?php echo htmlspecialchars($dado['data_nascimento']); ?></p>
    <p>Tipo Sanguineo: <?php echo htmlspecialchars($dado['tipo_sangue']) ?></p>
    <p>Nivel: <?php echo htmlspecialchars($dado['nivel']); ?></p>
    <p>Oauth: <?php echo htmlspecialchars($dado['oauth']); ?></p>
    <p>Smtoggle: <?php echo htmlspecialchars($dado['smtoggle']) ?></p>
    <p>Privacidade: <?php echo htmlspecialchars($dado['privacidade']); ?></p>
    <?php endforeach; ?>

    <hr>


    <?php foreach ($DadosUsuario as $dado) : ?>

      <?php
      if( isset($_GET['submit1']) )
      {
          //be sure to validate and clean your variables
          $val1 = htmlentities($_GET['F_nome']);
          echo "bunito\n";
          if($val1!=NULL){
            $_SESSION["bunito"]=$val1;
          }


          //then you can use them in a PHP function.
      }
      if($_SESSION["bunito"]!=null)echo $_SESSION["bunito"];
      ?>
    <h1><a>Atualizar Dados Usuario</a></h1>
      <form id="form"  method="get" action="">
        <div>
          <input name="F_nome" type="text" value="<?= $dado['nome'] ?>"/>
        </div>
        <div>
          <input name="F_login" type="text" value="<?= $dado['login_usuario'] ?>"/>
        </div>
        <div>
          <input name="F_senha" type="text" value="<?= $dado['senha'] ?>"/>
        </div>
        <div>
          <input name="F_email" type="text" value="<?= $dado['email'] ?>"/>
        </div>
        <div>
          <input name="F_biografia" type="text" value="<?= $dado['biografia'] ?>"/>
        </div>
        <div>
          <input name="F_data_nascimento" type="text" value="<?= $dado['data_nascimento'] ?>"/>
        </div>
        <div>
          <select id="tipo_sanguineo" name="F_tipo_sanguineo" value="Tipo sanguíneo">
            <!-- JS colocar selected na opção slecionada -->

            <option value="A+" >A+</option>
            <option value="A-" >A-</option>
            <option value="B+" >B+</option>
            <option value="B-" >B-</option>
            <option value="AB+" >AB+</option>
            <option value="AB-" >AB-</option>
            <option value="O+" >O+</option>
            <option value="O-" >O-</option>
          </select>
        </div>

        <div>
          <input id="privacidade" type="checkbox" name="F_privacidade" value="True"> PRIVACIDADE <br>
        </div>
<!--
        <script type="text/javascript">
              $('#tipo_sanguineo').val("<?= $dado['tipo_sangue'] ?>");
              var privacidade = "<?= $dado['privacidade'] ?>";
              if ( privacidade == 0) {$("#privacidade").prop("checked", false);}else {$("#privacidade").prop("checked", true);};
            </script> -->

          <input type="submit" name="submit1" />
      </form>

      <?php
      if( isset($_GET['submit2']) )
      {
          //be sure to validate and clean your variables
          $val1 = htmlentities($_GET['F_nome']);
          echo "feio\n";
          echo $val1;
          //then you can use them in a PHP function.
      }
      ?>
      <form id="form"  method="get" action="">
        <div>
          <input name="F_nome" type="text" value="<?= $dado['nome'] ?>"/>
        </div>
        <input type="submit" name="submit2" />
      </form>
      <?php endforeach; ?>

  <hr>

   <a href="logout.php"><button > Deslogar </button>

</body>
</html>

<!-- <script type="text/javascript" language="javascript">
    $(document).ready(function() {
        /// Quando usuário clicar em salvar será feito todos os passo abaixo
        $('#deslogar').click(function() {
            $.ajax({
                url: 'logout.php'
            });
            window.location.href = "index.php";
        });
    });
</script> -->
 <!-- TESTES ANTIGOS
    require 'vendor/autoload.php';
    use PontosDeVida\Connection as Connection;
    use PontosDeVida\PontosDeVidaFuncoes as PontosDeVidaFuncoes;
    $pdo = Connection::get()->connect();
    $ChamaFuncao = new PontosDeVidaFuncoes($pdo);
    $ChamaFuncao->excluirAmizade("flaviosms");
    $ChamaFuncao->criarAmizade("flaviosms");
    $Amigos=$ChamaFuncao->mostrarAmigos();
    echo var_dump($Amigos);
    $ChamaFuncao->excluirAmizade("flaviosms");
    $Amigos=$ChamaFuncao->mostrarAmigos();
    echo var_dump($Amigos);
    $Report=$ChamaFuncao->criarDoacao("1");
    echo $Report;
     -->
