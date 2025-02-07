/*
ecf_legumos_matz
*/

-- SUPPRIMER LA BASE DE DONNEES SI ELLE EXISTE
DROP DATABASE IF EXISTS ecf_legumos_matz;

-- CREER UNE BASE DE DONNEES
CREATE DATABASE IF NOT EXISTS ecf_legumos_matz;

-- Sélectionner la base de données
USE ecf_legumos_matz;

-- Créer la table vegetables
CREATE TABLE vegetables (
    id INT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    variety VARCHAR(50) NOT NULL,
    primaryColor VARCHAR(20) NOT NULL,
    lifeTime INT NOT NULL,
    fresh INT NOT NULL
);

-- Créer la table sales
CREATE TABLE sales (
    saleId INT AUTO_INCREMENT PRIMARY KEY,
    id INT NOT NULL, -- Ajout de la colonne id pour la clé étrangère
    saleDate DATE NOT NULL,
    saleWeight INT NOT NULL,
    saleUnitPrice DECIMAL(5,2) NOT NULL,
    saleActive INT NOT NULL,
    FOREIGN KEY (id) REFERENCES vegetables(id) -- Référence à la table vegetables
);

-- Créer la table concern
CREATE TABLE concern (
    id INT, 
    saleId INT,
    saleNumber INT, -- saleNumber représente le nombre de ventes
    PRIMARY KEY (id, saleId),
    FOREIGN KEY (id) REFERENCES vegetables(id),
    FOREIGN KEY (saleId) REFERENCES sales(saleId)
);

