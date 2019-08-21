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