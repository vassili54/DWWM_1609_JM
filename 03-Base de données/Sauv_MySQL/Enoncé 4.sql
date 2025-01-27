/*
Enoncé 4
*/

-- Création de la table Livre
CREATE TABLE Livre (
	ISBN CHAR(13) PRIMARY KEY,                 -- ISBN unique, 13 caractères
    titre VARCHAR(255) NOT NULL                -- Titre obligatoire
);

-- Création de la table Exemplaire
CREATE TABLE Exemplaire (
	ISBN CHAR(13) NOT NULL,                    -- ISBN obligatoire (référence au livre)
    numExemplaire INT NOT NULL,                -- Numéro de l'exemplaire obligatoire
    etat CHAR(1) NOT NULL DEFAULT 'D',         -- Etat de l'exemplaire : D (par défaut), E, ou P
    PRIMARY KEY (ISBN, numExemplaire),         -- Clé primaire composée
    FOREIGN KEY (ISBN) REFERENCES Livre(ISBN)  -- Clé étrangère vers Livre
);