<?php

require 'vendor/autoload.php';
use PontosDeVida\Connection as Connection;
use PontosDeVida\PontosDeVidaEnviarDados as PontosDeVidaEnviarDados;

// Check if the form is submitted
 if ( isset( $_POST['submit'] ) ) {
  // retrieve the form data by using the element's name attributes value as key
   $nome = $_POST['F_nome']; $login = $_POST['F_login']; $senha = $_POST['F_senha']; $email = $_POST['F_email']; $biografia = $_POST['F_biografia']; $data_nascimento = $_POST['F_data_nascimento']; $tipo_sanguineo = $_POST['F_tipo_sanguineo'];

   try {
    // connect to the PostgreSQL database
	$pdo = Connection::get()->connect();
    // 
    $InserirDados = new PontosDeVidaEnviarDados($pdo);
 
    // inserir dados do usuario na tabela usuario
    $InserirDados->AdicionarDados($nome, $login,  $senha, $email, $biografia, $data_nascimento, $tipo_sanguineo);

	} catch (\PDOException $e) {
	    echo $e->getMessage();
	}

	header('Location: ' . $_SERVER['HTTP_REFERER']);
	exit;
	   
	} 
?>