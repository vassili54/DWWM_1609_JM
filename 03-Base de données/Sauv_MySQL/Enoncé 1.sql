/*
Enoncé 1
*/

-- Création de la table Personne
CREATE TABLE Personne (
	idPersonne INT PRIMARY KEY,          -- Identifiant unique pour chaque personne
    nom VARCHAR(50) NOT NULL,            -- Nom obligatoire
    prenom VARCHAR(50) NOT NULL,         -- Prénom obligatoire
    numRue INT NOT NULL,                 -- Numéro de rue obligatoire
    rue VARCHAR(100) NOT NULL,           -- Nom de la rue obligatoire
    cp INT NOT NULL CHECK (cp <96000),   -- Code postal obligatoire avec contrainte (< 96000)
    ville VARCHAR(50) NOT NULL			 -- Ville obligatoire
);

-- Création de la table Vehicule
CREATE TABLE Vehicule (
	immatriculation VARCHAR(20) PRIMARY KEY,   -- Identifiant unique pour chaque véhicule
    marque VARCHAR(50) NOT NULL,			   -- Marque obligatoire
	kilometrage INT NOT NULL,				   -- Kilométrage obligatoire	
    dateMiseEnService DATE NOT NULL,           -- Date de mise en service obligatoire
    idPersonne INT NOT NULL,                   -- Clé étrangère obligatoire
    CONSTRAINT fk_personne FOREIGN KEY (idPersonne) REFERENCES Personne (idPersonne) 
											   -- Maintien de l'intégrité référentielle
);