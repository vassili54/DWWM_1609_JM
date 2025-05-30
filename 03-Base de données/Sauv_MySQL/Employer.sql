/*
employer
*/

-- SUPPRIMER LA BASE DE DONNEES SI ELLE EXISTE
DROP DATABASE IF EXISTS employer;

-- CREER UNE BASE DE DONNEES
CREATE DATABASE IF NOT EXISTS employer;

-- Sélectionner la base de données
USE employer;

-- Créer la table du departement
CREATE TABLE DEPT (
	DEPTNO INT PRIMARY KEY,
	DNAME VARCHAR(50) NOT NULL,
	LOC VARCHAR(50) NOT NULL
);

-- Créer la table employer
CREATE TABLE EMP (
	EMPNO INT,
    ENAME VARCHAR(50) NOT NULL,
    JOB VARCHAR(50) NOT NULL,
    MGR INT,
    HIREDATE DATE,
    SAL DECIMAL(10, 2),
    COMM DECIMAL(10, 2),
    DEPTNO INT
);

-- Insérer la liste des employés des départements

INSERT INTO DEPT (DEPTNO, DNAME, LOC) VALUES
(10, 'ACCOUNTING', 'NEW YORK'),
(20,'RESEARCH','DALLAS'),
(30, 'SALES', 'CHICAGO'),
(40, 'OPERATIONS','BOSTON');

-- Insérer la liste des employés

INSERT INTO EMP (EMPNO, ENAME, JOB, MGR, HIREDATE, SAL, COMM, DEPTNO) VALUES
(7369, 'SMITH', 'CLERK', 7902, '1980-12-17', 800, NULL, 20),
(7499, 'ALLEN', 'SALESMAN', 7698, '1981-02-20', 1600, 300, 30),
(7521, 'WARD', 'SALESMAN', 7698, '1981-02-22', 1250, 500, 30),
(7566, 'JONES', 'MANAGER', 7839, '1981-04-02', 2975, NULL, 20),
(7654, 'MARTIN', 'SALESMAN', 7698, '1981-10-28', 1250, 1400, 30),
(7698, 'BLAKE', 'MANAGER', 7839, '1981-05-01', 2850, NULL, 30),
(7782, 'CLARK', 'MANAGER', 7839, '1981-06-09', 2450, NULL, 10),
(7788, 'SCOTT', 'ANALYST', 7566, '1982-12-09', 3000, NULL, 20),
(7839, 'KING', 'PRESIDENT', NULL, '1981-11-17', 5000, NULL, 10),
(7844, 'TURNER', 'SALESMAN', 7698, '1981-09-08', 1500, 0, 30),
(7876, 'ADAMS', 'CLERK', 7788, '1983-01-12', 1100, NULL, 20),
(7900, 'JAMES', 'CLERK', 7698, '1981-12-03', 950, NULL, 30),
(7902, 'FORD', 'ANALYST', 7566, '1981-12-03', 3000, NULL, 20),
(7934, 'MILLER', 'CLERK', 7782, '1982-01-23', 1300, NULL, 10);

ALTER TABLE EMP ADD CONSTRAINT FK_DEPT FOREIGN KEY(DEPTNO) REFERENCES DEPT(DEPTNO);
alter table emp add Constraint PK_emp Primary key (empno);
ALTER TABLE EMP ADD CONSTRAINT FK_EMPNO FOREIGN KEY(MGR) REFERENCES EMP(EMPNO);


