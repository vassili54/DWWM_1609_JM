/* CREER UN UTILISATEUR */
CREATE USER 'vassili'@'localhost' IDENTIFIED BY '1234';

/* Accorder Tous les PRIVILEGES à Toto sur la base de données rezo_social */
GRANT ALL PRIVILEGES ON rezo_social.* TO 'vassili'@'localhost';

/* RECHARGER LES PRIVILEGES au niveau du serveur */
FLUSH PRIVILEGES;