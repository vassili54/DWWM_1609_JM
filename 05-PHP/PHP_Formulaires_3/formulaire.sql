-- Création de la base de données
DROP DATABASE IF EXISTS db_contact;
CREATE DATABASE IF NOT EXISTS db_contact;
USE db_contact;

-- Création de la table
CREATE TABLE tbl_contact (
	id INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(50) NOT NULL,
    date_naissance DATE NOT NULL,
    email VARCHAR(128) NOT NULL,
    message TEXT NOT NULL,
    date_creation DATETIME DEFAULT CURRENT_TIMESTAMP
);