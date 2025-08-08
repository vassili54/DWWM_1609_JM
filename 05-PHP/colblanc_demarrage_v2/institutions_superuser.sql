-- Code exemple SQL pour créer un utilisateur qui a tous les droits sur une base de données exemple "institutions" unique  :
USE institutions;
CREATE USER 'superuser'@'localhost' IDENTIFIED BY 'Findumonde';
GRANT ALL PRIVILEGES ON institutions.* TO 'superuser'@'localhost';
-- Recharger les privilèges pour qu'ils soient pris en compte immédiatement
FLUSH PRIVILEGES; 