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
FROM EMP
JOIN DEPT ON EMP.DEPTNO = DEPT.DEPTNO 
ORDER BY JOB, SAL DESC;

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
SELECT D.DNAME, MAX(E.SAL) AS SALAIRE_MAX
FROM DEPT D
JOIN EMP E ON D.DEPTNO = E.DEPTNO
GROUP BY D.DNAME;


-- 14. Donner département par département masse salariale, nombre d'employés, salaire moyen par type d'emploi.
SELECT D.DNAME AS DEPARTEMENT, E.JOB AS TYPE_EMPLOI, COUNT(E.EMPNO) AS NOMBRE_EMPLOYES, SUM(E.SAL) AS MASSE_SALARIALE, AVG(E.SAL) AS SALAIRE_MOYEN
FROM DEPT D
JOIN EMP E ON D.DEPTNO = E.DEPTNO
GROUP BY D.DNAME, E.JOB
ORDER BY D.DNAME, E.JOB;

-- 15. Même question mais on se limite aux sous-ensembles d'au moins 2 employés
SELECT D.DNAME AS DEPARTEMENT, E.JOB AS TYPE_EMPLOI, COUNT(E.EMPNO) AS NOMBRE_EMPLOYES, SUM(E.SAL) AS MASSE_SALARIALE, AVG(E.SAL) AS SALAIRE_MOYEN
FROM DEPT D
JOIN EMP E ON D.DEPTNO = E.DEPTNO
GROUP BY D.DNAME, E.JOB
HAVING COUNT(E.EMPNO) >= 2
ORDER BY D.DNAME, E.JOB;

-- 16. Liste des employés (Nom, département, salaire) de même emploi que JONES
SELECT E.ENAME AS NOM_EMPLOYE, D.DNAME AS DEPARTEMENT, E.SAL AS SALAIRE
FROM EMP E
JOIN DEPT D ON D.DEPTNO = E.DEPTNO
WHERE E.JOB = (SELECT JOB FROM EMP WHERE ENAME = 'JONES')
ORDER BY E.ENAME;

-- 17. Liste des employés (nom, salaire) dont le salaire est supérieur à la moyenne globale des salaires
SELECT E.ENAME AS NOM_EMPLOYE, E.SAL AS SALAIRE
FROM EMP E 
WHERE E.SAL > (SELECT AVG(SAL) FROM EMP)
ORDER BY E.SAL DESC;

/*
 18. Création d'une table PROJET avec comme colonnes numéro de projet (3 chiffres), nom de projet(5 caractères), budget. Entrez les valeurs suivantes:
 
	101, ALPHA,96000
	102, BETA,82000
	103, GAMMA,15000 
 */   

CREATE TABLE projet (
num_proj SMALLINT AUTO_INCREMENT,
nom_proj CHAR(5) NOT NULL,
budjet_proj DECIMAL(8,2) NOT NULL, CONSTRAINT PK_projet PRIMARY KEY(num_proj)
);

 ALTER TABLE projet AUTO_INCREMENT = 101;

INSERT INTO projet (nom_proj, budjet_proj) VALUES
('alpha',96000),
('beta',82000),
('gamma',15000);

ALTER TABLE projet RENAME COLUMN budjet_proj TO budget_proj;

ALTER TABLE EMP ADD num_proj SMALLINT;

UPDATE emp 
SET num_proj = 101
WHERE deptno = 30 AND job = 'salesman';
    
    
-- 19. Ajouter l'attribut numéro de projet à la table EMP et affecter tous les vendeurs du département 30 au projet 101, et les autres au projet 102
-- Ajouter la colonne num_proj à la table EMP
ALTER TABLE EMP ADD num_proj SMALLINT;
-- Affecter tous les vendeurs du département 30 au projet 101
UPDATE EMP
SET num_proj = 101
WHERE DEPTNO = 30 AND JOB = 'SALESMAN';
-- Affecter tous les autres employés (non vendeurs du département 30) au projet 102
UPDATE EMP
SET num_proj = 102
WHERE NOT (DEPTNO = 30 AND JOB = 'SALESMAN');


-- 20. Créer une vue comportant tous les employés avec nom, job, nom de département et nom de projet
CREATE VIEW vue_employes_projet AS SELECT E.ENAME AS NOM_EMPLOYE, E.JOB AS POSTE_EMPLOYE, D.DNAME AS MON_DEPARTEMENT, P.NOM_PROJ AS NOM_PROJET
FROM EMP E 
JOIN DEPT D ON E.DEPTNO = D.DEPTNO
LEFT JOIN PROJET P ON E.NUM_PROJ = P.NUM_PROJ;

-- 21. A l'aide de la vue créée précédemment, lister tous les employés avec nom, job, nom de département et nom de projet triés sur nom de département et nom de projet
SELECT NOM_EMPLOYE, POSTE_EMPLOYE, MON_DEPARTEMENT, NOM_PROJET
FROM vue_employes_projet
ORDER BY MON_DEPARTEMENT, NOM_PROJET;

