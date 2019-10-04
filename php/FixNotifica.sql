
DROP TABLE notifica;

CREATE TABLE notifica(
  dono VARCHAR(50) NOT NULL , /*RELACIONAMENTO COLETA*/
  id_not INT NOT NULL  ,/*RELACIONAMENTO CRIADA POR*/
  remetente VARCHAR(50),/*RELACIONAMENTO CRIADA POR*/
  FOREIGN KEY (dono) REFERENCES usuario(login_usuario) ON DELETE CASCADE,
  FOREIGN KEY (id_not) REFERENCES template_not(id_not) ON DELETE CASCADE,
  FOREIGN KEY (remetente) REFERENCES usuario(login_usuario) ON DELETE CASCADE
);