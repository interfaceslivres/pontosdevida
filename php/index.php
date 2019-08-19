<!-- <?php

    $db_connection = pg_connect("host=localhost dbname=pontosdevida user=postgres  password=zaq1xsw2cde3");
    $result = pg_query($db_connection, "SELECT * FROM usuario");
    $data = pg_fetch_array($result, NULL, PGSQL_ASSOC);
    echo "Nome fdrom DB was: ".$data['email'];

?> -->

<?php
 
require 'vendor/autoload.php';

// CONECTAR SERVIDOR
 
use PontosDeVida\Connection as Connection;
 
try {
    Connection::get()->connect();

    echo'CONEXÃO COM O BANCO DE DADOS<br>';
    echo 'A connection to the PostgreSQL database sever has been established successfully.<br><hr>';
} catch (\PDOException $e) {
    echo $e->getMessage();
}

// CRIAÇÃO DE TABELAS

use PontosDeVida\PontosDeVidaCriarTabelas as PontosDeVidaCriarTabelas;

try {
  
    // connect to the PostgreSQL database
    $pdo = Connection::get()->connect();
    
    // 
    $tableCreator = new PontosDeVidaCriarTabelas($pdo);
    
    // create tables and query the table from the database
    // $tables = $tableCreator->createTables()
    //                         ->getTables();

    // query the table from the database
    $tables = $tableCreator->getTables();
    
    echo 'TABELAS CRIADAS<br>';
    foreach ($tables as $table){
        echo $table . '<br>';
    }
    echo '<hr>';

} catch (\PDOException $e) {
    echo $e->getMessage();
}

// ENVIAR DADOS PARA TABELA USUARIO

use PontosDeVida\PontosDeVidaEnviarDados as PontosDeVidaEnviarDados;
 
try {
    // connect to the PostgreSQL database
	$pdo = Connection::get()->connect();
    // 
    $InserirDados = new PontosDeVidaEnviarDados($pdo);
 
    // inserir dados do usuario na tabela usuario
    $id = $InserirDados->AdicionarDados('mateus', 'mateusdanton4299', '123', 'm@m.com', 'teste', '11-07-1993', 'o-');
    echo 'ENVIAR DADOS PARA AS TABELAS <BR>';
    echo 'Dados ' . $id . '<br><hr>';

} catch (\PDOException $e) {
    echo $e->getMessage();
}

// ATUALIZAR DADOS DA TABELA USUARIO

try {
    // connect to the PostgreSQL database
    $pdo = Connection::get()->connect();
 
    // 
    $atualizarCampos = new PontosDeVidaEnviarDados($pdo);
 
    // insere novos dados na tabela usuario $login_usuario, $nome, $senha, $email, $biografia
    $linhasAfetadas = $atualizarCampos->AtualizarDados('mateusdanton427', 'Danton', '321', 	'd@d.com', 'teste2');
 	echo  'ATUALIZAR DADOS DAS TABELAS<br>';
    echo 'Numero de linhas atualizadas: ' . $linhasAfetadas . '<br><hr>';
} catch (\PDOException $e) {
    echo $e->getMessage();
}

// BUSCAR DADOS DA TABELA USUARIO

use PontosDeVida\PontosDeVidaBuscarDados as PontosDeVidaBuscarDados;
 
try {
    // connect to the PostgreSQL database
    $pdo = Connection::get()->connect();
    // 
    $pegarUsuarios = new PontosDeVidaBuscarDados($pdo);
    // get all stocks data
    $DadosUsuarios = $pegarUsuarios->todosUsuarios();
} catch (\PDOException $e) {
    echo $e->getMessage();
}

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Pontos de Vida</title>
        <link rel="stylesheet" href="https://cdn.rawgit.com/twbs/bootstrap/v4-dev/dist/css/bootstrap.css">
    </head>
    <body>

    	<div id="form_container">
			<h1><a>Registrar Usiario</a></h1>
			<form id="form"  method="post" action="post-method.php">	
				<div>
					<input name="F_nome" type="text" placeholder="Nome"/> 
				</div> 
				<div>
					<input name="F_login" type="text" placeholder="Login"/> 
				</div> 
				<div>
					<input name="F_senha" type="text" placeholder="Senha"/> 
				</div> 
				<div>
					<input name="F_email" type="text" placeholder="Email"/> 
				</div>  
				<div>
					<input name="F_biografia" type="text" placeholder="Biografia"/> 
				</div> 
				<div>
					<input name="F_data_nascimento" type="text" placeholder="Data Nascimento"/> 
				</div> 
				<div>
					<select name="F_tipo_sanguineo" placeholder="Tipo sanguíneo"> 
						<option value="" selected="selected"></option>
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
			    <input type="submit" name="submit" />
			</form>	
		</div>

        <div class="container">
            <h1>Lista Usuarios</h1>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>login_usuario</th>
                        <th>senha</th>
                        <th>email</th>
                        <th>biografia</th>
                        <th>data_nascimento</th>
                        <th>tipo_sangue</th>
                        <th>nivel</th>
                        <th>oauth</th>
                        <th>smtoggle</th>
                        <th>privacidade</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($DadosUsuarios as $dado) : ?>
                        <tr>
                            <td><?php echo htmlspecialchars($dado['nome']) ?></td>
                            <td><?php echo htmlspecialchars($dado['login_usuario']); ?></td>
                            <td><?php echo htmlspecialchars($dado['senha']); ?></td>
                            <td><?php echo htmlspecialchars($dado['email']) ?></td>
                            <td><?php echo htmlspecialchars($dado['biografia']); ?></td>
                            <td><?php echo htmlspecialchars($dado['data_nascimento']); ?></td>
                            <td><?php echo htmlspecialchars($dado['tipo_sangue']) ?></td>
                            <td><?php echo htmlspecialchars($dado['nivel']); ?></td>
                            <td><?php echo htmlspecialchars($dado['oauth']); ?></td>
                            <td><?php echo htmlspecialchars($dado['smtoggle']) ?></td>
                            <td><?php echo htmlspecialchars($dado['privacidade']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </body>
</html>