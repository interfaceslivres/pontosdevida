
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
  tempo_retorno INT
);


CREATE TABLE amigo(
  usuario1 VARCHAR(50) NOT NULL,
  usuario2 VARCHAR(50) NOT NULL,
  PRIMARY KEY (usuario1,usuario2)
);

CREATE TABLE local(
  id INT AUTO_INCREMENT NOT NULL  PRIMARY KEY,
  nome VARCHAR(50) NOT NULL
);

CREATE TABLE doacao(
  id_doacao INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
  doador VARCHAR(50) NOT NULL REFERENCES usuario(login_usuario),/*RELACIONAMENTO DOA*/
  id_local BIGINT NOT NULL REFERENCES local(id),/*RELACIONAMENTO BASE*/
  data date NOT NULL
);

CREATE TABLE cla(
  nome VARCHAR(50) NOT NULL,
  id_cla INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
  descricao VARCHAR(255) NOT NULL,
  lider VARCHAR(50) NOT NULL REFERENCES usuario(login_usuario),
  caminho_foto VARCHAR (255)
);

CREATE TABLE alocacao(
  usuario VARCHAR(50) NOT NULL PRIMARY KEY REFERENCES usuario(login_usuario),
  id_cla INT NOT NULL REFERENCES cla(id_cla)
);

CREATE TABLE conquista(
  nome VARCHAR(50) NOT NULL PRIMARY KEY,
  icone VARCHAR(255) NOT NULL,
  descricao VARCHAR(255) NOT NULL
);

CREATE TABLE cla_conquista(
  id_cla INT NOT NULL REFERENCES cla(id_cla) ,
  conquista VARCHAR(255) NOT NULL REFERENCES conquista(nome),
  PRIMARY KEY (id_cla, conquista)
);

CREATE TABLE template(
  nome VARCHAR(50) NOT NULL PRIMARY KEY,
  descricao VARCHAR(255) NOT NULL,
  imagem VARCHAR(255) NOT NULL,
  tipo INT NOT NULL
);

CREATE TABLE figurinha(
  id_figurinha INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
  posicao INT NOT NULL,
  tabuleiro INT NOT NULL,
  fixa BOOLEAN NOT NULL,
  dono VARCHAR(50) NOT NULL REFERENCES usuario(login_usuario), /*RELACIONAMENTO COLETA*/
  template VARCHAR(50) NOT NULL REFERENCES template(nome) /*RELACIONAMENTO CRIADA POR*/

);

CREATE TABLE figurinha_cla(
  id_figcla INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
  template VARCHAR(50) NOT NULL REFERENCES template(nome),
  id_cla INT NOT NULL REFERENCES cla(id_cla)
);

CREATE TABLE mensagem(
  id_mensagem INT AUTO_INCREMENT NOT NULL  PRIMARY KEY,
  data timestamp NOT NULL,
  texto VARCHAR(255) NOT NULL,
  remetente VARCHAR(50) NOT NULL REFERENCES usuario(login_usuario),
  id_cla INT NOT NULL REFERENCES cla(id_cla)
);

CREATE TABLE template_not(
  id_not INT AUTO_INCREMENT NOT NULL  PRIMARY KEY,
  texto VARCHAR(255) NOT NULL
);

CREATE TABLE notifica(
  usuario VARCHAR(50) NOT NULL REFERENCES usuario(login_usuario), /*RELACIONAMENTO COLETA*/
  id_not INT NOT NULL REFERENCES template_not(id_not) /*RELACIONAMENTO CRIADA POR*/
);
