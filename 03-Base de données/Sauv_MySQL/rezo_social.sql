/*
Mini rézo social
 */
 
 /* SUPPRIMER LA BASE DE DONNEES SI ELLE EXISTE */
DROP DATABASE IF EXISTS rezo_social;

/* CREER UNE BASE DE DONNEES NOMMEE "social" */
CREATE DATABASE IF NOT EXISTS rezo_social;

/* SELECTIONNER/UTILISER LA BASE DE DONNEES CREEE */
USE rezo_social;

/* CREER UNE TABLE NOMMEE "utilisateur" */
CREATE TABLE utilisateur
(
	id INT PRIMARY KEY,
    nom_utilisateur VARCHAR(32) NOT NULL UNIQUE,
    email VARCHAR(128) UNIQUE NOT NULL
);

/* CREER UNE TABLE NOMMEE "publication" */
CREATE TABLE publication
(
	pub_id INT PRIMARY KEY AUTO_INCREMENT,
    pub_date DATETIME NOT NULL,
    pub_titre VARCHAR(255) NOT NULL,
	pub_contenu TEXT NOT NULL,
    id INT
);

/* CREER LA TABLE AIMER */
CREATE TABLE aimer
(
	id INT,
    pub_id INT,
    PRIMARY KEY (id, pub_id)
);

/* Modifier la table de publication et y aouter une clé étrangère */
ALTER TABLE publication ADD FOREIGN KEY (id) REFERENCES utilisateur(id);

ALTER TABLE aimer ADD CONSTRAINT fk_aimer_utilisateur FOREIGN KEY (id) REFERENCES utilisateur(id);

ALTER TABLE aimer ADD CONSTRAINT fk_aimer_publication FOREIGN KEY (pub_id) REFERENCES publication(pub_id);

/* ALTER TABLE aimer 
	ADD CONSTRAINT fk_aimer_utilisateur FOREIGN KEY (id) REFERENCES utilisateur(id);
    ADD CONSTRAINT fk_aimer_publication FOREIGN KEY (pub_id) REFERENCES publication(pub_id); */

/* ALTER TABLE aimer DROP CONSTRAINT fk_aimer_utilisateur; */


