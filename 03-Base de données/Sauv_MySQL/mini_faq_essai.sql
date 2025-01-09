/* Jeu d'essai */

-- Sélectionnner la base de données
USE mini_faq;

-- Insérer des utilisateurs
INSERT INTO users (user_lastname, user_firstname, user_email) VALUES
('Rabbit', 'Zora', 'zorb@example.com'),
('Patchouli', 'Édouard', 'patchouli@example.fr'),
('Satiti', 'Eva', 'eva.stt@example.com');

-- Insérer les Catégories
INSERT INTO categories (category_name, category_description, category_order) VALUES
('Bases de données', 'Les questions relatives aux bases de données', 2),
('SQL', 'Les questions sur le langage SQL', 3),
('NoSQL', 'Les questions sur l’approche NoSQL', 4),
('PHP', 'Les questions relatives à PHP', 1);

-- Insérer des questions
INSERT INTO questions (question_date, question_label, question_response, user_id) VALUES
('2024-11-23', 'Dans MySQL, quel type de données permet de stocker des valeurs numériques dont le maximum est 127 ?', 'Le type TINYINT stocke des valeurs numériques comprises entre -128 et 127', 3),
('2024-11-23', 'Quels sont les principaux serveurs SQL gratuits ?', 'MySQL, MariaDB, PostgreSQL, SQLite', 2),
('2024-11-27', 'Que signifie le sigle SGBDR ?', 'Système de Gestion de Bases de Données Relationnelles', 1),
('2024-12-05', 'Que signifie le sigle SQL ?', 'Structured Query Language !', 2),
('2024-12-05', 'Que signifie le sigle noSQL ?', 'Not Only SQL !', 3);

-- Associer les questions aux catégories
INSERT INTO categories_questions (question_id, category_name) VALUES
(1, 'Bases de données'),
(1, 'SQL'),
(2, 'Bases de données'),
(2, 'SQL'),
(3, 'Bases de données'),
(4, 'Bases de données'),
(4, 'SQL'),
(5, 'Bases de données'),
(5, 'NoSQL');

/*
Questions –> Catégories

La question n°1 appartient aux catégories : Bases de données et SQL
La question n°2 appartient aux catégories : Bases de données et SQL
La question n°3 appartient à la catégorie : Bases de données
La question n°4 appartient aux catégories : Bases de données et SQL
La question n°5 appartient aux catégories : Bases de données et NoSQL
*/