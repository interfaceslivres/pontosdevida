<?php

namespace PontosDeVida;
/**
 * Criação de Tabelas no Banco de Dados
 */
class PontosDeVidaFuncoes {

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

    //Utilizar apenas quando a solicitacao de amizade for aceita
    public function criarAmizade($usuario2) {

        $usuario1=$_SESSION['username'];
        if($usuario1==$usuario2){
            return "Erro voce nao pode ser seu amigo :-(";
        }
        $sql = 'INSERT INTO amigo(usuario1, usuario2) VALUES(:usuario1, :usuario2)';
        $stmt = $this->pdo->prepare($sql);

        $stmt->bindValue(':usuario1', $usuario1);
        $stmt->bindValue(':usuario2', $usuario2);

        $stmt->execute();

        return "Registrado";
    }
    public function excluirAmizade($usuario2) {

        $usuario1=$_SESSION['username'];
        $sql = 'DELETE FROM  amigo WHERE usuario1=:usuario1 AND usuario2=:usuario2';
        $stmt = $this->pdo->prepare($sql);

        $stmt->bindValue(':usuario1', $usuario1);
        $stmt->bindValue(':usuario2', $usuario2);

        $stmt->execute();

        $sql = 'DELETE FROM  amigo WHERE usuario1=:usuario1 AND usuario2=:usuario2';
        $stmt = $this->pdo->prepare($sql);

        $stmt->bindValue(':usuario1', $usuario2);
        $stmt->bindValue(':usuario2', $usuario1);

        $stmt->execute();

        return "Deletado";
    }


    // Mostrar Amigos do usuario logado
    public function mostrarAmigos() {
        $usuario=$_SESSION['username'];
        $stmt = $this->pdo->prepare('SELECT usuario1 '
                . 'FROM amigo '
                . 'WHERE usuario2=:usuario');
        $stmt->bindValue(':usuario', $usuario);

		$stmt->execute();
        $dadosUsuarios = [];
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            array_push($dadosUsuarios, $row['usuario1']);
        }
        $stmt = $this->pdo->prepare('SELECT usuario2 '
                . 'FROM amigo '
                . 'WHERE usuario1=:usuario');
        $stmt->bindValue(':usuario', $usuario);

		$stmt->execute();
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            array_push($dadosUsuarios, $row['usuario2']);
        }
        return $dadosUsuarios;
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
    public function criarDoacao($id_local) {

        $usuario=$_SESSION['username'];
        $diasEntreDoacoes=90;
        $stmt = $this->pdo->prepare('SELECT data '
                . 'FROM doacao '
                . 'WHERE doador = :usuario '
                . 'ORDER BY data DESC',);

			$stmt->bindValue(':usuario', $usuario);

			$stmt->execute();

        $doavel=FALSE;
        if($stmt->rowCount() > 0 ){
                $row = $stmt->fetchObject();
                $datapassada = $row -> data;
                if((strtotime(date('Y-m-d'))-strtotime($datapassada))/86400 > $diasEntreDoacoes){
                    $doavel=TRUE;//se faz mais que 90 dias
                }
        }
        else{
            $doavel=TRUE;//se nunca doou 
        }
        if($doavel){
            $sql = 'INSERT INTO doacao(doador, id_local,data) VALUES(:usuario, :id_local,:data)';
            $stmt = $this->pdo->prepare($sql);

            $stmt->bindValue(':usuario', $usuario);
            $stmt->bindValue(':id_local', $id_local);
            $stmt->bindValue(':data', date('Y-m-d'));

            $stmt->execute();
            return "Doacao registrada";
        }
        else{
            return "Doacao nao registrada";
        }
        

        
    }


}

?>
 <!-- <?php
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
    ?> -->