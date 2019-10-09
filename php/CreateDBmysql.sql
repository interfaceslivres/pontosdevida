
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
  tempo_retorno INT,
  sexo VARCHAR(1) NOT NULL,
  foto VARCHAR(255)
);


CREATE TABLE amigo(
  usuario1 VARCHAR(50) NOT NULL,
  usuario2 VARCHAR(50) NOT NULL,
  PRIMARY KEY (usuario1,usuario2),
  FOREIGN KEY (usuario1) REFERENCES usuario(login_usuario) ON DELETE CASCADE,
  FOREIGN KEY (usuario2) REFERENCES usuario(login_usuario) ON DELETE CASCADE
);

CREATE TABLE local(
  id INT AUTO_INCREMENT NOT NULL  PRIMARY KEY,
  nome VARCHAR(50) NOT NULL
);

CREATE TABLE doacao(
  id_doacao INT AUTO_INCREMENT NOT NULL,
  doador VARCHAR(50) NOT NULL ,/*RELACIONAMENTO DOA*/
  id_local INT NOT NULL ,/*RELACIONAMENTO BASE*/
  data date NOT NULL,
  PRIMARY KEY (id_doacao),
  FOREIGN KEY (doador) REFERENCES usuario(login_usuario) ON DELETE CASCADE,
  FOREIGN KEY (id_local) REFERENCES local(id) ON DELETE CASCADE
);

CREATE TABLE cla(
  nome VARCHAR(50) NOT NULL,
  id_cla INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
  descricao VARCHAR(255) NOT NULL,
  lider VARCHAR(50) NOT NULL ,
  caminho_foto VARCHAR (255),
  FOREIGN KEY (lider) REFERENCES usuario(login_usuario) ON DELETE CASCADE
);

CREATE TABLE alocacao(
  usuario VARCHAR(50) NOT NULL PRIMARY KEY,
  id_cla INT NOT NULL,
  FOREIGN KEY (usuario) REFERENCES usuario(login_usuario) ON DELETE CASCADE,
  FOREIGN KEY (id_cla) REFERENCES cla(id_cla) ON DELETE CASCADE
);

CREATE TABLE conquista(
  nome VARCHAR(50) NOT NULL PRIMARY KEY,
  icone VARCHAR(255) NOT NULL,
  descricao VARCHAR(255) NOT NULL
);

CREATE TABLE cla_conquista(
  id_cla INT NOT NULL,
  conquista VARCHAR(255) NOT NULL ,
  PRIMARY KEY (id_cla, conquista),
  FOREIGN KEY (id_cla) REFERENCES cla(id_cla) ON DELETE CASCADE,
  FOREIGN KEY (conquista) REFERENCES conquista(nome) ON DELETE CASCADE
);

CREATE TABLE template(
  nome VARCHAR(50) NOT NULL PRIMARY KEY,
  descricao VARCHAR(500) NOT NULL,
  imagem VARCHAR(255) NOT NULL,
  tipo INT NOT NULL
);

CREATE TABLE figurinha(
  id_figurinha INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
  posicao INT NOT NULL,
  tabuleiro INT NOT NULL,
  fixa BOOLEAN NOT NULL,
  dono VARCHAR(50) NOT NULL , /*RELACIONAMENTO COLETA*/
  template VARCHAR(50) NOT NULL , /*RELACIONAMENTO CRIADA POR*/
  FOREIGN KEY (dono) REFERENCES usuario(login_usuario) ON DELETE CASCADE,
  FOREIGN KEY (template) REFERENCES template(nome) ON DELETE CASCADE

);

CREATE TABLE figurinha_cla(
  id_figcla INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
  template VARCHAR(50) NOT NULL,
  id_cla INT NOT NULL ,
  FOREIGN KEY (template) REFERENCES template(nome) ON DELETE CASCADE,
  FOREIGN KEY (id_cla) REFERENCES cla(id_cla) ON DELETE CASCADE
);

CREATE TABLE mensagem(
  id_mensagem INT AUTO_INCREMENT NOT NULL  PRIMARY KEY,
  data timestamp NOT NULL,
  texto VARCHAR(255) NOT NULL,
  remetente VARCHAR(50) NOT NULL ,
  id_cla INT NOT NULL ,
  FOREIGN KEY (remetente) REFERENCES usuario(login_usuario) ON DELETE CASCADE,
  FOREIGN KEY (id_cla) REFERENCES cla(id_cla) ON DELETE CASCADE
);

CREATE TABLE template_not(
  id_not INT AUTO_INCREMENT NOT NULL  PRIMARY KEY,
  texto VARCHAR(255) NOT NULL
);

CREATE TABLE notifica(
  id_notifica INT AUTO_INCREMENT NOT NULL  PRIMARY KEY,
  dono VARCHAR(50) NOT NULL , /*RELACIONAMENTO COLETA*/
  id_template INT NOT NULL  ,/*RELACIONAMENTO CRIADA POR*/
  remetente VARCHAR(50),
  id_cla INT,
  FOREIGN KEY (dono) REFERENCES usuario(login_usuario) ON DELETE CASCADE,
  FOREIGN KEY (id_template) REFERENCES template_not(id_not) ON DELETE CASCADE,
  FOREIGN KEY (remetente) REFERENCES usuario(login_usuario) ON DELETE CASCADE,
  FOREIGN KEY (id_cla) REFERENCES cla(id_cla) ON DELETE CASCADE
);
