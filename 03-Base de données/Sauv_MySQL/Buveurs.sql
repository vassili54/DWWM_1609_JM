/*
Buveurs
 */
 
-- SUPPRIMER LA BASE DE DONNEES SI ELLE EXISTE
DROP DATABASE IF EXISTS Buveurs;

-- CREER UNE BASE DE DONNEES
CREATE DATABASE IF NOT EXISTS Buveurs;

-- Sélectionner la base de données
USE Buveurs;

-- Créer la table des utilisateurs

CREATE TABLE buveurs (
	num_buv INT AUTO_INCREMENT PRIMARY KEY,
	nom_buv VARCHAR(50) NOT NULL,
    prénom_buv VARCHAR(50) NOT NULL,
    ville_buv VARCHAR(100)
);

-- Créer la table vignerons

CREATE TABLE vignerons (
	num_vigneron INT AUTO_INCREMENT PRIMARY KEY,
    nom_vig VARCHAR(50) NOT NULL,
    prénom_vig VARCHAR(50) NOT NULL,
    ville_vig VARCHAR(100)
);


-- Créer la table vins

CREATE TABLE vins (
	num_vin INT AUTO_INCREMENT PRIMARY KEY,
    cru VARCHAR(50) NOT NULL,
    millésime DATE NOT NULL,
    num_vig INT,
    FOREIGN KEY (num_vig) REFERENCES vignerons(num_vigneron)  -- Relation avec la table vignerons
);

-- Créer la table commandes

CREATE TABLE commandes (
	num_com INT AUTO_INCREMENT PRIMARY KEY,
    date DATE NOT NULL,
    num_buv INT,
    FOREIGN KEY (num_buv) REFERENCES buveurs(num_buv)  -- Relation avec la table buveurs
);

-- Créer la table lignes de commandes

CREATE TABLE lignes_de_commandes (
	num_vin INT,
    num_com INT,
    quantité INT NOT NULL,
    PRIMARY KEY (num_vin, num_com),           -- Clé primaire composée
    FOREIGN KEY (num_vin) REFERENCES vins(num_vin),  -- Relation avec la table vins
    FOREIGN KEY (num_com) REFERENCES commandes(num_com)  -- Relation avec la table commandes
);    

-- Créer la Table Ressentis_vignerons_entre_eux

CREATE TABLE ressentis_vignerons_entre_eux (
	num_vigneron_juge INT,  -- Référence au vigneron qui juge (clé étrangère)
    num_vigneron_juger INT, -- Référence au vigneron jugé (clé étrangère)
    critère_appréciation TEXT NOT NULL,
	PRIMARY KEY (num_vigneron_juge, num_vigneron_juge),  -- Clé primaire composée
    FOREIGN KEY (num_vigneron_juge) REFERENCES vignerons(num_vigneron), -- Référence au vigneron jugé
    FOREIGN KEY (num_vigneron_juge) REFERENCES vignerons(num_vigneron)  -- Référence au vigneron juge
);
