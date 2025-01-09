/* 
INSERER LE JEU D'ESSAI DANS LA TABLE FILMS
Sous langage : DML / LMD
Data Manipulation Language
Langage de manipulation des données
Principales instructions : 
INSERT : Ajouter des nouvelles données dans la table
UPDATE : Mettre à jour des données existantes dans une table
DELETE : Supprimer des données existances dans la table
TRUNCATE : Vider une table
*/


-- Sélectionnner la base de données
USE videos;

-- DELETE FROM realisateur; -- suprime toutes les données de la table realisteur

TRUNCATE TABLE film_acteur; -- vider la table film_acteur et réinitialise l'auto_increment
TRUNCATE TABLE film; -- vider la table film et réinitialise l'auto_increment
TRUNCATE TABLE acteur; -- vider la table acteur et réinitialise l'auto_increment
TRUNCATE TABLE realisateur; -- vider la table realisateur et réinitialise l'auto_increment

/* Insertion des données dans la  table "realisateur" */

INSERT INTO realisateur
VALUES
(NULL, "besson", "luc"),
(NULL, "Spielberg", "Steven"),
(NULL, "Carpenter", "John");

INSERT INTO acteur
(acteur_prenom, acteur_nom)
VALUES
("Jean", "Réno"),
("Mel", "Gibson"),
("Tom", "Holland"),
("Eva", "Green"),
("Emma", "Watson");