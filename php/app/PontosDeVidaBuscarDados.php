<?php
 
namespace PontosDeVida;
/**
 * Criação de Tabelas no Banco de Dados
 */
class PontosDeVidaBuscarDados {
 
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

    // retornar todos os dados da tabela usuarios
     public function todosUsuarios() {
        $stmt = $this->pdo->query('SELECT nome, login_usuario, senha, email, biografia, data_nascimento, tipo_sangue, nivel, oauth, smtoggle, privacidade '
                . 'FROM usuario '
                . 'ORDER BY nome');
        $DadosUsuarios = [];
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $DadosUsuarios[] = [
                'nome' => $row['nome'],
                'login_usuario' => $row['login_usuario'],
                'senha' => $row['senha'],
                'email' => $row['email'],
                'biografia' => $row['biografia'],
                'data_nascimento' => $row['data_nascimento'],
                'tipo_sangue' => $row['tipo_sangue'],
                'nivel' => $row['nivel'],
                'oauth' => $row['oauth'],
                'smtoggle' => $row['smtoggle'],
                'privacidade' => $row['privacidade']
            ];
        }
        return $DadosUsuarios;
    }


    public function dadosUsuarioAtivo($usuarioAtivo) {
        $stmt = $this->pdo->prepare('SELECT nome, login_usuario, senha, email, biografia, data_nascimento, tipo_sangue, nivel, oauth, smtoggle, privacidade '
                . 'FROM usuario '
                . 'WHERE login_usuario = :usuario');

        $stmt->bindValue(':usuario', $usuarioAtivo);
        $stmt->execute();
        $DadosUsuario = [];
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $DadosUsuario[] = [
                'nome' => $row['nome'],
                'login_usuario' => $row['login_usuario'],
                'senha' => $row['senha'],
                'email' => $row['email'],
                'biografia' => $row['biografia'],
                'data_nascimento' => $row['data_nascimento'],
                'tipo_sangue' => $row['tipo_sangue'],
                'nivel' => $row['nivel'],
                'oauth' => $row['oauth'],
                'smtoggle' => $row['smtoggle'],
                'privacidade' => $row['privacidade']
            ];
        }
        return $DadosUsuario;
    }

   


}

?>