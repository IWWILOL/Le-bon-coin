-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : dim. 28 juin 2026 à 13:42
-- Version du serveur : 8.4.7
-- Version de PHP : 8.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `cloud_diva`
--

-- --------------------------------------------------------

--
-- Structure de la table `annonces`
--

DROP TABLE IF EXISTS `annonces`;
CREATE TABLE IF NOT EXISTS `annonces` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `titre` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `prix` decimal(10,2) NOT NULL,
  `etat` enum('neuf','bon_etat','correct') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `annonces`
--

INSERT INTO `annonces` (`id`, `user_id`, `titre`, `prix`, `etat`, `description`, `image`, `created_at`) VALUES
(17, 1, 'Tortue', 23.00, 'bon_etat', 'gluglu', 'annonce_6a3853a5862d5.jpg', '2026-06-21 21:02:02'),
(16, 5, 'lapin', 23.00, 'neuf', 'ressemble a zahwa', 'annonce_6a380854f3bb7.jpg', '2026-06-21 17:50:44'),
(13, 4, 'écharpe rose', 23.00, 'neuf', 'Achete le c\'est un ordre', 'annonce_6a37f6aa91d8c.jpg', '2026-06-21 16:35:22'),
(24, 6, 'porte clé', 23.00, 'neuf', '', 'annonce_6a402a764d34e.jpg', '2026-06-27 21:54:30'),
(15, 3, 'echarpe vert', 14.00, 'bon_etat', 'very good', 'annonce_6a37ff1a7d24a.jpg', '2026-06-21 17:11:22'),
(23, 7, 'echarpe bleue', 12.00, 'bon_etat', '', 'annonce_6a40283aefbc6.jpg', '2026-06-27 21:44:58'),
(25, 6, 'porte clé', 23.00, 'neuf', '', 'annonce_6a4038b16df51.jpg', '2026-06-27 22:55:13'),
(26, 6, 'Tortue', 25.00, 'neuf', '', 'annonce_6a4039253713e.jpg', '2026-06-27 22:57:09'),
(27, 6, 'lapin', 23.00, 'bon_etat', '', 'annonce_6a403a25c6195.jpg', '2026-06-27 23:01:25'),
(34, 6, 'porte clé', 23.00, 'bon_etat', '', 'annonce_6a4046fb64c44.jpg', '2026-06-27 23:56:11'),
(32, 6, 'frog plushie', 23.00, 'bon_etat', '', 'annonce_6a4044e510556.jpg', '2026-06-27 23:47:17');

-- --------------------------------------------------------

--
-- Structure de la table `favoris`
--

