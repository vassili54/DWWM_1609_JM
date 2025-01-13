/*
TP1_Sql
*/
CREATE TABLE projet (
num_proj SMALLINT AUTO_INCREMENT,
nom_proj CHAR(5) NOT NULL,
budjet_proj DECIMAL(8,2) NOT NULL, CONSTRAINT PK_projet PRIMARY KEY(num_proj)
);

 ALTER TABLE projet AUTO_INCREMENT = 101;

INSERT INTO projet 
(nom_proj, budjet_proj)
VALUES
('alpha',96000),
('beta',82000),
('gamma',15000);

ALTER TABLE projet RENAME COLUMN budjet_proj TO budget_proj;

ALTER TABLE EMP ADD num_proj SMALLINT;

UPDATE emp SET num_proj = 101
WHERE deptno = 30 AND job = 'salesman';