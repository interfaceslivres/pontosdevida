<?php
 
namespace PontosDeVida;

class PontosDeVidaEnviarDados {

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
 * Registra dados de novo usuario
 */
    public function AdicionarDados($nome, $login_usuario, $senha, $email, $biografia, $data_nascimento, $tipo_sangue) {
        // prepare statement for insert
        $sql = 'INSERT INTO usuario(nome, login_usuario, senha, email, biografia, data_nascimento, tipo_sangue, nivel, oauth, smtoggle, privacidade) VALUES(:nome, :login_usuario, :senha, :email, :biografia, :data_nascimento, :tipo_sangue, :nivel, :oauth, :smtoggle, :privacidade)';
        $stmt = $this->pdo->prepare($sql);
        
        // pass values to the statement
        $stmt->bindValue(':nome', $nome);
        $stmt->bindValue(':login_usuario', $login_usuario);
        $stmt->bindValue(':senha', md5($senha));
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':biografia', $biografia);
        $stmt->bindValue(':data_nascimento', $data_nascimento);
        $stmt->bindValue(':tipo_sangue', $tipo_sangue);
        $stmt->bindValue(':nivel', '10');
        $stmt->bindValue(':oauth', '0');
        $stmt->bindValue(':smtoggle', '0');
        $stmt->bindValue(':privacidade', '0');

        
        // execute the insert statement
        $stmt->execute();
        
        // return generated id
        return "Registrados";
    }

    public function AtualizarDados($login_usuario, $nome, $senha, $email, $biografia) {
 
        // sql statement to update a row in the stock table
        $sql = 'UPDATE usuario '
                . 'SET nome = :nome, '
                . 'senha = :senha, '
                . 'email = :email, '
                . 'biografia = :biografia '
                . 'WHERE login_usuario = :login_usuario';
 
        $stmt = $this->pdo->prepare($sql);
 
        // bind values to the statement
        $stmt->bindValue(':login_usuario', $login_usuario);
        $stmt->bindValue(':nome', $nome);
        $stmt->bindValue(':senha', $senha);
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':biografia', $biografia);
        // update data in the database
        $stmt->execute();
 
        // return the number of row affected
        return $stmt->rowCount();
    }

}


?>