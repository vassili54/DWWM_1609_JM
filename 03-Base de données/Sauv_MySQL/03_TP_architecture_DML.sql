/* 
Requêtes
*/

--  1. Sélectionner l'identifiant, le nom de tous les clients dont le numéro de téléphone commence par '04'
SELECT client_ref, client_nom, client_telephone
FROM clients
WHERE client_telephone like '04%';

-- 2. Sélectionner l'identifiant, le nom et le type de tous les clients qui sont des particuliers
SELECT clients.client_ref, clients.client_nom, type_clients.type_client_libelle
FROM clients
JOIN type_clients ON clients.type_client_id = type_clients.type_client_id
WHERE type_clients.type_client_libelle = 'Particulier';

SELECT client_ref, client_nom, type_client_libelle
FROM clients
NATURAL JOIN type_clients
WHERE type_client_libelle != 'Particulier';

-- 3. Sélectionner l'identifiant, le nom et le type de tous les clients qui ne sont pas des particuliers
SELECT clients.client_ref, clients.client_nom, type_clients.type_client_libelle
FROM clients
JOIN type_clients ON clients.type_client_id = type_clients.type_client_id
WHERE type_clients.type_client_libelle <> 'Particulier';

-- 4. Sélectionner les projets qui ont été livrés en retard
SELECT *
FROM projets
WHERE projet_date_fin_prevue < projet_date_fin_effective;


-- 5. Sélectionner la date de dépôt, la date de fin prévue, les superficies, 
-- le prix de tous les projets avec le nom du client et le nom de l'architecte associés au projet

SELECT projet_date_depot, projet_date_fin_prevue, projet_superficie_totale, projet_superficie_batie, projet_prix, client_nom, employes.emp_nom, fonctions.fonction_nom
FROM projets 
INNER JOIN clients ON clients.client_ref=projets.client_ref
INNER JOIN employes ON employes.emp_matricule=projets.emp_matricule
INNER JOIN fonctions ON fonctions.fonction_id=employes.fonction_id
WHERE fonctions.fonction_nom="Architecte";


SELECT 
    p.projet_date_depot AS "Date de dépôt",
    p.projet_date_fin_prevue AS "Date de fin prévue",
    p.projet_superficie_totale AS "Superficie totale",
    p.projet_superficie_batie AS "Superficie bâtie",
    p.projet_prix AS "Prix du projet",
    c.client_nom AS "Nom du client",
    CONCAT(e.emp_nom, ' ', e.emp_prenom) AS "Nom de l'architecte"
FROM 
    projets p
JOIN 
    clients c ON p.client_ref = c.client_ref
JOIN 
    employes e ON p.emp_matricule = e.emp_matricule
WHERE 
    e.fonction_id = 1; -- Seuls les employés avec la fonction "Architecte"


-- 6. Sélectionner tous les projets (dates, superficies, prix) avec le nombre d'intervenants autres que le client et l'architecte 

SELECT 
    p.projet_ref,
    p.projet_date_depot,
    p.projet_date_fin_prevue,
    p.projet_date_fin_effective,
    p.projet_superficie_totale,
    p.projet_superficie_batie,
    p.projet_prix,
    COUNT(pa.emp_matricule) AS nombre_intervenants
FROM 
    projets p
LEFT JOIN 
    participer pa ON p.projet_ref = pa.projet_ref
LEFT JOIN 
    employes e ON pa.emp_matricule = e.emp_matricule
LEFT JOIN 
    fonctions f ON e.fonction_id = f.fonction_id
WHERE 
    f.fonction_nom != 'Architecte'
GROUP BY 
    p.projet_ref;


-- 7. Sélectionner les types de projets avec, pour chacun d'entre eux, le nombre de projets associés et le prix moyen pratiqué
SELECT tp.type_projet_libelle, COUNT(p.projet_ref) AS nombre_projets, AVG(p.projet_prix) AS prix_moyen
FROM projets p
JOIN type_projets tp ON p.type_projet_id = tp.type_projet_id
GROUP BY tp.type_projet_libelle;

SELECT tp.type_projet_libelle AS "Type de projet", COUNT(p.projet_ref) AS "Nombre de projets", AVG(p.projet_prix) AS "Prix moyen"
FROM type_projets tp
LEFT JOIN projets p ON tp.type_projet_id = p.type_projet_id
GROUP BY tp.type_projet_libelle;

 SELECT tp.type_projet_libelle AS "Type de projet", COUNT(p.projet_ref) AS "Nombre de projets", IFNULL(AVG(p.projet_prix), 0) AS "Prix moyen"
FROM type_projets tp
LEFT JOIN projets p ON tp.type_projet_id = p.type_projet_id
GROUP BY tp.type_projet_libelle;
 

-- 8. Sélectionner les types de travaux avec, pour chacun d'entre eux, la superficie du projet la plus grande
SELECT tt.type_travaux_libelle, MAX(p.projet_superficie_totale) AS superficie_max
FROM projets p
JOIN type_travaux tt ON p.type_travaux_id = tt.type_travaux_id
GROUP BY tt.type_travaux_libelle;

-- ou

SELECT tt.type_travaux_libelle, IFNULL(MAX(p.projet_superficie_totale), 0) AS superficie_max
FROM type_travaux tt
LEFT JOIN projets p ON tt.type_travaux_id = p.type_travaux_id
GROUP BY tt.type_travaux_libelle;


-- 9. Sélectionner l'ensembles des projets (dates, prix) avec les informations du client (nom, telephone, adresse), le type de travaux et le type de projet. 
SELECT
    p.projet_ref AS "Référence Projet",
    p.projet_date_depot AS "Date de dépôt",
    p.projet_date_fin_prevue AS "Date de fin prévue",
    p.projet_date_fin_effective AS "Date de fin effective",
    p.projet_prix AS "Prix du projet",
    c.client_nom AS "Nom du client",
    c.client_telephone AS "Téléphone du client",
    concat(a.adresse_num_voie, '',a.adresse_voie, ',', a.adresse_code_postal,'', a.adresse_ville) AS "Adresse du client",
    tt.type_travaux_libelle AS "Type de travaux",
    tp.type_projet_libelle AS "Type de projet"
FROM projets p 
JOIN clients c on P.client_ref = c.client_ref
JOIN adresses a ON c.adresse_id = a.adresse_id
JOIN type_travaux tt ON p.type_travaux_id = tt.type_travaux_id
JOIN type_projets tp ON p.type_projet_id = tp.type_projet_id;
    
    
/* 10. Sélectionner les projets dont l'adresse est identique au client associé */
/* 1 Sélectionner les projets avec leurs adresses
-- 2 Sélectionner les clients avec leurs adresses
-- 3 jointures et comparer les adresses de clients et projets*/
SELECT projet_ref, adresse_ville,client_ref, adresse_ville
FROM projets
JOIN adresses
ON projets.adresse_id = adresses.adresse_id;

SELECT client_ref, adresse_ville
FROM clients
JOIN adresses
ON clients.adresse_id = adresses.adresse_id;