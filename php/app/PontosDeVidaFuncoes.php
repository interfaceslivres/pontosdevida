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
    public function criarTemplate($nome,$descricao,$imagem,$tipo) {
        $sql = 'INSERT INTO template(nome,descricao,imagem,tipo) VALUES(:nome, :descricao,:imagem,:tipo)';
        $stmt = $this->pdo->prepare($sql);

        $stmt->bindValue(':nome', $nome);
        $stmt->bindValue(':descricao', $descricao);
        $stmt->bindValue(':imagem', $imagem);
        $stmt->bindValue(':tipo', $tipo);

        $stmt->execute();
        return "Doacao registrada";
    }
    public function alterarTemplate($nome,$descricao,$imagem,$tipo) {
        $sql = 'UPDATE template 
            SET descricao=:descricao,imagem=:imagem,tipo=:tipo
            WHERE nome=:nome';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':nome', $nome);
        $stmt->bindValue(':descricao', $descricao);
        $stmt->bindValue(':imagem', $imagem);
        $stmt->bindValue(':tipo', $tipo);

        $stmt->execute();
        return $stmt->rowCount();
    }
    public function deletarTemplate($nome) {
        $sql = 'DELETE FROM template WHERE nome=:nome';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':nome', $nome);

        $stmt->execute();
        return "Excluido";
    }

    public function criarFigurinha($posicao,$tabuleiro,$doada,$dono,$template) {
        $sql = 'INSERT INTO figurinha(posicao,tabuleiro,doada,dono,template) 
                VALUES(:posicao,:tabuleiro,:doada,:dono,:template)';
        $stmt = $this->pdo->prepare($sql);

        $stmt->bindValue(':posicao', $posicao);
        $stmt->bindValue(':tabuleiro', $tabuleiro);
        $stmt->bindValue(':doada', $doada);
        $stmt->bindValue(':dono', $dono);
        $stmt->bindValue(':template', $template);

        $stmt->execute();
        return "Figurinha registrada";
    }
    public function alterarFigurinha($id_figurinha,$posicao,$tabuleiro,$doada,$dono) {
        $sql = 'UPDATE figurinha 
            SET posicao=:posicao,tabuleiro=:tabuleiro,doada=:doada,dono=:dono
            WHERE id_figurinha=:id_figurinha';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':posicao', $posicao);
        $stmt->bindValue(':tabuleiro', $tabuleiro);
        $stmt->bindValue(':doada', $doada);
        $stmt->bindValue(':dono', $dono);
        $stmt->bindValue(':id_figurinha', $id_figurinha);

        $stmt->execute();
        return $stmt->rowCount();
    }
    public function deletarFigurinha($id_figurinha) {
        $usuario=$_SESSION['username'];
        $sql = 'DELETE FROM figurinha WHERE id_figurinha=:id_figurinha and dono=:dono';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':id_figurinha', $id_figurinha);
        $stmt->bindValue(':dono', $usuario);
        $stmt->execute();
        return "Excluido";
    }
}

?>
