
DROP TABLE notifica;

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