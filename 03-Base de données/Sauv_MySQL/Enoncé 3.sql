/*
Enoncé 3
*/

-- Création de la table Etudiant 
CREATE TABLE Etudiant (
	idEtudiant int PRIMARY KEY,          -- Identifiant unique pour chaque Etudiant
    nom VARCHAR(50) NOT NULL,            -- Nom obligatoire
    prenom VARCHAR(50) NOT NULL,         -- Prénom obligatoire
    dateEntree date NOT NULL             -- Date d'entrer obligatoire avec valeur par défaut = date du jour
);

-- Création de la table Matière 
CREATE TABLE Matiere (
	idMatiere int PRIMARY KEY,                    -- Identifiant unique pour chaque matière
    libMatiere VARCHAR(100) NOT NULL UNIQUE,      -- libellé de matière obligatoire et unique
    coefficient INT NOT NULL CHECK(coefficient < 10)    -- Coefficient entier obligatoire et inférieur à 10
);

-- Création de la table Contrôle
CREATE TABLE Controle (
	idEtudiant int NOT NULL,                     -- Clé étrangère vers Etudiant
	idMatiere int NOT NULL,                      -- Clé étrangère vers Matiere
    date DATE NOT NULL,                          -- Date obligatoire
    moyenne DECIMAL(5, 2) NOT NULL CHECK (moyenne < 20),    -- Moyenne obligatoire avec contrainte (< 20)
    CONSTRAINT fk_etudiant FOREIGN KEY (idEtudiant) REFERENCES Etudiant (idEtudiant),  -- Maintien de l'intégrité référentielle
    CONSTRAINT fk_matiere FOREIGN KEY (idMatiere) REFERENCES Matiere (idMatiere)       -- Maintien de l'intégrité référentielle
);