-- SUPPRIMER LA BASE DE DONNEES SI ELLE EXISTE
DROP DATABASE IF EXISTS Guide;
-- Création de la base de données
CREATE DATABASE IF NOT EXISTS Guide;
-- Selectionner/utiliser la base de données crée 
USE Guide;
-- Création de la table restaurants
CREATE TABLE IF NOT EXISTS restaurants (
	id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    adresse TEXT NOT NULL,
    prix DECIMAL(10,2) NOT NULL,
    Commentaire TEXT,
    Note DECIMAL(3,1) CHECK (Note BETWEEN 0 AND 10),
    visite DATE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    
    INDEX (nom),
    INDEX (prix),
    INDEX (Note),
    INDEX (visite)
);

-- Restaurant Jean-Yves Schillinger
INSERT INTO restaurants (nom, adresse, prix, Commentaire, Note, visite)
VALUES (
    'JEAN-YVES SCHILLINGER',
    '17 Rue de la Poissonnerie, 68000 Colmar',
    50.00,
    'Le JY\'S est un restaurant différent des autres avec un décor cosy et résolument contemporain qui attire une très belle clientèle cosmopolite. Jean-Yves Schillinger est un chef doublement étoilé créatif qui vous entraînera dans une ronde dépaysante à souhait où la cuisine du monde est à l\'honneur. Le chef décline la cuisine fusion à sa façon. Une carte régulièrement renouvelée s\'égaye de créations audacieuses et de plats revisités avec modernité et pertinence.',
   9.0,
    '2019-12-05'
);

-- Restaurant L'Adriatico
INSERT INTO restaurants (nom, adresse, prix, Commentaire, Note, visite)
VALUES (
    'L\'ADRIATICO',
    '6 route de Neuf Brisach, 68000 Colmar, France',
    25.00,
    'Une des meilleures pizzéria de la région. Service très agréable, efficace et souriant. Salle principale un peu bruyante mais cela donne un côté italien. Je recommande.',
    8.0,
    '2020-02-04'
);

-- Afficher tous les restaurants avec leur date de visite
/* SELECT id, nom, prix, Note, DATE_FORMAT(visite, '%d/%m/%Y') AS date_visite 
FROM restaurants 
ORDER BY visite;
*/
-- Résultat attendu :
-- JEAN-YVES SCHILLINGER | 50.00 | 9.0 | 05/12/2019
-- L'ADRIATICO           | 25.00 | 8.0 | 04/02/2020
