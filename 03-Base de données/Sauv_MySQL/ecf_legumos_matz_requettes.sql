/*
ecf_legumos_matz_requettes
*/


-- 1) Sélectionner toutes les info des légumes triés par nom du légume (ordre alphabétique)
SELECT id, name, variety, primaryColor, lifeTime, fresh
FROM vegetables
ORDER BY name ASC;

-- 2) Sélectionner les nom et les prix.

SELECT name, saleUnitPrice;

-- Pour chaque varieté de légumes, afficher le nombre de ventes ainsi que le poids total vendu.Les legumes sont triés par nombre de ventes.

/* 
SELECT variety, 

*/

-- 3) Sélectionner le nom ....

/*
SELECT name, variety, primaryColor, saleUnitPrice
FROM vegetables
JOIN sales ON 
*/
 
-- 4)  A) Son nom
SELECT name
FROM vegetables;

-- B) 

SELECT variety
FROM vegetables;

-- D) 
SELECT variety
FROM vegetables;

