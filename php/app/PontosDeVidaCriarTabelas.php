<?php
 
namespace PontosDeVida;
/**
 * Criação de Tabelas no Banco de Dados
 */
class PontosDeVidaCriarTabelas {
 
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
    public function createTables() {
        $sqlList = ['DROP TABLE IF EXISTS usuario CASCADE;
                     CREATE TABLE usuario(
                      login_usuario VARCHAR(50) NOT NULL PRIMARY KEY,
                      senha VARCHAR(50) NOT NULL,
                      oauth BOOLEAN NOT NULL,
                      smtoggle BOOLEAN NOT NULL,
                      email VARCHAR(255) NOT NULL,
                      nome VARCHAR(50) NOT NULL,
                      biografia VARCHAR(255),
                      data_nascimento date,
                      privacidade BOOLEAN NOT NULL,
                      tipo_sangue VARCHAR(20),
                      nivel INT NOT NULL,
                      id_user serial
                     );',
                    'DROP TABLE IF EXISTS amigo CASCADE;
                     CREATE TABLE amigo(
                      usuario1 VARCHAR(50) NOT NULL,
                      usuario2 VARCHAR(50) NOT NULL,
                      PRIMARY KEY (usuario1,usuario2)
                     );',
                    'DROP TABLE IF EXISTS local CASCADE;
                     CREATE TABLE local(
                      id BIGSERIAL NOT NULL  PRIMARY KEY,
                      nome VARCHAR(50) NOT NULL
                     );',
                    'DROP TABLE IF EXISTS doacao CASCADE;
                     CREATE TABLE doacao(
                      id_doacao BIGSERIAL NOT NULL PRIMARY KEY,
                      doador VARCHAR(50) NOT NULL REFERENCES usuario(login_usuario),/*RELACIONAMENTO DOA*/
                      id_local BIGINT NOT NULL REFERENCES local(id),/*RELACIONAMENTO BASE*/
                      data date NOT NULL
                     );',
                    'DROP TABLE IF EXISTS cla CASCADE;
                     CREATE TABLE cla(
                      nome VARCHAR(50) NOT NULL,
                      id_cla BIGSERIAL NOT NULL PRIMARY KEY,
                      descricao VARCHAR(255) NOT NULL,
                      caminho_foto VARCHAR (255)
                     );',
                    'DROP TABLE IF EXISTS alocacao CASCADE;
                     CREATE TABLE alocacao(
                      usuario VARCHAR(50) NOT NULL PRIMARY KEY REFERENCES usuario(login_usuario),
                      id_cla BIGSERIAL NOT NULL REFERENCES cla(id_cla)
                     );',
                    'DROP TABLE IF EXISTS conquista CASCADE;
                     CREATE TABLE conquista(
                      nome VARCHAR(50) NOT NULL PRIMARY KEY,
                      icone VARCHAR(255) NOT NULL,
                      descricao VARCHAR(255) NOT NULL
                     );',
                    'DROP TABLE IF EXISTS cla_conquista CASCADE;
                     CREATE TABLE cla_conquista(
                      id_cla BIGSERIAL NOT NULL REFERENCES cla(id_cla) ,
                      conquista VARCHAR(255) NOT NULL REFERENCES conquista(nome),
                      PRIMARY KEY (id_cla, conquista)
                     );',
                    'DROP TABLE IF EXISTS template CASCADE;
                     CREATE TABLE template(
                      nome VARCHAR(50) NOT NULL PRIMARY KEY,
                      descricao VARCHAR(255) NOT NULL,
                      imagem VARCHAR(255) NOT NULL,
                      tipo INT NOT NULL
                     );',
                    'DROP TABLE IF EXISTS figurinha CASCADE;
                     CREATE TABLE figurinha(
                      id BIGINT NOT NULL,
                      posicao INT NOT NULL,
                      tabuleiro INT NOT NULL,
                      doada BOOLEAN NOT NULL,
                      id_cla BIGSERIAL REFERENCES cla(id_cla), /*RELACIONAMENTO COLETA*/
                      dono VARCHAR(50) NOT NULL REFERENCES usuario(login_usuario), /*RELACIONAMENTO COLETA*/
                      template VARCHAR(50) NOT NULL REFERENCES template(nome), /*RELACIONAMENTO CRIADA POR*/
                      PRIMARY KEY(ID,dono)
                     );',
                    'DROP TABLE IF EXISTS mensagem CASCADE;
                     CREATE TABLE mensagem(
                      id_mensagem BIGSERIAL NOT NULL  PRIMARY KEY,
                      data timestamp NOT NULL,
                      texto VARCHAR(255) NOT NULL,
                      remetente VARCHAR(50) NOT NULL REFERENCES usuario(login_usuario),
                      id_cla BIGSERIAL NOT NULL REFERENCES cla(id_cla)
                    );'];
 
        // execute each sql statement to create new tables
        foreach ($sqlList as $sql) {
            $this->pdo->exec($sql);
        }
        
        return $this;
    }
 
    /**
     * return tables in the database
     */
    public function getTables() {
        $stmt = $this->pdo->query("SELECT table_name 
                                   FROM information_schema.tables 
                                   WHERE table_schema= 'public' 
                                        AND table_type='BASE TABLE'
                                   ORDER BY table_name");
        $tableList = [];
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $tableList[] = $row['table_name'];
        }
 
        return $tableList;
    }
}

?>