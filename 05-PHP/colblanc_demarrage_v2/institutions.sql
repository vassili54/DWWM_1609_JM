DROP DATABASE IF EXISTS institutions;
CREATE DATABASE IF NOT EXISTS institutions;
USE institutions;

CREATE TABLE IF NOT EXISTS `institutions` (
  `identifiant` int(20) unsigned NOT NULL AUTO_INCREMENT,
  `nom_resp` varchar(100) DEFAULT NULL,
  `nom_etab` varchar(100) NOT NULL,
  `type_etab` varchar(100) NOT NULL,
  `nom_tut` varchar(100) DEFAULT NULL,
  `adresse` varchar(100) DEFAULT NULL,
  `cp` varchar(5) DEFAULT NULL,
  `ville` varchar(60) DEFAULT NULL,
  `depart` int(5) unsigned DEFAULT NULL,
  `Telephone` varchar(20) NOT NULL,
  `Fax` varchar(20) DEFAULT NULL,
  `email` varchar(60) DEFAULT NULL,
  `service` varchar(100) DEFAULT NULL,
  `desc` text,
  `mobile` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`identifiant`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=67 ;

--
-- Contenu de la table `institutions`
--
INSERT INTO `institutions` (
    `nom_resp`, `nom_etab`, `type_etab`, `nom_tut`, `adresse`, `cp`, `ville`,
    `depart`, `Telephone`, `Fax`, `email`, `service`, `desc`, `mobile`
) VALUES
('M. Leclerc', 'Préfecture de Paris', 'Autres (secteur public)', 'État Français', '1 Rue de la Cité', '75004', 'Paris', 75, '0140234567', '0140234568', 'contact@pref75.fr', 'Services administratifs', 'Organisme de l''administration publique.', NULL),
('Mme. Dubois', 'Mairie de Lyon', 'Autres (secteur public)', 'Commune de Lyon', '20 Place des Terreaux', '69001', 'Lyon', 69, '0478678900', '0478678901', 'info@mairie-lyon.fr', 'État civil, urbanisme', 'Administration municipale de la ville de Lyon.', NULL),
('M. Giraud', 'Office de Tourisme de Nice', 'Autres (secteur public)', 'Ville de Nice', '5 Promenade des Anglais', '06000', 'Nice', 06, '0492144242', NULL, 'info@nicetourisme.com', 'Informations touristiques', 'Service public d''information et de promotion du tourisme.', NULL),
('Mme. Fournier', 'Association Sportive Olympique', 'association', NULL, '10 Avenue du Sport', '13008', 'Marseille', 13, '0491234567', NULL, 'aso@email.com', 'Activités sportives', 'Club omnisports pour tous âges.', '0612345679'),
('M. Bernard', 'Les Amis de la Culture', 'association', NULL, '5 Rue des Arts', '33000', 'Bordeaux', 33, '0556789012', NULL, 'culture@asso.fr', 'Événements culturels', 'Promotion de l''art et de la culture locale.', '0623456789'),
('Mme. Sanchez', 'Association de Quartier Solidaire', 'association', NULL, '12 Rue de la Fraternité', '35000', 'Rennes', 35, '0299554433', NULL, 'contact@aqs.org', 'Aide sociale, Événements locaux', 'Soutien et animation de la vie de quartier.', '0610203040'),
('M. Laurent', 'Conseil Régional Hauts-de-France', 'collectivite ter', 'Région Hauts-de-France', '15 Boulevard de la Liberté', '59000', 'Lille', 59, '0320123456', '0320123457', 'contact@hautsdefrance.fr', 'Développement régional', 'Instance de décision de la région Hauts-de-France.', NULL),
('Mme. Petitjean', 'Conseil Départemental de Loire-Atlantique', 'collectivite ter', 'Département Loire-Atlantique', '3 Rue du Calvaire', '44000', 'Nantes', 44, '0240998877', '0240998878', 'info@loire-atlantique.fr', 'Action sociale, routes', 'Gestion des affaires départementales.', NULL),
('M. Dupont', 'Mairie de Toulouse', 'collectivite ter', 'Ville de Toulouse', '1 Place du Capitole', '31000', 'Toulouse', 31, '0561223456', '0561223457', 'contact@mairie-toulouse.fr', 'Services municipaux', 'Administration de la commune de Toulouse.', NULL),
('M. Robert', 'Innovatech Solutions', 'grande entreprise', NULL, 'Tech Park, Allée des Lumières', '31000', 'Toulouse', 31, '0561234567', '0561234568', 'hr@innovatech.fr', 'Développement logiciel, IA', 'Leader mondial dans les solutions logicielles innovantes.', '0634567890'),
('Mme. Lefevre', 'Global Manufacturing Co.', 'grande entreprise', NULL, 'Zone Industrielle Ouest', '67000', 'Strasbourg', 67, '0388765432', '0388765433', 'contact@globalmfg.com', 'Production, Logistique', 'Fabricant international de composants électroniques.', NULL),
('M. Dubois', 'PharmaCorp France', 'grande entreprise', NULL, 'Parc d''Activités Santé', '69007', 'Lyon', 69, '0472334455', '0472334456', 'info@pharmacorpf.com', 'Recherche & Développement, Production', 'Géant pharmaceutique spécialisé en biotechnologies.', NULL),
('Mme. Durand', 'Agence Créative Studio', 'PME', NULL, '8 Rue de l''Imagination', '06000', 'Nice', 06, '0493876543', NULL, 'info@creativestudio.fr', 'Marketing digital, Design graphique', 'Petite et Moyenne Entreprise spécialisée dans la communication visuelle.', '0645678901'),
('M. Garcia', 'Bureau d''Études Innovantes', 'PME', NULL, '22 Boulevard des Idées', '35000', 'Rennes', 35, '0299112233', '0299112234', 'contact@bei.fr', 'Ingénierie, Conseil technique', 'PME offrant des services d''ingénierie et de conseil.', NULL),
('M. Leclercq', 'Cabinet Comptable Experts', 'PME', NULL, '2 Avenue des Finances', '13001', 'Marseille', 13, '0491112233', '0491112234', 'contact@cabinetexperts.fr', 'Comptabilité, Fiscalité', 'Cabinet d''expertise comptable pour PME et artisans.', NULL),
('Mme. Lefort', 'La Boulangerie du Coin', 'TPE', NULL, '7 Rue du Pain', '63000', 'Clermont-Ferrand', 63, '0473210987', NULL, 'boulangerie.coin@email.com', 'Boulangerie, Pâtisserie', 'Très petite entreprise artisanale de boulangerie.', NULL),
('M. Schmidt', 'Salon de Coiffure Beauté', 'TPE', NULL, '3 Avenue de la Coiffure', '87000', 'Limoges', 87, '0555667788', NULL, 'salonbeaute@email.com', 'Coiffure, Soins capillaires', 'Salon de coiffure indépendant pour hommes et femmes.', '0655443322'),
('Mme. Martin', 'Fleurs & Créations', 'TPE', NULL, '18 Place du Marché', '33000', 'Bordeaux', 33, '0557890123', NULL, 'fleursetcreations@email.com', 'Vente de fleurs, Compositions', 'Artisan fleuriste, création de bouquets personnalisés.', NULL);


-- Structure de la table `departements`
--

CREATE TABLE `departements` (
  `id_dep` int(10) UNSIGNED NOT NULL,
  `dep_name` varchar(50) NOT NULL,
  `dep_actif` int(10) UNSIGNED NOT NULL,
  `dep_taux` decimal(5,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Departements';

--
-- chargement des données de la table `departements`
--

INSERT INTO `departements` (`id_dep`, `dep_name`, `dep_actif`, `dep_taux`) VALUES
(1, '01 - Ain', 1, 1.00),
(2, '02 - Aisne', 1, 1.00),
(3, '03 - Allier', 1, 1.00),
(4, '04 - Alpes-de-Haute-Provence', 1, 1.00),
(5, '05 - Hautes-Alpes', 1, 1.00),
(6, '06 - Alpes-Maritimes', 1, 1.00),
(7, '07 - Ardèche', 1, 1.00),
(8, '08 - Ardennes', 1, 1.00),
(9, '09 Ariège', 1, 1.00),
(10, '10 - Aube', 1, 1.00),
(11, '11 - Aude', 1, 1.00),
(12, '12 - Aveyron', 1, 1.00),
(13, '13 - Bouches-du-Rhône', 1, 1.00),
(14, '14 - Calvados', 1, 1.00),
(15, '15 - Cantal', 1, 1.00),
(16, '16 - Charente', 1, 1.00),
(17, '17 - Charente-Maritime', 1, 1.00),
(18, '18 - Cher', 1, 1.00),
(19, '19 - Corrèze', 1, 1.00),
(20, '2A 2B - Départements Corse', 1, 1.00),
(21, '21 - Côte-d Or', 1, 1.00),
(22, '22 - Côtes-d Armor', 1, 1.00),
(23, '23 - Creuse', 1, 1.00),
(24, '24 - Dordogne', 1, 1.00),
(25, '25 - Doubs', 1, 1.00),
(26, '26 - Drôme', 1, 1.00),
(27, '27 - Eure', 1, 1.00),
(28, '28 - Eure-et-Loir', 1, 1.00),
(29, '29 - Finistère', 1, 1.00),
(30, '30 - Gard', 1, 1.00),
(31, '31 - Haute-Garonne', 1, 1.00),
(32, '32 - Gers', 1, 1.00),
(33, '33 - Gironde', 1, 1.00),
(34, '34 - Hérault', 1, 1.00),
(35, '35 - Ille-et-Vilaine', 1, 1.00),
(36, '36 - Indre', 1, 1.00),
(37, '37 - Indre-et-Loire', 1, 1.00),
(38, '38 - Isère', 1, 1.00),
(39, '39 - Jura', 1, 1.00),
(40, '40 - Landes', 1, 1.00),
(41, '41 - Loir-et-Cher', 1, 1.00),
(42, '42 - Loire', 1, 1.00),
(43, '43 - Haute-Loire', 1, 1.00),
(44, '44 - Loire-Atlantique', 1, 1.00),
(45, '45 - Loiret', 1, 1.00),
(46, '46 - Lot', 1, 1.00),
(47, '47 - Lot-et-Garonne', 1, 1.00),
(48, '48 - Lozère', 1, 1.00),
(49, '49 - Maine-et-Loire', 1, 1.00),
(50, '50 - Manche', 1, 1.00),
(51, '51 - Marne', 1, 1.00),
(52, '52 - Haute-Marne', 1, 1.00),
(53, '53 - Mayenne', 1, 1.00),
(54, '54 - Meurthe-et-Moselle', 1, 1.00),
(55, '55 - Meuse', 1, 1.00),
(56, '56 - Morbihan', 1, 1.00),
(57, '57 - Moselle', 1, 1.00),
(58, '58 - Nièvre', 1, 1.00),
(59, '59 - Nord', 1, 1.00),
(60, '60 - Oise', 1, 1.00),
(61, '61 - Orne', 1, 1.00),
(62, '62 - Pas-de-Calais', 1, 1.00),
(63, '63 - Puy-de-Dôme', 1, 1.00),
(64, '64 - Pyrénées-Atlantiques', 1, 1.00),
(65, '65 - Hautes-Pyrénées', 1, 1.00),
(66, '66 - Pyrénées-Orientales', 1, 1.00),
(67, '67 - Bas-Rhin', 1, 1.00),
(68, '68 - Haut-Rhin', 1, 1.00),
(69, '69 - Rhône', 1, 1.00),
(70, '70 - Haute-Saône', 1, 1.00),
(71, '71 - Saône-et-Loire', 1, 1.00),
(72, '72 - Sarthe', 1, 1.00),
(73, '73 - Savoie', 1, 1.00),
(74, '74 - Haute-Savoie', 1, 1.00),
(75, '75 - Paris', 1, 1.00),
(76, '76 - Seine-Maritime', 1, 1.00),
(77, '77 - Seine-et-Marne', 1, 1.00),
(78, '78 - Yvelines', 1, 1.00),
(79, '79 - Deux-Sèvres', 1, 1.00),
(80, '80 - Somme', 1, 1.00),
(81, '81 - Tarn', 1, 1.00),
(82, '82 - Tarn-et-Garonne', 1, 1.00),
(83, '83 - Var', 1, 1.00),
(84, '84 - Vaucluse', 1, 1.00),
(85, '85 - Vendée', 1, 1.00),
(86, '86 - Vienne', 1, 1.00),
(87, '87 - Haute-Vienne', 1, 1.00),
(88, '88 - Vosges', 1, 1.00),
(89, '89 - Yonne', 1, 1.00),
(90, '90 - Territoire de Belfort', 1, 1.00),
(91, '91 - Essonne', 1, 1.00),
(92, '92 - Hauts-de-Seine', 1, 1.00),
(93, '93 - Seine-Saint-Denis', 1, 1.00),
(94, '94 - Val-de-Marne', 1, 1.00),
(95, '95 - Val-dOise', 1, 1.00);

--

--

--
-- Index pour la table `departements`
--
ALTER TABLE `departements`
  ADD PRIMARY KEY (`id_dep`);
  
USE institutions;
SELECT nom_etab, type_etab, nom_resp, cp, adresse, Telephone, email FROM institutions;
SELECT id, nom_etab, depart, type_etab FROM institutions WHERE depart = 75 AND type_etab = 'PME';
  
