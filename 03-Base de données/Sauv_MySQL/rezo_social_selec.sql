/*REQUETES SQL A IMPLENTER  */
SELECT * FROM utilisateur;
SELECT * FROM publication;
SELECT * FROM aimer;

-- Sélectionner tous les utilisateurs (nom d'utilisateur + email)
SELECT nom_utilisateur, email 
FROM utilisateur;

-- Sélectionner toutes les publications triées par date de la plus récente à la plus ancienne
SELECT pub_titre, pub_date, pub_contenu, id 
FROM publication 
ORDER BY pub_date 
DESC;

-- Sélectionner les publications de l'utilisateur N°2
SELECT pub_id, pub_date, pub_titre 
FROM publication 
WHERE id = 2;

-- Sélectionner les publications dont le titre contient la lettre 'a'
SELECT pub_id, pub_titre, pub_contenu 
FROM publication
WHERE pub_titre like "%a%"
ORDER BY pub_titre DESC;

-- Sélectionner les utilisateurs (id, nom, email) dont l'adresse email se termine par "com".
SELECT id, nom_utilisateur, email
FROM utilisateur 
WHERE email LIKE "%com"; -- Le joker % représente n'importe quelle séquence de caractères avant le com.

-- Sélectionner les publications triées par titre (ordre alphabétique) avec le nom d'utilisateur de l'auteur (nécessite une jointure).
SELECT publication.pub_id, publication.pub_titre, publication.pub_date, publication.pub_contenu, utilisateur.nom_utilisateur
FROM publication
INNER JOIN utilisateur ON publication.id = utilisateur.id
ORDER BY publication.pub_titre ASC;

/* 
Explications :
 1.Jointure (INNER JOIN) :
  . On lie la table publication et utilisateur via la clé étrangère id (auteur de la publication).
  . Cela permet de récupérer les informations de l'auteur (nom d'utilisateur) associées à chaque publication.

 2.Sélection des colonnes :
  . Les colonnes sélectionnées sont :
  . Identifiant de la publication (pub_id),
  . Titre de la publication (pub_titre),
  . Date de la publication (pub_date),
  . Contenu de la publication (pub_contenu),
  . Nom d'utilisateur de l'auteur (nom_utilisateur).

 3.Tri (ORDER BY) :
   . Les résultats sont triés par titre (pub_titre) dans l'ordre alphabétique croissant (ASC).
   /* 


