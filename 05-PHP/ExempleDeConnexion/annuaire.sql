-- CREATE DATABASE annuaire
USE annuaire;
CREATE TABLE `CARNET` (
`ID` int UNSIGNED NOT NULL AUTO_INCREMENT,
`NOM` varchar(50) DEFAULT NULL,
`PRENOM` varchar(50) DEFAULT NULL,
`NAISSANCE` date DEFAULT NULL,
`VILLE` varchar(30) DEFAULT NULL,
PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=UTF8;
INSERT INTO `CARNET` VALUES
(ID,'SMITH','JOHN','1980-12-17','ORLEANS'),
(ID,'DURAND','JEAN','1983-01-13','ORLEANS'),
(ID,'GUDULE','JEANNE','1967-11-06','TOURS'),
(ID,'ZAPATA','EMILIO','1956-12-01','ORLEANS'),
(ID,'JOURDAIN','NICOLAS','2000-09-10','TOURS'),
(ID,'DUPUY','MARIE','1986-01-11','BLOIS'),
(ID,'ANDREAS','LOU','1861-02-12','ST Petersbourg'),
(ID,'Kafka','Franz','1883-07-03','Prague'),
(ID,'Dalton','Joe','2003-12-06','Dallas');