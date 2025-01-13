-- 1 Sélectionner tous les utilisateurs (identifiant, nom, prénom, email).
SELECT user_id, user_lastname, user_firstname, user_email 
FROM users;

-- 2 Sélectionner toutes les questions (date, intitulé, réponse, identifiant utilisateur) triées par date de la plus ancienne à la plus récente.
SELECT question_date, question_label, question_response, user_id
FROM questions
ORDER BY question_date ASC;

-- 3 Sélectionner les questions (identifiant, date, intitulé, réponse) de l’utilisateur n°2.
SELECT question_id, question_date, question_label, question_response
FROM questions
WHERE user_id = 2;

-- 4 Sélectionner les questions (date, intitulé, réponse, identifiant utilisateur) de l’utilisateur Eva Satiti.
SELECT question_date, question_label, question_response, questions.user_id
FROM questions
JOIN users ON questions.user_id = users.user_id
WHERE user_firstname = 'Eva' AND user_lastname = 'Satiti';

-- 5 Sélectionner les questions (identifiant, date, intitulé, réponse, identifiant utilisateur) dont l’intitulé contient “SQL”. Le résultat est trié par le titre et par ordre décroissant.
SELECT question_date, question_label, question_response, user_id
FROM questions
WHERE question_label LIKE '%SQL%'
ORDER BY question_label DESC;

-- 6 Sélectionner les catégories (nom, description) sans question associée.

SELECT c.category_name, c.category_description
FROM categories c
LEFT JOIN categories_questions cq ON  c.category_name = cq.category_name
WHERE cq.question_id IS NULL;
-- sous-requêtes
/*
SELECT category_name, category_description
FROM categories
WHERE category_name NOT IN (SELECT category_name FROM categories_questions);
*/
-- 7 Sélectionner les questions triées par titre (ordre alphabétique) avec le nom et prénom de l’auteur (nécessite une jointure).
SELECT q.question_label, q.question_response, u.user_lastname, u.user_firstname
FROM questions q
JOIN users u ON q.user_id = u.user_id
ORDER BY question_label;

-- 8 Sélectionner les catégories (nom) avec, pour chaque catégorie le nombre de questions associées (nécessite une jointure).
SELECT c.category_name, COUNT(cq.question_id) AS 'Nombre de questions associées'
FROM categories c
LEFT JOIN categories_questions cq ON c.category_name = cq.category_name
GROUP BY c.category_name;
/*
SELECT categories.category_name, COUNT(categories_questions.question_id) FROM categories
INNER JOIN categories_questions ON categories.category_name = categories_questions.category_name
GROUP BY categories_questions.category_name;
*/


/*
Explications supplémentaires :
Les tables sont reliées via des clés primaires et étrangères pour respecter les relations spécifiées dans les règles de gestion.
Les requêtes incluent des jointures pour récupérer les informations liées à un utilisateur, une question ou une catégorie.
Les règles de gestion telles que les contraintes d'intégrité référentielle et les ordres de tri sont respectées dans la définition des tables et des requêtes.
Cela permet de réaliser la gestion des questions dans une FAQ avec les utilisateurs, les catégories et leurs relations.
 */
