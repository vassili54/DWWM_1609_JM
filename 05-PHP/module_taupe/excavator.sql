--  la base de données « excavator »

DROP DATABASE IF EXISTS  excavator;
CREATE DATABASE IF NOT EXISTS  excavator;
USE  excavator;

CREATE TABLE IF NOT EXISTS SCIENTISTS (
id_scientist int UNSIGNED NOT NULL AUTO_INCREMENT,
lastname_scientist varchar(100) NOT NULL,
firstname_scientist varchar(50) NOT NULL,
mail_scientist varchar(150) NOT NULL,
pass_scientist varchar(255) NOT NULL,
level smallint NOT NULL,
CONSTRAINT PK_SCIENTISTS PRIMARY KEY (id_scientist)
) ENGINE=InnoDB;

INSERT INTO SCIENTISTS (lastname_scientist, firstname_scientist, mail_scientist, pass_scientist, level) VALUES
('MORTINER', 'Philip', 'p.mortimer@mifivesec.eu', 'Espadon25', 2),
('BLAKE', 'Francis', 'f.blake@mifivesec.eu', 'Chateau46', 1 );
UPDATE scientists SET pass_scientist = '$argon2id$v=19$m=65536,t=4,p=2$MUx4TjlQZlNnRjdYbllubQ$C2zeC3gZNncQZiPgakjEsUnhPiQLn33q8SZRe24bnZQ' WHERE mail_scientist = 'p.mortimer@mifivesec.eu';
UPDATE scientists SET pass_scientist = '$argon2id$v=19$m=65536,t=4,p=2$V1FXMG0uc0d0N2paQjFabw$e00VrnqPwv/fg43nHBHs8tgJc6Rq2v17/rSYjQ+GabQ' WHERE mail_scientist = 'f.blake@mifivesec.eu';

-- Vérifiez les hashs mis à jour
SELECT mail_scientist, LEFT(pass_scientist, 30) as hash_prefix FROM scientists;

-- Vérifiez les hashs après mise à jour
SELECT id_scientist, mail_scientist, LEFT(pass_scientist, 30) AS hash_prefix, LENGTH(pass_scientist) AS hash_length FROM scientists;
