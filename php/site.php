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
        
        $Retorno = $chamador->criarFigurinha(0,1,"mateusdanton4299","Joker");
        echo $Retorno;
        $Retorno = $chamador->alterarFigurinha(3,1,2,"mateusdanton4299","Joker");
        echo $Retorno;
        
        $Retorno = $chamador->deletarFigurinha(1);
        echo $Retorno;
        $Retorno = $chamador->criarFigurinha(0,1,"mateusdanton4299","Joker");
        echo "Aqui";
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
    <h1><a>Atualizar Dados Usiario</a></h1>
      <form id="form"  method="post" action="">  
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
          <input id="privacidade" type="checkbox" name="F_privacidade" value="1"> PRIVACIDADE <br>
        </div>

        <script type="text/javascript">
              $('#tipo_sanguineo').val("<?= $dado['tipo_sangue'] ?>");
              var privacidade = "<?= $dado['privacidade'] ?>";
              if ( privacidade == 0) {$("#privacidade").prop("checked", false);}else {$("#privacidade").prop("checked", true);};
            </script>

          <input type="submit" name="submit" />
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