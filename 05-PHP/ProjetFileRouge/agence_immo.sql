-- CREATE DATABASE immochateau;
-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--





-- --------------------------------------------------------

--
-- Structure de la table `association_img`
--

CREATE TABLE `association_img` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_image` int(10) UNSIGNED NOT NULL,
  `img_ppal` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `biens_immobiliers`
--

CREATE TABLE `biens_immobiliers` (
  `id` int(11) UNSIGNED NOT NULL,
  `titre` varchar(100) NOT NULL,
  `nbr_pieces` int(11) NOT NULL,
  `surface` decimal(6,2) NOT NULL,
  `prix_vente` decimal(11,2) NOT NULL,
  `description` text DEFAULT NULL,
  `ges` char(1) NOT NULL,
  `classe_eco` char(1) NOT NULL,
  `meuble` tinyint(1) NOT NULL,
  `localisation` mediumtext DEFAULT NULL,
  `num_departement` int(10) UNSIGNED NOT NULL,
  `ville` varchar(70) NOT NULL,
  `charges_annuelles` decimal(11,2) NOT NULL,
  `id_utilisateur_commercial` int(10) UNSIGNED NOT NULL,
  `id_categorie` int(10) UNSIGNED NOT NULL,
  `id_proprietaire` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `biens_immobiliers`
--

INSERT INTO `biens_immobiliers` (`id`, `titre`, `nbr_pieces`, `surface`, `prix_vente`, `description`, `ges`, `classe_eco`, `meuble`, `localisation`, `num_departement`, `ville`, `charges_annuelles`, `id_utilisateur_commercial`, `id_categorie`, `id_proprietaire`) VALUES
(1, 'Maison de maître au bord du Lac ', 5, '150.00', '550000.00', 'Belle maison de style située au bord du lac D\'Annecy...Emplacement avec vue sur le lac.', 'D', 'C', 0, 'Idéalement situé à 2 pas du centre de la vieille ville, quartier sud  ', 74, 'Annecy', '0.00', 1, 2, 2),
(2, 'Beau F3 MEUBLE\r\n', 3, '94.00', '220000.00', 'Beau F3 situé au 1er étage d\'une résidence avec vue sur le lac.', 'B', 'C', 0, 'A 2 pas du centre ville et des commerces , dans le quartier vieille ville, rue de l\'Ours', 74, 'Annecy', '2000.00', 2, 1, 3),
(3, 'Bel appartement 90 m² - 4 pièces - 3 chambres', 4, '90.00', '278200.00', 'Quartier des Maraîchers, Lumineux 4 pièces de 90 m2 dans une résidence de standing de 2015 avec portail motorisé..\r\nAu rez-de-chaussée : Cuisine ouverte sur salon séjour avec un accès sur la terrasse, 1 chambre, WC indépendant avec lave-main. A l\'étage: 1 chambre de 18 m2 avec dressing , une salle de bain avec fenêtre et une mezzanine de 25m2 au sol.\r\nUn garage ainsi qu\'une place de parking complète ce lot.', 'D', 'B', 0, 'Idéalement situé à proximité des commerces, transports en commun et du centre de Colmar.', 68, 'Colmar', '3000.00', 1, 1, 3),
(4, 'appartement F2 pièces de 67m2 avec orientation SUD', 4, '67.00', '235000.00', 'appartement 2 pièces de 67m2 avec orientation SUD, composant : 2 chambres, une cuisine ouverte sur le salon séjour, salle de bain, WC indépendant, terrasse de 12m2 et jardin de 77m2.\r\nLe bien est vendu avec cave. Le garage est en option. \r\nA proximité de tout accès et commodité.\r\nÉligible à la loi PINEL et au prêt a taux zéro.\r\n', 'B', 'B', 0, 'situé au centre ville de Colmar,A proximité de tout accès et commodité.', 68, 'Colmar', '1500.00', 2, 1, 2),
(5, 'MAISON 4 PIÈCES AVEC TERRASSE - PROCHE CASTRES', 4, '80.00', '129000.00', 'découvrez cette maison de 4 pièces de 80 m² et de 1 500 m² de terrain. Elle dispose d\'une pièce à vivre et de trois chambres. Elle offre également une salle d\'eau. Un chauffage fonctionnant à l\'électricité est installé dans la maison.\r\n\r\nCe bien dispose aussi d\'une terrasse (30 m²) et d\'un jardin (1 500 m²), l\'idéal pour profiter des beaux jours.\r\n\r\nL\'intérieur nécessite d\'être rafraîchi. Concernant les véhicules, cette maison possède une place sur un parking extérieur et deux places de parking en intérieur.', 'D', 'C', 0, 'La maison se situe dans la commune d\'Anglès. On trouve une école primaire à moins de 10 minutes du bien. Il y a un restaurant à moins de 10 minutes.', 81, 'Anglès', '0.00', 1, 2, 2),
(6, 'Maison mitoyenne 1 côté à vendre dans un ensemble immobilier de 4 logements réhabilité à neuf', 3, '60.00', '152000.00', 'Idéalement situé à 5 minutes de l\'Eurométropole Strasbourgeoise, maison mitoyenne 1 côté à vendre dans un ensemble immobilier de 4 logements réhabilité à neuf en 2020.\r\n\r\nSur 2 niveaux, le logement comprend 2 chambres, 1 salle de bain, 2 WC, un séjour spacieux ouvert sur une cuisine et une terrasse. Places de stationnement extérieures et/ou garages peuvent venir compléter le bien en sus.\r\n\r\n', 'D', 'C', 0, 'Lumineux et calme, il se trouve proche de toutes commodités et des transports en commun, à 5 minutes de l\'autoroute et à 15 minutes du centre-ville de Strasbourg.', 67, 'Berstett', '2000.00', 2, 2, 2),
(7, 'Terrain Constructible Burlats 3730 m²', 0, '3730.00', '87000.00', 'Terrain de 3730m2(soit 37 a) dans un endroit très calme sans vis a vis avec une vue magnifique.\r\nA 5mn de castres.\r\n\r\n ', 'a', 'a', 0, 'A 5mn de castres.', 81, 'Burlats 81100', '0.00', 2, 3, 2),
(9, '\'Grand Appartement Colmar F4 à saisir \'', 4, '94.00', '200000.00', '\' test \'', 'A', 'A', 0, '\' Quartier des Maraîchers\'', 68, 'Colmar', '15000.00', 1, 1, 3),
(10, 'l\'olibrius thann', 5, '95.00', '200000.00', ' test de m\'étoile?!;:', 'A', 'A', 0, '\' test\'', 68, 'Colmar', '15000.00', 1, 1, 2),
(11, 'Grand Appartement Colmar F4 à saisir ', 4, '98.00', '250000.00', ' test', 'A', 'A', 0, ' test', 68, 'Colmar', '15000.00', 1, 1, 3);

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `id_categorie` int(11) UNSIGNED NOT NULL,
  `lib_categorie` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id_categorie`, `lib_categorie`) VALUES
