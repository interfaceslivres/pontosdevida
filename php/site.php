<!DOCTYPE html PUBLIC 
"-//W3C//DTD XHTML 1.0 Transitional//EN" 
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
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
   
   <button id="deslogar" > deslogar </button>

</body>
</html>

<script type="text/javascript" language="javascript">
    $(document).ready(function() {
        /// Quando usuário clicar em salvar será feito todos os passo abaixo
        $('#deslogar').click(function() {
            $.ajax({
                url: 'logout.php'
            });
            window.location.href = "index.php";
        });
    });
</script>