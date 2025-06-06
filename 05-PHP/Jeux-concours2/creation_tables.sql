-- SUPPRIMER LA BASE DE DONNEES SI ELLE EXISTE
DROP DATABASE IF EXISTS festival;

-- Ceci crée la base de données 'festival' si elle n'existe pas encore.
-- Une base de données est comme un grand classeur pour ranger vos tables.
CREATE DATABASE IF NOT EXISTS festival;

-- Ceci dit à MySQL : "Toutes les commandes qui suivent doivent s'appliquer à la base de données 'festival'."
USE festival;

-- Création de la table 'candidats'. C'est là que seront stockées les informations des participants.
-- Chaque colonne (id_user, lastname_user, etc.) est expliquée par son nom.
-- PRIMARY KEY (id_user) signifie que id_user est l'identifiant unique de chaque participant.
CREATE TABLE IF NOT EXISTS candidats (
    id_user INT UNSIGNED NOT NULL AUTO_INCREMENT,
    lastname_user varchar(50) NOT NULL,
    firstname_user varchar(50) NOT NULL,
    mail_user varchar(150) NOT NULL,
    pass_user varchar(500) NOT NULL,
    departement_user int UNSIGNED NOT NULL,
    age_user tinyint UNSIGNED NOT NULL,
    PRIMARY KEY (id_user)
) ENGINE=InnoDB;

-- Création de la table 'departements'. Cette table contiendra la liste des départements.
-- PRIMARY KEY (id_dep) signifie que id_dep est l'identifiant unique de chaque département.
CREATE TABLE IF NOT EXISTS departements (
    id_dep INT UNSIGNED NOT NULL PRIMARY KEY,
    Name varchar(50) NOT NULL,
    dep_actif INT UNSIGNED NOT NULL,
    dep_taux decimal(5,2) NOT NULL
) ENGINE=InnoDB;

-- Ceci est la partie la plus importante pour l'erreur que vous avez eue !
-- On ajoute une "clé étrangère" (FOREIGN KEY).
-- C'est un lien entre la colonne 'departement_user' dans la table 'candidats'
-- et la colonne 'id_dep' dans la table 'departements'.
-- Cela garantit que chaque département renseigné pour un candidat existe bien dans notre liste de départements.
-- C'est pourquoi la table 'departements' DOIT exister AVANT d'ajouter cette contrainte.

ALTER TABLE candidats ADD CONSTRAINT fk_departement_user FOREIGN KEY (departement_user) REFERENCES departements(id_dep);

-- SELECT COUNT(*) FROM departements; -- Doit retourner 95
-- SELECT * FROM departements LIMIT 10; -- Voir les 10 premiers départements

-- requête SQL pour voir l'inscription du formulaire
-- SELECT * FROM festival.candidats LIMIT 1000;