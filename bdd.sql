USE mydatabase;

DROP TABLE IF EXISTS message;
DROP TABLE IF EXISTS devis;
DROP TABLE IF EXISTS client;
DROP TABLE IF EXISTS societe;

CREATE TABLE IF NOT EXISTS societe(
  id INT UNSIGNED NOT NULL AUTO_INCREMENT,
  nom VARCHAR(255) NOT NULL,
  PRIMARY KEY (id)
)ENGINE=INNODB;

CREATE TABLE IF NOT EXISTS client(
  id INT UNSIGNED NOT NULL AUTO_INCREMENT,
  nom VARCHAR(255) NOT NULL,
  prenom VARCHAR(255) NOT NULL,
  login VARCHAR(255) NOT NULL,
  mdp VARCHAR(255) NOT NULL,
  mail VARCHAR(255) NOT NULL,
  soc INT UNSIGNED NOT NULL,
  privilege INT UNSIGNED NOT NULL,
  PRIMARY KEY (id),
  FOREIGN KEY(soc) REFERENCES societe(id)
)ENGINE=INNODB;

CREATE TABLE IF NOT EXISTS message(
  id INT UNSIGNED NOT NULL AUTO_INCREMENT,
  contenu VARCHAR(1000) NOT NULL,
  id_client INT UNSIGNED,
  expediteur VARCHAR(255) NOT NULL,
  date_envoi DATETIME NOT NULL,
  PRIMARY KEY (id),
  FOREIGN KEY(id_client) REFERENCES client(id)
)ENGINE=INNODB;

CREATE TABLE IF NOT EXISTS devis(
  id INT UNSIGNED NOT NULL AUTO_INCREMENT,
  id_client INT UNSIGNED NOT NULL,
  soc INT UNSIGNED NOT NULL,
  descriptif VARCHAR(255) NOT NULL,
  statut INT UNSIGNED NOT NULL,
  prix INT UNSIGNED NOT NULL,
  PRIMARY KEY (id),
  FOREIGN KEY(id_client) REFERENCES client(id),
  FOREIGN KEY(soc) REFERENCES client(soc)
)ENGINE=INNODB;

INSERT INTO societe (nom) VALUES ('Sorbonne Université - UPMC');
INSERT INTO societe (nom) VALUES ('PC UP');
INSERT INTO client (nom,prenom,login,mdp,mail,soc,privilege) VALUES ('Leb', 'Raph', 'RaphLeb', "Raph",'raph.leb@gmail.com', 2, 0);
INSERT INTO client (nom,prenom,login,mdp,mail,soc,privilege) VALUES ('Leb', 'Flo', 'FloLeb', "Flo",'flo.leb@gmail.com', 2, 0);
INSERT INTO client (nom,prenom,login,mdp,mail,soc,privilege) VALUES ('Bam', 'Ibra', 'Ikader', "Ibra",'ikader.test@gmail.com', 1, 0);
INSERT INTO message (contenu,id_client,expediteur,date_envoi) VALUES ('Bienvenu sur votre compte Administrateur IsarteCréa.', 1, 'Hugo Magnaudet',NOW());
INSERT INTO devis (id_client,soc,descriptif,statut,prix) VALUES (1,2,'Voilà un devis test !',0,1000);
INSERT INTO devis (id_client,soc,descriptif,statut,prix) VALUES (2,2,'Ceci est un autre devis test !',0,1000);
INSERT INTO devis (id_client,soc,descriptif,statut,prix) VALUES (2,2,'Devis pour tester l\'en-cours !',0,3000);
INSERT INTO devis (id_client,soc,descriptif,statut,prix) VALUES (3,1,'Encore un devis de test ?',1,500);
