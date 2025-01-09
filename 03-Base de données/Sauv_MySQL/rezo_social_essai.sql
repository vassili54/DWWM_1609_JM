/* Jeu d'essai */

-- Sélectionnner la base de données
USE rezo_social;

-- DELETE FROM utilisateur; -- suprime toutes les données de la table utilisateur
TRUNCATE TABLE aimer; -- vider la table aimer
TRUNCATE TABLE publication; -- vider la table publication et réinitialise l'auto_increment
TRUNCATE TABLE utilisateur; -- vider la table utilisateur et réinitialise l'auto_increment

/* Insertion des données dans la  table "Utilisateur" */

INSERT INTO utilisateur
(id, nom_utilisateur, email)
VALUES  
(1,'Zorro', 'zorb@example.com'),
(2, 'Patchouli', 'patchouli@example.fr'),
(3, 'Eva', 'eva.stt@example.com');

/* Insertion des données dans la  table "publication" */
INSERT INTO publication
(pub_date, pub_titre, pub_contenu, id)
VALUES
('2024-11-23 14:30', 'Il fait beau', 'Quel beau soleil aujourd\'hui !', '3'),
('2024-11-23 09:15', 'Les bonbons', 'Les bonbons, c’est bon', '2'),
('2024-11-27 08:17', 'Super resto', 'J’ai découvert un super restaurant hier soir.', '1'),
('2024-12-05 17:52', 'Album disponible', 'Nouvel album de mon groupe préféré !', '2'),
('2024-12-15 10:05', 'Aidez-moi', 'Je cherche une recette de gâteau au chocolat.', '3');

INSERT INTO aimer
(id, pub_id)
VALUES
(1, 5),
(2, 4),
(3, 3),
(2, 2),
(1, 1);