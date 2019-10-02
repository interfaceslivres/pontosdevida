<?php

namespace PontosDeVida;
/**
 * Criação de Tabelas no Banco de Dados
 */
class PontosDeVidaLogin {

    /**
     * PDO object
     * @var \PDO
     */
    private $pdo;

    /**
     * init the object with a \PDO object
     * @param type $pdo
     */
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    /**
     * create tables
     */


	public function login($usuarioInput, $senhaInput){

		if (!empty($usuarioInput) && !empty($senhaInput)) {

			$stmt = $this->pdo->prepare('SELECT login_usuario, senha FROM usuario WHERE login_usuario = :usuario');

			$stmt->bindValue(':usuario', $usuarioInput);

			$stmt->execute();


      if($stmt->rowCount() > 0 ){
	        $row = $stmt->fetchObject();
	        $login = $row -> login_usuario;
	        $senha = $row -> senha;

               if ($usuarioInput == $login &&
                  md5($senhaInput) == $senha) {
                   return array('valid' => true,
                                'timeout' => time(),
                                'username' => $login,
                                'msg' => 'Senha Certinha');
               }else {
                  return array('valid' => false,
                               'timeout' => '',
                               'username' => '',
                               'msg' => 'Senha errada');
               }
      }else{
        return array('valid' => false,
                     'timeout' => '',
                     'username' => '',
                     'msg' => 'usuario não existe');
      }
    }
  }
}

?>