-- 22. Donner le nom du projet associé à chaque manager
SELECT M.ENAME AS MANAGER_NAME, P.NOM_PROJ AS PROJECT_NAME, P.BUDGET_PROJ AS PROJECT_BUDGET
FROM EMP M
JOIN PROJET P ON M.NUM_PROJ = P.NUM_PROJ
WHERE M.JOB = 'MANAGER';



-- Deuxième partie

-- 1. Afficher la liste des managers des départements 20 et 30
SELECT E.ENAME AS NOM_MANAGER, E.JOB AS POSTE, D.DNAME AS DEPARTEMENT
FROM EMP E 
JOIN DEPT D ON D.DEPTNO = D.DEPTNO
WHERE E.JOB = 'MANAGER' AND (D.DEPTNO = 20 OR D.DEPTNO = 30);

-- 2. Afficher la liste des employés qui ne sont pas manager et qui ont été embauchés en 81
SELECT ENAME, JOB, HIREDATE
FROM EMP
WHERE JOB != 'manager' AND year(HIREDATE) =1981;

-- 3. Afficher la liste des employés ayant une commission
SELECT ENAME, JOB, COMM
FROM EMP 
WHERE COMM IS NOT NULL;

-- 4. Afficher la liste des noms, numéros de département, jobs et date d'embauche triés par Numero de Département et JOB les derniers embauches d'abord.
SELECT ENAME, DEPTNO, JOB, HIREDATE
FROM EMP 
ORDER BY DEPTNO, JOB, HIREDATE DESC;

-- 5. Afficher la liste des employés travaillant à DALLAS
SELECT E.ENAME, E.DEPTNO, D.LOC
FROM EMP E
JOIN  DEPT D ON D.DEPTNO = E.DEPTNO
WHERE D.LOC sounds like 'DALASs';


-- 6. Afficher les noms et dates d'embauche des employés embauchés avant leur manager, avec le nom et date d'embauche du manager.
SELECT E.ENAME AS employee_name, E.HIREDATE AS employee_hire_date, M.ENAME AS manager_name, M.HIREDATE AS manager_hire_date
FROM EMP E 
JOIN EMP M ON E.MGR = M.EMPNO
WHERE E.HIREDATE < M.HIREDATE;

-- 7. Lister les numéros des employés n'ayant pas de subordonné.
SELECT EMPNO, JOB
FROM EMP 
WHERE EMPNO NOT IN 
(SELECT DISTINCT MGR
FROM EMP
WHERE MGR IS NOT NULL);



-- 8. Afficher les noms et dates d'embauche des employés embauchés avant BLAKE.
SELECT ENAME, HIREDATE, ( SELECT HIREDATE 
FROM EMP 
WHERE ENAME = 'BLAKE') as "embauche blake"
FROM EMP 
WHERE HIREDATE < 
(SELECT HIREDATE 
FROM EMP 
WHERE ENAME sounds like 'BLAc');

-- 9. Afficher les employés embauchés le même jour que FORD.
SELECT ENAME, HIREDATE
FROM EMP 
WHERE HIREDATE =
(SELECT HIREDATE
FROM EMP 
WHERE ENAME = 'FORD');

-- 10. Lister les employés ayant le même manager que CLARK. 
SELECT EMPNO, ENAME, JOB, MGR
FROM EMP 
WHERE MGR = (SELECT MGR FROM EMP WHERE ENAME = 'CLARK');


SELECT E1.EMPNO, E1.ENAME, E1.JOB, E1.MGR 
FROM EMP E1
JOIN EMP E2 ON E1.MGR = E2.MGR
WHERE E2.ENAME = 'CLARK';

-- 11. Lister les employés ayant même job et même manager que TURNER.






-- 12. Lister les employés du département RESEARCH embauchés le même jour que quelqu'un du département SALES.

-- 13. Lister le nom des employés et également le nom du jour de la semaine correspondant à leur dated'embauche.

-- 14. Donner, pour chaque employé, le nombre de mois qui s'est écoulé entre leur date d'embauche et ladate actuelle.



-- 15. Afficher la liste des employés ayant un M et un A dans leur nom.
SELECT *
FROM EMP 
WHERE ENAME LIKE "%M%A%"  OR ename like "%A%M%";

-- 16. Afficher la liste des employés ayant deux 'A' dans leur nom.
SELECT *
FROM emp
WHERE ENAME LIKE "%A%A%";

/*

17. Afficher les employés embauchés avant tous les employés du département 10.
18. Sélectionner le métier où le salaire moyen est le plus faible.
19. Sélectionner le département ayant le plus d'employés.
20. Donner la répartition en pourcentage du nombre d'employés par département selon le modèle ci-dessous
Département Répartition en % 
----------- ---------------- 
10          21.43 
20          35.71 
30          42.86

Quelques Fonctions SQL Server
CONVERT: Effectue des conversion de types de données. Permet notamment le formatage de dates
SUBSTRING: Extrait une partie d'une chaîne de caractères
DATENAME, DATEDIFF …: Permet la manipulation de date
*/