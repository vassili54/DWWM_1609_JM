/*
Enoncé 2
*/

-- Création de la table Etudiant 
CREATE TABLE Etudiant (
	idEtudiant int PRIMARY KEY,          -- Identifiant unique pour chaque Etudiant
    nom VARCHAR(50) NOT NULL,            -- Nom obligatoire
    prenom VARCHAR(50) NOT NULL,         -- Prénom obligatoire
    dateEntree date NOT NULL              -- Date d'entrer obligatoire
);

-- Création de la table Matière 
CREATE TABLE Matiere (
	idMatiere int PRIMARY KEY,                    -- Identifiant unique pour chaque matière
    libMatiere VARCHAR(100) NOT NULL UNIQUE,      -- libellé de matière obligatoire et unique
    coefficient INT NOT NULL                      -- Coefficient obligatoire
);

-- Création de la table Contrôle
CREATE TABLE Controle (
	idEtudiant int NOT NULL,                     -- Clé étrangère vers Etudiant
	idMatiere int NOT NULL,                      -- Clé étrangère vers Matiere
    moyenne DECIMAL(5, 2) NOT NULL,              -- Moyenne obligatoire (précision 2 décimales)
    CONSTRAINT fk_etudiant FOREIGN KEY (idEtudiant) REFERENCES Etudiant (idEtudiant), -- Maintien de l'intégrité référentielle
    CONSTRAINT fk_matiere FOREIGN KEY (idMatiere) REFERENCES Matiere (idMatiere)      -- Maintien de l'intégrité référentielle
);