(1, 'Appartement'),
(2, 'Maison individuelle'),
(3, 'Terrain'),
(4, 'Local professionnel');

-- --------------------------------------------------------

--
-- Structure de la table `departements`
--

CREATE TABLE `departements` (
  `id_dep` int(10) UNSIGNED NOT NULL,
  `nom_dep` varchar(50) NOT NULL,
  `dep_actif` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Departements';

--
-- Déchargement des données de la table `departements`
--

INSERT INTO `departements` (`id_dep`, `nom_dep`, `dep_actif`) VALUES
(1, '01 - Ain', 1),
(2, '02 - Aisne', 1),
(3, '03 - Allier', 1),
(4, '04 - Alpes-de-Haute-Provence', 1),
(5, '05 - Hautes-Alpes', 1),
(6, '06 - Alpes-Maritimes', 1),
(7, '07 - Ardèche', 1),
(8, '08 - Ardennes', 1),
(9, '09 - Ariège ', 1),
(10, '10 - Aube', 1),
(11, '11 - Aude', 1),
(12, '12 - Aveyron', 1),
(13, '13 - Bouches-du-Rhône', 1),
(14, '14 - Calvados', 1),
(15, '15 - Cantal', 1),
(16, '16 - Charente', 1),
(17, '17 - Charente-Maritime', 1),
(18, '18 - Cher', 1),
(19, '19 - Corrèze', 1),
(20, '2A 2B - Départements Corse', 1),
(21, '21 - Côte-d\'Or', 1),
(22, '22 - Côtes-d\'Armor', 1),
(23, '23 - Creuse', 1),
(24, '24 - Dordogne', 1),
(25, '25 - Doubs', 1),
(26, '26 - Drôme', 1),
(27, '27 - Eure', 1),
(28, '28 - Eure-et-Loir', 1),
(29, '29 - Finistère', 1),
(30, '30 - Gard', 1),
(31, '31 - Haute-Garonne', 1),
(32, '32 - Gers', 1),
(33, '33 - Gironde', 1),
(34, '34 - Hérault', 1),
(35, '35 - Ille-et-Vilaine', 1),
(36, '36 - Indre', 1),
(37, '37 - Indre-et-Loire', 1),
(38, '38 - Isère', 1),
(39, '39 - Jura', 1),
(40, '40 - Landes', 1),
(41, '41 - Loir-et-Cher', 1),
(42, '42 - Loire', 1),
(43, '43 - Haute-Loire', 1),
(44, '44 - Loire-Atlantique', 1),
(45, '45 - Loiret', 1),
(46, '46 - Lot', 1),
(47, '47 - Lot-et-Garonne', 1),
(48, '48 - Lozère', 1),
(49, '49 - Maine-et-Loire', 1),
(50, '50 - Manche', 1),
(51, '51 - Marne', 1),
(52, '52 - Haute-Marne', 1),
(53, '53 - Mayenne', 1),
(54, '54 - Meurthe-et-Moselle', 1),
(55, '55 - Meuse', 1),
(56, '56 - Morbihan', 1),
(57, '57 - Moselle', 1),
(58, '58 - Nièvre', 1),
(59, '59 - Nord', 1),
(60, '60 - Oise', 1),
(61, '61 - Orne', 1),
(62, '62 - Pas-de-Calais', 1),
(63, '63 - Puy-de-Dôme', 1),
(64, '64 - Pyrénées-Atlantiques', 1),
(65, '65 - Hautes-Pyrénées', 1),
(66, '66 - Pyrénées-Orientales', 1),
(67, '67 - Bas-Rhin', 1),
(68, '68 - Haut-Rhin', 1),
(69, '69 - Rhône', 1),
(70, '70 - Haute-Saône', 1),
(71, '71 - Saône-et-Loire', 1),
(72, '72 - Sarthe', 1),
(73, '73 - Savoie', 1),
(74, '74 - Haute-Savoie', 1),
(75, '75 - Paris', 1),
(76, '76 - Seine-Maritime', 1),
(77, '77 - Seine-et-Marne', 1),
(78, '78 - Yvelines', 1),
(79, '79 - Deux-Sèvres', 1),
(80, '80 - Somme', 1),
(81, '81 - Tarn', 1),
(82, '82 - Tarn-et-Garonne', 1),
(83, '83 - Var', 1),
(84, '84 - Vaucluse', 1),
(85, '85 - Vendée', 1),
(86, '86 - Vienne', 1),
(87, '87 - Haute-Vienne', 1),
(88, '88 - Vosges', 1),
(89, '89 - Yonne', 1),
(90, '90 - Territoire de Belfort', 1),
(91, '91 - Essonne', 1),
(92, '92 - Hauts-de-Seine', 1),
(93, '93 - Seine-Saint-Denis', 1),
(94, '94 - Val-de-Marne', 1),
(95, '95 - Val-d Oise', 1);

-- --------------------------------------------------------

--
-- Structure de la table `documents`
--

CREATE TABLE `documents` (
  `id_document` int(10) UNSIGNED NOT NULL,
  `titre_doc` varchar(250) NOT NULL,
  `chemin_doc` varchar(300) NOT NULL,
  `auteur_doc` varchar(100) NOT NULL,
  `id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `habilitations`
--

CREATE TABLE `habilitations` (
  `id_niveau` int(10) UNSIGNED NOT NULL,
  `libelle_niveau` varchar(50) NOT NULL,
  `droits_habilitation` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `habilitations`
--

INSERT INTO `habilitations` (`id_niveau`, `libelle_niveau`, `droits_habilitation`) VALUES
(1, 'Superadmin', 'Accès tous dossier de ventes'),
(2, 'Agent_commercial', 'Accès à ses dossiers uniquement');

-- --------------------------------------------------------

--
-- Structure de la table `images`
--

CREATE TABLE `images` (
  `id_image` int(11) UNSIGNED NOT NULL,
  `titre_image` varchar(250) NOT NULL,
  `chemin_image` varchar(300) NOT NULL,
  `texte_alternatif` varchar(250) NOT NULL,
  `extension` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `proprietaires`
--

CREATE TABLE `proprietaires` (
  `id_proprietaire` int(10) UNSIGNED NOT NULL,
  `nom` varchar(60) NOT NULL,
  `prenom` varchar(60) NOT NULL,
  `adresse` varchar(255) NOT NULL,
  `code_postal` int(11) NOT NULL,
  `ville` varchar(80) NOT NULL,
  `telephone` varchar(15) NOT NULL,
  `mail` varchar(80) NOT NULL,
  `statut` varchar(20) NOT NULL,
  `office_notarial_titre` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `proprietaires`
--

INSERT INTO `proprietaires` (`id_proprietaire`, `nom`, `prenom`, `adresse`, `code_postal`, `ville`, `telephone`, `mail`, `statut`, `office_notarial_titre`) VALUES
(2, 'HADDOCK', 'Archibald', 'rue de Moulinsard', 74000, 'Annecy', '0635353535', 'ahaddock@gmail.com', 'nom propre', 'étude de  M. Séraphin Lampion '),
(3, 'Tournesol', 'Tryphon', '36, Rue Cornavin ', 74000, 'Annecy', '038815151515', 'ttournesol@gmail.com', 'Gérant SCI ', 'Etude de M. Séraphin lampion');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

CREATE TABLE `utilisateurs` (
  `id_utilisateur` int(10) UNSIGNED NOT NULL,
  `nom_utilisateur` varchar(60) NOT NULL,
  `prenom_utilisateur` varchar(50) NOT NULL,
  `mail_utilisateur` varchar(150) NOT NULL,
  `pass_utilisateur` varchar(400) NOT NULL,
  `id_niveau` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id_utilisateur`, `nom_utilisateur`, `prenom_utilisateur`, `mail_utilisateur`, `pass_utilisateur`, `id_niveau`) VALUES
(1, 'CASTAFIORE', 'Bianca', 'bcastafiore@gmail.com', '$2y$10$2osdGr.NcLSyh6BcwkFIrO4.39XwM8G1gVltSKX5BZwE4Buxz6mZK', 2),
(2, 'Szut', 'Piotr', 'Pszut@gmail.com', '$2y$10$xXYfyPb.VS2MmhUqCQGNWeJPm/rYqifT3HNHVxXr0.dqdC8XDb09a', 2);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `association_img`
--
ALTER TABLE `association_img`
  ADD PRIMARY KEY (`id`,`id_image`),
  ADD KEY `FK_img` (`id_image`);

--
-- Index pour la table `biens_immobiliers`
--
ALTER TABLE `biens_immobiliers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_utilisateur_commercial` (`id_utilisateur_commercial`),
  ADD KEY `id_categorie` (`id_categorie`),
  ADD KEY `fK_proprietaire` (`id_proprietaire`),
  ADD KEY `fk_departement` (`num_departement`);

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id_categorie`);

--
-- Index pour la table `departements`
--
ALTER TABLE `departements`
  ADD PRIMARY KEY (`id_dep`);

--
-- Index pour la table `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`id_document`),
  ADD KEY `id` (`id`);

