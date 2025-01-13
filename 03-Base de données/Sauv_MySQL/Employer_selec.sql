/*
employer selectionner
*/

-- Première partie
-- 1. Donner nom, job, numéro et salaire de tous les employés, puis seulement des employés du département 10
SELECT ENAME, JOB, EMPNO, SAL
FROM EMP;

SELECT DEPTNO, ENAME, JOB, EMPNO, SAL
FROM EMP
WHERE DEPTNO = 10;

-- 2. Donner nom, job et salaire des employés de type MANAGER dont le salaire est supérieur à 2800
SELECT ENAME, JOB, SAL
FROM EMP
WHERE JOB = 'MANAGER' AND SAL > 2800;

-- 3. Donner la liste des MANAGER n'appartenant pas au département 30
SELECT *
FROM EMP
WHERE JOB = 'MANAGER' AND DEPTNO <> 30;

-- 4. Liste des employés de salaire compris entre 1200 et 1400
SELECT ENAME, SAL
FROM EMP
WHERE SAL BETWEEN 1200 AND 1400;

-- 5. Liste des employés des départements 10 et 30 classés dans l'ordre alphabétique
SELECT ENAME, DEPTNO
FROM EMP 
WHERE DEPTNO IN (30, 10)
ORDER BY ENAME;

-- 6. Liste des employés du département 30 classés dans l'ordre des salaires croissants
SELECT ENAME, SAL, DEPTNO
FROM EMP 
WHERE DEPTNO = 30
ORDER BY SAL ASC;

-- 7. Liste de tous les employés classés par emploi et salaires décroissants
SELECT ENAME, JOB, SAL
FROM EMP 
ORDER BY JOB, SAL DESC;

-- 8. Liste des différents emplois
SELECT DISTINCT JOB
FROM EMP; 

-- 9. Donner le nom du département où travaille ALLEN
SELECT DNAME
FROM EMP 
JOIN DEPT ON EMP.DEPTNO = DEPT.DEPTNO
WHERE ENAME = 'ALLEN';

SELECT D.DNAME 
FROM EMP E 
JOIN DEPT D ON E.DEPTNO = D.DEPTNO 
WHERE E.ENAME ='ALLEN';

-- 10. Liste des employés avec nom du département, nom, job, salaire classés par noms de départements et par salaires décroissants.
SELECT ENAME, JOB, SAL, DNAME
FROM;
 
-- 11. Liste des employés vendeurs (SALESMAN) avec affichage de nom, salaire, commissions, salaire + commissions
SELECT ENAME, SAL, COMM, (SAL + COMM) AS 'Salaire Brut Total' 
FROM EMP 
WHERE JOB LIKE 'salesman';

-- 12. Liste des employés du département 20: nom, job, date d'embauche sous forme VEN 28 FEV 1997'
SET lc_time_names = "fr_FR";
SELECT ENAME, JOB, upper(date_format(HIREDATE,"%a %d %b %Y")) AS 'date embauche'
FROM EMP 
WHERE DEPTNO = 20;

-- 13. Donner le salaire le plus élevé par département
-- 14. Donner département par département masse salariale, nombre d'employés, salaire moyen par type d'emploi.
-- 15. Même question mais on se limite aux sous-ensembles d'au moins 2 employés
-- 16. Liste des employés (Nom, département, salaire) de même emploi que JONES
-- 17. Liste des employés (nom, salaire) dont le salaire est supérieur à la moyenne globale des salaires
-- 18. Création d'une table PROJET avec comme colonnes numéro de projet (3 chiffres), nom de projet(5 caractères), budget. Entrez les valeurs suivantes:
/*  
	101, ALPHA,96000
	102, BETA,82000
	103, GAMMA,15000 
    
    */

-- 19. Ajouter l'attribut numéro de projet à la table EMP et affecter tous les vendeurs du département 30 au projet 101, et les autres au projet 102
-- 20. Créer une vue comportant tous les employés avec nom, job, nom de département et nom de projet