DROP TABLE IF EXISTS `favoris`;
CREATE TABLE IF NOT EXISTS `favoris` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `annonce_id` int NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id` (`user_id`,`annonce_id`),
  KEY `annonce_id` (`annonce_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `id` int NOT NULL AUTO_INCREMENT,
  `annonce_id` int NOT NULL,
  `expediteur_id` int NOT NULL,
  `destinataire_id` int NOT NULL,
  `contenu` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `annonce_id` (`annonce_id`),
  KEY `expediteur_id` (`expediteur_id`),
  KEY `destinataire_id` (`destinataire_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `questions`
--

DROP TABLE IF EXISTS `questions`;
CREATE TABLE IF NOT EXISTS `questions` (
  `id` int NOT NULL AUTO_INCREMENT,
  `question` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `reponse1` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reponse2` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reponse3` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reponse4` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bonne_reponse` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=96 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `questions`
--

INSERT INTO `questions` (`id`, `question`, `reponse1`, `reponse2`, `reponse3`, `reponse4`, `bonne_reponse`) VALUES
(1, 'Quel type de fil est le plus doux pour les bébés ?', 'Acrylique', 'Laine mérinos', 'Coton', 'Polyester', 2),
(2, 'Quel fil est recommandé pour les projets d\'été ?', 'Laine', 'Mohair', 'Coton', 'Alpaga', 3),
(3, 'Qu\'est-ce que le fil amigurumi ?', 'Un fil très épais', 'Un fil fin pour créer des peluches', 'Un fil métallique', 'Un fil en soie', 2),
(4, 'Quel numéro de fil est le plus fin ?', 'Numéro 1', 'Numéro 3', 'Numéro 5', 'Numéro 6', 1),
(5, 'Quel fil est d\'origine animale ?', 'Coton', 'Polyester', 'Laine', 'Bambou', 3),
(6, 'Qu\'est-ce que le fil fingering ?', 'Un fil très épais', 'Un fil très fin', 'Un fil moyen', 'Un fil élastique', 2),
(7, 'Quel fil est le plus résistant à l\'eau ?', 'Laine', 'Coton', 'Mohair', 'Angora', 2),
(8, 'Qu\'est-ce que le fil chunky ?', 'Un fil très fin', 'Un fil moyen', 'Un fil très épais', 'Un fil brillant', 3),
(9, 'Quel fil est produit par des chèvres ?', 'Alpaga', 'Mohair', 'Cachemire', 'Angora', 2),
(10, 'Quel fil est produit par des lapins ?', 'Mohair', 'Alpaga', 'Angora', 'Cachemire', 3),
(11, 'Quelle est la taille standard d\'un crochet pour fil moyen ?', '2mm', '4mm', '8mm', '10mm', 2),
(12, 'Quel matériau est le plus courant pour les crochets ?', 'Or', 'Aluminium', 'Plastique', 'Bois', 2),
(13, 'À quoi sert un marqueur de mailles ?', 'À couper le fil', 'À marquer une maille importante', 'À mesurer la tension', 'À assembler les pièces', 2),
(14, 'Qu\'est-ce qu\'un crochet ergonomique ?', 'Un crochet avec une poignée confortable', 'Un crochet très petit', 'Un crochet électrique', 'Un crochet en bois', 1),
(15, 'À quoi sert une aiguille à laine ?', 'À tricoter', 'À rentrer les fils', 'À mesurer', 'À couper', 2),
(16, 'Quel outil mesure la tension d\'un ouvrage ?', 'Un marqueur', 'Une règle', 'Un gauge/jauge', 'Un crochet', 3),
(17, 'À quoi sert un bloqueur d\'ouvrage ?', 'À couper le fil', 'À donner la forme finale à l\'ouvrage', 'À mesurer les mailles', 'À assembler', 2),
(18, 'Quel crochet utilise-t-on pour le Tunisien ?', 'Un crochet court', 'Un crochet long avec arrêt', 'Un crochet en bois', 'Un double crochet', 2),
(19, 'Qu\'est-ce qu\'un swift ?', 'Un type de maille', 'Un dévidoir à fil', 'Un crochet spécial', 'Un patron', 2),
(20, 'À quoi sert un ball winder ?', 'À couper le fil', 'À enrouler le fil en pelote', 'À mesurer le fil', 'À teindre le fil', 2),
(21, 'Comment s\'appelle la première maille apprise au crochet ?', 'Maille serrée', 'Maille coulée', 'Chainette', 'Demi-bride', 3),
(22, 'Qu\'est-ce qu\'une maille serrée ?', 'La maille la plus haute', 'La maille la plus basse et serrée', 'Une maille décorative', 'Une maille complexe', 2),
(23, 'Combien de brins passe-t-on dans une demi-bride ?', '1', '2', '3', '4', 2),
(24, 'Qu\'est-ce qu\'une bride ?', 'La maille la plus petite', 'Une maille de hauteur moyenne', 'La maille la plus haute', 'Une maille décorative', 2),
(25, 'Combien de jetés fait-on avant d\'insérer le crochet pour une double bride ?', '1', '2', '3', '4', 2),
(26, 'Qu\'est-ce qu\'une maille coulée ?', 'Une maille très haute', 'Une maille pour fermer un rang', 'Une maille décorative', 'Une maille de base', 2),
(27, 'Comment appelle-t-on l\'abréviation \"ms\" ?', 'Maille simple', 'Maille serrée', 'Maille souple', 'Maille système', 2),
(28, 'Qu\'est-ce qu\'une triple bride ?', 'Une maille avec 3 jetés', 'Une maille très petite', 'Une maille décorative', 'Une maille fermée', 1),
(29, 'Qu\'est-ce qu\'un picot ?', 'Une petite maille décorative', 'Un type de fil', 'Un outil', 'Une technique de finition', 1),
(30, 'Comment appelle-t-on l\'abréviation \"ch\" dans un patron ?', 'Chainette', 'Crochet', 'Coulé', 'Court', 1),
(31, 'Comment commence-t-on généralement un projet en rond ?', 'Par une chainette', 'Par un anneau magique', 'Par une maille serrée', 'Par une bride', 2),
(32, 'Qu\'est-ce que l\'anneau magique ?', 'Un anneau décoratif', 'Une technique pour commencer en rond sans trou', 'Un type de maille', 'Un outil', 2),
(33, 'Qu\'est-ce que le crochet Tunisien ?', 'Un crochet originaire de Tunisie', 'Une technique avec un crochet long', 'Un type de fil', 'Une maille spéciale', 2),
(34, 'Comment augmente-t-on une maille ?', 'En sautant une maille', 'En faisant 2 mailles dans la même maille', 'En coupant le fil', 'En changeant de couleur', 2),
(35, 'Comment diminue-t-on une maille ?', 'En ajoutant une maille', 'En réunissant 2 mailles en 1', 'En changeant de rang', 'En faisant un picot', 2),
(36, 'Qu\'est-ce que la tension au crochet ?', 'La force avec laquelle on tire le fil', 'Le nombre de mailles par cm', 'La longueur du fil', 'La couleur du fil', 2),
(37, 'Comment change-t-on de couleur au crochet ?', 'En coupant et recommençant', 'En changeant avant la dernière boucle de la maille', 'En faisant un noeud', 'En utilisant un autre crochet', 2),
(38, 'Qu\'est-ce que le crochet jacquard ?', 'Un crochet décoratif', 'Une technique avec plusieurs couleurs', 'Un type de crochet', 'Un fil spécial', 2),
(39, 'Qu\'est-ce que le motif granny square ?', 'Un carré tricoté', 'Un carré au crochet traditionnel', 'Un patron difficile', 'Un type de fil', 2),
(40, 'Comment lit-on un diagramme de crochet ?', 'De gauche à droite', 'Du centre vers l\'extérieur ou de bas en haut', 'De haut en bas', 'De droite à gauche', 2),
(41, 'Qu\'est-ce qu\'un amigurumi ?', 'Un type de fil japonais', 'Une peluche au crochet d\'origine japonaise', 'Un patron complexe', 'Un outil spécial', 2),
(42, 'Quel point est idéal pour les couvertures de bébé ?', 'Point de coquille', 'Point mousse', 'Point de riz', 'Point fantaisie', 1),
(43, 'Qu\'est-ce qu\'un sac filet au crochet ?', 'Un sac en plastique', 'Un sac avec des mailles ajourées', 'Un sac très épais', 'Un sac imperméable', 2),
(44, 'Quel projet est idéal pour débuter ?', 'Un pull complexe', 'Un carré simple', 'Un amigurumi', 'Une dentelle', 2),
(45, 'Qu\'est-ce qu\'un châle au crochet ?', 'Un chapeau', 'Un accessoire porté sur les épaules', 'Une couverture', 'Un sac', 2),
(46, 'Comment appelle-t-on les créations au crochet vendues ?', 'Des tricots', 'Des créations artisanales', 'Des tissages', 'Des broderies', 2),
(47, 'Qu\'est-ce qu\'un tawashi ?', 'Un type de fil', 'Une éponge au crochet', 'Un patron japonais', 'Un outil', 2),
(48, 'Quel fil utilise-t-on pour faire un filet de courses ?', 'Laine', 'Coton résistant', 'Mohair', 'Angora', 2),
(49, 'Qu\'est-ce qu\'une mandala au crochet ?', 'Un patron difficile', 'Un motif circulaire décoratif', 'Un type de maille', 'Un outil', 2),
(50, 'Qu\'est-ce qu\'un top au crochet ?', 'Un chapeau', 'Un haut vestimentaire', 'Un sac', 'Une couverture', 2),
(51, 'Que signifie \"rép\" dans un patron ?', 'Répéter', 'Reprendre', 'Remplacer', 'Relier', 1),
(52, 'Que signifie \"*...* x fois\" dans un patron ?', 'Faire une fois', 'Répéter entre les étoiles x fois', 'Sauter x mailles', 'Ajouter x mailles', 2),
(53, 'Que signifie \"end\" dans un patron anglais ?', 'Endroit', 'Fin', 'Envers', 'Entre', 2),
(54, 'Que signifie \"sk\" dans un patron anglais ?', 'Skill', 'Skip (sauter)', 'Stitch knit', 'Slack', 2),
(55, 'Que signifie \"sc\" dans un patron anglais ?', 'Single crochet (maille serrée)', 'Special crochet', 'Slip chain', 'Short crochet', 1),
(56, 'Que signifie \"dc\" dans un patron anglais ?', 'Double chain', 'Double crochet (bride)', 'Decrease', 'Diagonal crochet', 2),
(57, 'Que signifie \"inc\" dans un patron ?', 'Incorporer', 'Increase (augmentation)', 'Incruster', 'Initier', 2),
(58, 'Que signifie \"dec\" dans un patron ?', 'Décorer', 'Decrease (diminution)', 'Décompter', 'Détacher', 2),
(59, 'Que signifie \"sl st\" dans un patron anglais ?', 'Slip stitch (maille coulée)', 'Slow stitch', 'Small stitch', 'Side stitch', 1),
(60, 'Que signifie \"ch sp\" dans un patron anglais ?', 'Chain space (espace de chainette)', 'Crochet special', 'Chain stitch pattern', 'Close stitch', 1),
(61, 'Comment rentre-t-on les fils au crochet ?', 'On les coupe directement', 'On les passe dans les mailles avec une aiguille', 'On les noue', 'On les brûle', 2),
(62, 'Qu\'est-ce que le blocage d\'un ouvrage ?', 'Bloquer l\'ouvrage pour qu\'il garde sa forme', 'Arrêter de crocheter', 'Bloquer une maille', 'Fermer un rang', 1),
(63, 'Comment assemble-t-on deux pièces au crochet ?', 'Avec de la colle', 'Avec des mailles coulées ou des mailles serrées', 'Avec du fil à coudre', 'Avec des épingles', 2),
(64, 'Qu\'est-ce qu\'une couture plate au crochet ?', 'Une couture invisible', 'Une couture décorative visible', 'Une couture avec du fil à coudre', 'Une couture à la machine', 2),
(65, 'Comment finit-on proprement un ouvrage au crochet ?', 'On coupe le fil', 'On fait une maille coulée et on rentre le fil', 'On fait un noeud', 'On laisse le fil dépasser', 2),
(66, 'D\'où vient le mot \"crochet\" ?', 'De l\'anglais', 'Du français (petit crochet)', 'De l\'espagnol', 'De l\'italien', 2),
(67, 'Quel pays est connu pour la dentelle au crochet irlandais ?', 'France', 'Irlande', 'Espagne', 'Italie', 2),
(68, 'Depuis quand le crochet existe-t-il ?', 'XVIe siècle', 'XIXe siècle', 'XVIIe siècle', 'XXe siècle', 2),
(69, 'Qu\'est-ce que la dentelle de Bruges ?', 'Une dentelle française', 'Une dentelle belge au crochet', 'Une dentelle espagnole', 'Une dentelle italienne', 2),
(70, 'Dans quel pays l\'amigurumi est-il originaire ?', 'Chine', 'Corée', 'Japon', 'Vietnam', 3),
(71, 'Comment lave-t-on un ouvrage en laine ?', 'À la machine à 60°', 'À la main à l\'eau froide', 'Au sèche-linge', 'Avec de l\'eau bouillante', 2),
(72, 'Comment sèche-t-on un ouvrage au crochet ?', 'Au sèche-linge', 'À plat sur une serviette', 'Suspendu', 'Avec un fer à repasser directement', 2),
(73, 'Que signifie le symbole \"main\" sur une étiquette de fil ?', 'Lavage à la main uniquement', 'Ne pas laver', 'Lavage en machine', 'Séchage à la main', 1),
(74, 'Comment conserve-t-on les pelotes de fil ?', 'Dans un sac plastique fermé', 'Dans un endroit sec à l\'abri de la lumière', 'Au réfrigérateur', 'Dans un tiroir humide', 2),
(75, 'Que fait-on si un ouvrage en laine rétrécit ?', 'On le jette', 'On le mouille et on l\'étire doucement', 'On le lave à nouveau', 'On le repasse à chaud', 2),
(76, 'Comment calcule-t-on l\'échantillon ?', 'On compte les mailles sur 5cm', 'On compte les mailles sur 10cm', 'On compte les rangs sur 20cm', 'On mesure le fil utilisé', 2),
(77, 'Si l\'échantillon demande 20ms pour 10cm et on en a 22, que fait-on ?', 'On change de patron', 'On prend un crochet plus grand', 'On prend un crochet plus petit', 'On change de fil', 2),
(78, 'Comment calcule-t-on la quantité de fil nécessaire ?', 'On achète 1 pelote', 'On suit les indications du patron', 'On achète 10 pelotes', 'On mesure à l\'oeil', 2),
(79, 'Qu\'est-ce que la jauge au crochet ?', 'La taille du crochet', 'Le nombre de mailles et rangs par cm', 'La longueur du fil', 'Le poids de l\'ouvrage', 2),
(80, 'Comment adapte-t-on un patron à sa taille ?', 'On ne peut pas', 'On modifie le nombre de mailles selon l\'échantillon', 'On change de fil', 'On change de patron', 2),
(81, 'Qu\'est-ce qu\'un point d\'étoile ?', 'Un point en forme d\'étoile', 'Un point de base', 'Un point pour débutant', 'Un point irlandais', 1),
(82, 'Qu\'est-ce qu\'un point de coquille ?', 'Un point en forme de coquille', 'Un point très simple', 'Un point pour la mer', 'Un point japonais', 1),
(83, 'Qu\'est-ce qu\'un point pop-corn ?', 'Un point gonflé en relief', 'Un point plat', 'Un point pour débutant', 'Un point américain', 1),
(84, 'Qu\'est-ce qu\'un point en V ?', 'Une bride et une chainette et une bride dans la même maille', 'Deux mailles serrées ensemble', 'Un point décoratif complexe', 'Un point pour les angles', 1),
(85, 'Qu\'est-ce qu\'un point de feuille ?', 'Un point en forme de feuille', 'Un point vert', 'Un point naturel', 'Un point irlandais', 1),
(86, 'Qu\'est-ce qu\'une créatrice qui vend ses créations au crochet ?', 'Une tricoteuse', 'Une crochetteuse ou artisane', 'Une couturière', 'Une tisserande', 2),
(87, 'Quels facteurs influencent le prix d\'une création au crochet ?', 'Seulement le fil', 'Le fil, le temps, les frais et la compétence', 'Seulement le temps', 'Seulement la compétence', 2),
(88, 'Qu\'est-ce qu\'une commission au crochet ?', 'Une vente en magasin', 'Une commande personnalisée', 'Un patron payant', 'Une formation', 2),
(89, 'Où peut-on vendre ses créations au crochet en ligne ?', 'Uniquement sur Amazon', 'Sur des plateformes comme Etsy ou son propre site', 'Uniquement en boutique', 'Sur les réseaux uniquement', 2),
(90, 'Qu\'est-ce qu\'un patron au crochet payant ?', 'Un patron difficile', 'Un fichier avec les instructions vendues', 'Un patron en anglais', 'Un patron professionnel', 2),
(91, 'Quelle est la différence entre le crochet et le tricot ?', 'Aucune différence', 'Le crochet utilise 1 crochet, le tricot 2 aiguilles', 'Le tricot est plus rapide', 'Le crochet est plus ancien', 2),
(92, 'Qu\'est-ce que le freeform crochet ?', 'Un crochet sans patron ni règles', 'Un crochet gratuit', 'Un crochet rapide', 'Un crochet simple', 1),
(93, 'Qu\'est-ce que le crochet broomstick ?', 'Une technique avec une grande aiguille ou bâton', 'Un crochet en bois', 'Un crochet pour balai', 'Un crochet très petit', 1),
(94, 'Qu\'est-ce que le crochet hairpin ?', 'Une technique avec un cadre spécial', 'Un crochet pour cheveux', 'Un crochet très fin', 'Un crochet décoratif', 1),
(95, 'Qu\'est-ce que le yarn bombing ?', 'Détruire de la laine', 'Décorer des espaces publics avec du crochet', 'Teindre la laine', 'Vendre de la laine', 2);

-- --------------------------------------------------------

--
-- Structure de la table `reponses`
--

DROP TABLE IF EXISTS `reponses`;
CREATE TABLE IF NOT EXISTS `reponses` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tentative_id` int NOT NULL,
  `question_id` int NOT NULL,
  `reponse_utilisateur` int NOT NULL,
  `correcte` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `tentatives`
--

DROP TABLE IF EXISTS `tentatives`;
CREATE TABLE IF NOT EXISTS `tentatives` (
  `id` int NOT NULL AUTO_INCREMENT,
  `utilisateur_id` int NOT NULL,
  `score` float NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `tentatives`
--

INSERT INTO `tentatives` (`id`, `utilisateur_id`, `score`, `date`) VALUES
(1, 7, 0, '0000-00-00 00:00:00'),
(2, 6, 0, '0000-00-00 00:00:00'),
(3, 6, 0, '0000-00-00 00:00:00'),
(4, 6, 0, '0000-00-00 00:00:00'),
(5, 6, 0, '0000-00-00 00:00:00'),
(6, 6, 0, '0000-00-00 00:00:00'),
(7, 6, 0, '0000-00-00 00:00:00'),
(8, 6, 0, '0000-00-00 00:00:00'),
(9, 6, 0, '0000-00-00 00:00:00'),
(10, 6, 8, '0000-00-00 00:00:00'),
(11, 6, 4, '0000-00-00 00:00:00'),
(12, 6, 16, '0000-00-00 00:00:00'),
(13, 6, 16, '0000-00-00 00:00:00'),
(14, 6, 10, '0000-00-00 00:00:00'),
(15, 6, 4, '0000-00-00 00:00:00'),
(16, 6, 2, '0000-00-00 00:00:00'),
(17, 6, 16, '0000-00-00 00:00:00'),
(18, 6, 18, '0000-00-00 00:00:00'),
(19, 6, 18, '0000-00-00 00:00:00'),
(20, 6, 18, '0000-00-00 00:00:00'),
(21, 6, 12, '0000-00-00 00:00:00'),
(22, 6, 14, '0000-00-00 00:00:00'),
(23, 6, 14, '0000-00-00 00:00:00'),
(24, 6, 10, '0000-00-00 00:00:00'),
(25, 6, 14, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('membre','admin') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT 'membre',
  `actif` tinyint(1) DEFAULT '1',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `nom`, `email`, `password`, `role`, `actif`, `created_at`) VALUES
(6, 'mika', 'mika7@l.astar', '$2y$10$M2ZipbonTHL89ddjefZd/eogueUyMEKSNr2P4ww2GseQSXEUZmLx6', 'membre', 1, '2026-06-26 14:14:46'),
(2, 'mika', 'mika@la.star', '$2y$10$A3DjTnykDuCj3Sqcnew8TO5YqGTkcLkl3MM/Pk8SIKWv0FhaxeN9a', 'membre', 1, '2026-06-21 15:08:25'),
(3, 'Test', 'test@test.com', '$2y$10$ZUuARDdSQppNZYYHqr135urr9Q1/TmuNkOhz4GHHQVQXx0fAf12F6', 'membre', 1, '2026-06-21 15:10:24'),
(4, 'zahwa', 'zahwa2@la.folle', '$2y$10$xvRH46K.BlzNa4OspcxdsuBm9Nd1srIhZAbAGhCY1FEaCDNj29WFC', 'membre', 1, '2026-06-21 16:34:26'),
(5, 'hassan', 'hassan9@mah.boul', '$2y$10$4SDBjiE/NyE5bVwESGB38.zPH3EMAK7Jtm9OI8TfinQLL2JFC7A/O', 'membre', 1, '2026-06-21 17:49:44'),
(7, 'malik', 'malik@mk.com', '$2y$10$8egbFzQVCd8nDxdjTgtDSOEsyLYsuHsM48Y0g0XoeNfSnSiKYncvC', 'membre', 1, '2026-06-27 21:38:28');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