--
-- Index pour la table `habilitations`
--
ALTER TABLE `habilitations`
  ADD PRIMARY KEY (`id_niveau`);

--
-- Index pour la table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id_image`);

--
-- Index pour la table `proprietaires`
--
ALTER TABLE `proprietaires`
  ADD PRIMARY KEY (`id_proprietaire`);

--
-- Index pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD PRIMARY KEY (`id_utilisateur`),
  ADD KEY `id_niveau` (`id_niveau`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `biens_immobiliers`
--
ALTER TABLE `biens_immobiliers`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
  MODIFY `id_categorie` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `departements`
--
ALTER TABLE `departements`
  MODIFY `id_dep` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- AUTO_INCREMENT pour la table `habilitations`
--
ALTER TABLE `habilitations`
  MODIFY `id_niveau` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `images`
--
ALTER TABLE `images`
  MODIFY `id_image` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `proprietaires`
--
ALTER TABLE `proprietaires`
  MODIFY `id_proprietaire` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  MODIFY `id_utilisateur` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `association_img`
--
ALTER TABLE `association_img`
  ADD CONSTRAINT `FK_bien_immmo` FOREIGN KEY (`id`) REFERENCES `biens_immobiliers` (`id`),
  ADD CONSTRAINT `FK_img` FOREIGN KEY (`id_image`) REFERENCES `images` (`id_image`);

--
-- Contraintes pour la table `biens_immobiliers`
--
ALTER TABLE `biens_immobiliers`
  ADD CONSTRAINT `biens_immobiliers_ibfk_1` FOREIGN KEY (`id_utilisateur_commercial`) REFERENCES `utilisateurs` (`id_utilisateur`),
  ADD CONSTRAINT `biens_immobiliers_ibfk_2` FOREIGN KEY (`id_categorie`) REFERENCES `categories` (`id_categorie`),
  ADD CONSTRAINT `fK_proprietaire` FOREIGN KEY (`id_proprietaire`) REFERENCES `proprietaires` (`id_proprietaire`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_departement` FOREIGN KEY (`num_departement`) REFERENCES `departements` (`id_dep`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `documents`
--
ALTER TABLE `documents`
  ADD CONSTRAINT `documents_ibfk_1` FOREIGN KEY (`id`) REFERENCES `biens_immobiliers` (`id`);

--
-- Contraintes pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD CONSTRAINT `utilisateurs_ibfk_1` FOREIGN KEY (`id_niveau`) REFERENCES `habilitations` (`id_niveau`);
COMMIT;


