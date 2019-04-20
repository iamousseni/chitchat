CREATE DATABASE chitchat CHARACTER SET utf8;
USE chitchat;

CREATE TABLE utente(
  username varchar(100) NOT NULL,
  nome varchar(100) NOT NULL,
  cognome varchar(100) NOT NULL,
  email varchar(500) NOT NULL,
  password varchar(100) NOT NULL,
  dataNascita datetime NOT NULL,
  genere enum('M','F') NOT NULL,
  bio mediumtext DEFAULT NULL,
  pathImageProfile mediumtext DEFAULT NULL,
  dataOraCreazione datetime NOT NULL DEFAULT NOW(),
  active tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY(username)
);

CREATE TABLE chat(
  idChat int(11) NOT NULL AUTO_INCREMENT,
  tipo enum('P','G') NOT NULL,
  dataOraCreazione datetime DEFAULT NOW(),
  PRIMARY KEY(idChat)
);

CREATE TABLE appartenere(
  idAppartenere int(11) NOT NULL AUTO_INCREMENT,
  codUtente varchar(100),
  codChat int,
  admin tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY(idAppartenere),
  FOREIGN KEY(codUtente) REFERENCES utente(username) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY(codChat) REFERENCES chat(idChat) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE tris(
  idTris int(11) NOT NULL AUTO_INCREMENT,
  userReq varchar(100),
  userAcc varchar(100),
  userWin varchar(100),
  statoReq tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY(idTris),
  FOREIGN KEY(userReq) REFERENCES utente(username) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY(userAcc) REFERENCES utente(username) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY(userWin) REFERENCES utente(username) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE mossa(
  idMossa int(11) NOT NULL AUTO_INCREMENT,
  codUtente varchar(100),
  codTris int,
  x int(1) NOT NULL,
  y int(1) NOT NULL,
  stato enum('X','O') NOT NULL,
  PRIMARY KEY(idMossa),
  FOREIGN KEY(codUtente) REFERENCES utente(username) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY(codTris) REFERENCES tris(idTris) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE messaggio(
  idMessaggio int(11) NOT NULL AUTO_INCREMENT,
  codUtente varchar(100),
  codChat int,
  dataOraInvio datetime NOT NULL DEFAULT NOW(),
  pathFile mediumtext DEFAULT NULL,
  testo mediumtext DEFAULT NULL,
  PRIMARY KEY(idMessaggio),
  FOREIGN KEY(codUtente) REFERENCES utente(username) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY(codChat) REFERENCES chat(idChat) ON DELETE CASCADE ON UPDATE CASCADE
);


CREATE DEFINER=`root`@`localhost` EVENT `removeInactive` ON SCHEDULE EVERY 1 DAY STARTS '2019-03-15 00:00:00' ON COMPLETION NOT PRESERVE ENABLE DO DELETE FROM utente WHERE DATEDIFF(NOW(), dataOraCreazione) > 0 AND active = 0;