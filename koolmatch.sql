-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : lun. 16 mai 2022 à 16:06
-- Version du serveur : 10.4.22-MariaDB
-- Version de PHP : 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `koolmatch`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(50) NOT NULL,
  `login_admin` varchar(20) NOT NULL,
  `password_admin` varchar(20) NOT NULL,
  `archive` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `admin`
--

INSERT INTO `admin` (`id_admin`, `login_admin`, `password_admin`, `archive`) VALUES
(1, 'admin@esprit.tn', 'Admin1', 0);

-- --------------------------------------------------------

--
-- Structure de la table `conversation`
--

CREATE TABLE `conversation` (
  `id_conversation` int(20) NOT NULL,
  `titre_conversation` varchar(20) NOT NULL,
  `id_user1` int(20) NOT NULL,
  `id_user2` int(20) NOT NULL,
  `archive` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `conversation`
--

INSERT INTO `conversation` (`id_conversation`, `titre_conversation`, `id_user1`, `id_user2`, `archive`) VALUES
(2, 'Eya & Marwen', 2, 1, 0),
(3, 'Marwen & Eya', 1, 2, 0);

-- --------------------------------------------------------

--
-- Structure de la table `evenement`
--

CREATE TABLE `evenement` (
  `id_event` int(20) NOT NULL,
  `nom_event` varchar(20) NOT NULL,
  `dd_event` date NOT NULL,
  `df_event` date NOT NULL,
  `theme_event` varchar(50) NOT NULL,
  `adresse_event` varchar(20) NOT NULL,
  `telephone` int(20) NOT NULL,
  `archive` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `evenement`
--

INSERT INTO `evenement` (`id_event`, `nom_event`, `dd_event`, `df_event`, `theme_event`, `adresse_event`, `telephone`, `archive`) VALUES
(10, 'movie night', '2022-03-04', '2022-03-10', 'cinema ', 'pathe , tunis city', 99747824, 0),
(11, 'pizza party', '2022-03-11', '2022-03-12', 'pizza', 'Pizza Hut, 90، 2 Av.', 25698741, 0),
(12, 'jazz fest', '2022-03-25', '2022-03-25', 'music', 'theatre de carthage ', 78256987, 0),
(14, 'Haloween', '2020-01-15', '2025-01-01', 'Scary', 'ESPRIT', 94366666, 0);

-- --------------------------------------------------------

--
-- Structure de la table `gerant`
--

CREATE TABLE `gerant` (
  `id_gerant` int(20) NOT NULL,
  `nom_gerant` varchar(100) NOT NULL,
  `prenom_gerant` varchar(100) NOT NULL,
  `email_gerant` varchar(255) NOT NULL,
  `password_gerant` varchar(255) NOT NULL,
  `telephone_gerant` int(20) NOT NULL,
  `dd_abonnement` date NOT NULL,
  `df_abonnement` date NOT NULL,
  `archive` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `gerant`
--

INSERT INTO `gerant` (`id_gerant`, `nom_gerant`, `prenom_gerant`, `email_gerant`, `password_gerant`, `telephone_gerant`, `dd_abonnement`, `df_abonnement`, `archive`) VALUES
(2, 'khaled', 'ben ammar', 'khaledbenammar@esprit.tn', '1234', 25236212, '2022-03-01', '2022-03-31', 0),
(20, 'Asma', 'Ben Brahim', 'asmabenbrahim@esprit.tn', '1234', 23212526, '2022-03-01', '2022-03-31', 0),
(21, 'Wassim', 'Ben Romdhane', 'wassimbenr@gmail.com', 'BYEBye1', 94366666, '2022-05-07', '2022-05-31', 0);

-- --------------------------------------------------------

--
-- Structure de la table `interaction`
--

CREATE TABLE `interaction` (
  `id_interaction` int(20) NOT NULL,
  `type_interaction` varchar(20) NOT NULL,
  `date_interaction` date NOT NULL,
  `id_user1` int(11) DEFAULT NULL,
  `id_user2` int(11) DEFAULT NULL,
  `archive` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `interaction`
--

INSERT INTO `interaction` (`id_interaction`, `type_interaction`, `date_interaction`, `id_user1`, `id_user2`, `archive`) VALUES
(1, 'o', '2022-05-12', 1, 2, 0),
(2, 'x', '2022-05-12', 1, 2, 0),
(3, 'x', '2022-05-12', 1, 2, 0),
(4, 'x', '2022-05-12', 1, 2, 0);

-- --------------------------------------------------------

--
-- Structure de la table `invitation`
--

CREATE TABLE `invitation` (
  `id_invitation` int(20) NOT NULL,
  `nom_event` varchar(255) NOT NULL,
  `id_user` int(11) NOT NULL,
  `archive` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `invitation`
--

INSERT INTO `invitation` (`id_invitation`, `nom_event`, `id_user`, `archive`) VALUES
(8, 'scary night', 1, 0),
(10, 'date night', 2, 0),
(11, 'pizza party', 1, 0),
(13, 'scary night', 2, 0),
(14, 'movie night', 2, 0),
(16, 'scary night', 3, 0),
(17, 'jazz fest', 2, 0),
(18, 'scary night', 3, 1),
(19, 'Bienvenue cher client!', 1, 0);

-- --------------------------------------------------------

--
-- Structure de la table `jeu`
--

CREATE TABLE `jeu` (
  `id_jeu` int(20) NOT NULL,
  `score_jeu` int(20) NOT NULL,
  `id_quiz` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `archive` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `jeu`
--

INSERT INTO `jeu` (`id_jeu`, `score_jeu`, `id_quiz`, `id_user`, `archive`) VALUES
(3, 55, 6, 1, 0),
(4, 80, 6, 2, 0),
(5, 60, 6, 3, 0),
(6, 170, 6, 4, 0),
(7, 130, 6, 5, 0),
(8, 200, 6, 6, 0),
(10, 40, 1, 7, 0),
(11, 0, 4, 1, 0),
(12, 0, 4, 1, 0),
(13, 0, 4, 1, 0);

-- --------------------------------------------------------

--
-- Structure de la table `matching`
--

CREATE TABLE `matching` (
  `id_match` int(20) NOT NULL,
  `id_user1` int(11) DEFAULT NULL,
  `id_user2` int(11) DEFAULT NULL,
  `date_matching` date NOT NULL,
  `archive` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `matching`
--

INSERT INTO `matching` (`id_match`, `id_user1`, `id_user2`, `date_matching`, `archive`) VALUES
(11, 1, 2, '2022-05-09', 0);

-- --------------------------------------------------------

--
-- Structure de la table `message`
--

CREATE TABLE `message` (
  `id_message` int(20) NOT NULL,
  `msg_message` varchar(100) NOT NULL,
  `date_message` date NOT NULL,
  `id_conversation` int(20) NOT NULL,
  `archive` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `message`
--

INSERT INTO `message` (`id_message`, `msg_message`, `date_message`, `id_conversation`, `archive`) VALUES
(1, 'hello', '2022-05-09', 1, 0),
(2, 'hello', '2022-05-09', 1, 0),
(3, 'hello', '2022-05-16', 3, 0),
(4, 'aslema', '2022-05-16', 3, 0),
(5, 'labes alik', '2022-05-16', 3, 0);

-- --------------------------------------------------------

--
-- Structure de la table `quiz`
--

CREATE TABLE `quiz` (
  `id_quiz` int(11) NOT NULL,
  `id_recette` int(11) DEFAULT NULL,
  `Q1` text NOT NULL,
  `rc1` text NOT NULL,
  `rf11` text NOT NULL,
  `rf12` text NOT NULL,
  `rf13` text NOT NULL,
  `Q2` text NOT NULL,
  `rc2` text NOT NULL,
  `rf21` text NOT NULL,
  `rf22` text NOT NULL,
  `rf23` text NOT NULL,
  `Q3` text NOT NULL,
  `rc3` text NOT NULL,
  `rf31` text NOT NULL,
  `rf32` text NOT NULL,
  `rf33` text NOT NULL,
  `archive` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `quiz`
--

INSERT INTO `quiz` (`id_quiz`, `id_recette`, `Q1`, `rc1`, `rf11`, `rf12`, `rf13`, `Q2`, `rc2`, `rf21`, `rf22`, `rf23`, `Q3`, `rc3`, `rf31`, `rf32`, `rf33`, `archive`) VALUES
(3, 6, 'pour préparer un hamburger', 'on a besoin de farineeee', 'on a besoin de sucre', 'on a besoin de beurre', 'on a besoin de chocolat', 'pour cuisiner un hamburger', 'on a besoin de four', 'on a besoin de micro onde', 'on a besoin gaz', 'on a besoin de frigidaire', 'pour 4 hamburger', '500 g de farine', '100 g de farine', '700 g de  farine', '300 g de farine', 0),
(4, 0, 'pour préparer des croissants', 'on a besoin de farine', 'on a besoin de sucre', 'on a besoin de Harissa', 'on a besoin de chocolat', 'pour cuisiner des croissants', 'on a besoin de four', 'on a besoin de micro onde', 'on a besoin gaz', 'on a besoin de frigidaire', 'pour un petit dej familiale', '500 g de farine', '100 g de farine', '700 g de  farine', '800 g de farine', 0),
(8, 8, 'pour préparer un lablebi on a besoin de :', 'homs', 'frite', 'hlib', 'farine', 'lablebi est un plat', 'tunisien', 'marocain', 'algerien', 'italen', 'pour cuisiner on a besoin de', 'gaz', 'four', 'barbecuil', 'frigidaire', 0);

-- --------------------------------------------------------

--
-- Structure de la table `recette`
--

CREATE TABLE `recette` (
  `id_recette` int(20) NOT NULL,
  `nom_recette` varchar(20) NOT NULL,
  `photo_recette` varchar(255) NOT NULL,
  `description_recette` varchar(255) NOT NULL,
  `categorie_recette` varchar(20) NOT NULL,
  `duree_recette` int(20) NOT NULL,
  `archive` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `recette`
--

INSERT INTO `recette` (`id_recette`, `nom_recette`, `photo_recette`, `description_recette`, `categorie_recette`, `duree_recette`, `archive`) VALUES
(0, 'pain au choc', 'croissant.jpeg', 'Farine 500g  sucre 50g  sel12g jaune d oeuif lai', 'petit Dej', 60, 0),
(6, 'Hamburger', 'hamburger.jpeg', '500 g de farine 100 ml de lait 1 oeuf 1 c. à café de sel 3 c. à café de sucre', 'Dejeuner', 30, 0),
(7, 'spaghetti', 'spaghetti.jpeg', '500 g de spaghetti	2 c. à soupe huile1 gousse ail1 pincée de thymSel poivre', 'Diner', 15, 0),
(8, 'lablebi', 'lablebi.jpeg', 'thon oeuf homs hrisa ziit', 'Dejeuner', 30, 0);

-- --------------------------------------------------------

--
-- Structure de la table `recherche`
--

CREATE TABLE `recherche` (
  `id` int(11) NOT NULL,
  `nom_gerant` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom_user` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `reservation`
--

CREATE TABLE `reservation` (
  `id_reservation` int(20) NOT NULL,
  `date_reservation` date NOT NULL,
  `nbPlace_reservation` int(20) NOT NULL,
  `id_restaurant` int(11) DEFAULT NULL,
  `id_user` int(20) NOT NULL,
  `archive` int(11) NOT NULL,
  `nom_resto` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `adresse` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `reservation`
--

INSERT INTO `reservation` (`id_reservation`, `date_reservation`, `nbPlace_reservation`, `id_restaurant`, `id_user`, `archive`, `nom_resto`, `image`, `adresse`) VALUES
(40, '2023-01-01', 1, 35, 1, 0, 'Ha food', 'aaaaaaa', 'aaaaaaa');

-- --------------------------------------------------------

--
-- Structure de la table `restaurant`
--

CREATE TABLE `restaurant` (
  `id_restaurant` int(20) NOT NULL,
  `nom_restaurant` varchar(255) NOT NULL,
  `adresse_restaurant` varchar(50) NOT NULL,
  `telephone_restaurant` int(20) NOT NULL,
  `siteweb_restaurant` varchar(50) NOT NULL,
  `specialite_restaurant` varchar(20) NOT NULL,
  `id_gerant` int(20) NOT NULL,
  `image` varchar(255) NOT NULL,
  `archive` int(1) DEFAULT NULL,
  `nb_placeResto` int(11) NOT NULL,
  `image_structure_resturant` varchar(255) NOT NULL,
  `description` varchar(100) NOT NULL,
  `lien` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `restaurant`
--

INSERT INTO `restaurant` (`id_restaurant`, `nom_restaurant`, `adresse_restaurant`, `telephone_restaurant`, `siteweb_restaurant`, `specialite_restaurant`, `id_gerant`, `image`, `archive`, `nb_placeResto`, `image_structure_resturant`, `description`, `lien`) VALUES
(35, 'Ha food', 'ariana', 25232526, 'www.Hafood.com', 'Repas Spécial', 2, 'index.jpg', 0, 200, '', 'KFC, PFK au Québec, est une chaîne de restauration', 'http://www.hafood.com'),
(41, 'KFC', 'Marsa, tunis', 94366666, 'www.kfc.tn', 'Fast Food', 2, 'KFC.jpg', 0, 20, 'hhhhhhhh', 'La marque, fondée au milieu du XXᵉ siècle par le colonel Harland Sanders, est connue pour ses recett', 'http://kfc.com'),
(43, 'zaeeaz', 'azeaze', 99999999, 'azeaez', 'azeaez', 2, 'src/tn/edu/esprit/images/e72630d0111bc84aa75e064f1eb615e4.jpg', 1, 5, 'src/tn/edu/esprit/images/phone.png', 'azeaze', 'null'),
(44, 'zefze', 'aze', 22222222, 'aze', 'aze', 2, 'e72630d0111bc84aa75e064f1eb615e4.jpg', 1, 2, 'femme3.jpg', 'aze', 'null');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id_user` int(20) NOT NULL,
  `email_user` varchar(100) NOT NULL,
  `password_user` varchar(20) NOT NULL,
  `nom_user` varchar(20) NOT NULL,
  `prenom_user` varchar(20) NOT NULL,
  `dateNaissance_user` date NOT NULL,
  `sexe_user` varchar(20) NOT NULL,
  `telephone_user` int(20) NOT NULL,
  `photo_user` varchar(100) NOT NULL,
  `description_user` varchar(100) NOT NULL,
  `maxDistance_user` int(20) NOT NULL DEFAULT 50,
  `preferredMinAge_user` int(11) NOT NULL DEFAULT 18,
  `preferredMaxAge_user` int(11) NOT NULL DEFAULT 50,
  `adresse_user` varchar(255) NOT NULL DEFAULT 'x',
  `latitude` double DEFAULT NULL,
  `longitude` double DEFAULT NULL,
  `Interet_user` int(20) NOT NULL DEFAULT 0,
  `archive` int(11) NOT NULL,
  `reset_token` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id_user`, `email_user`, `password_user`, `nom_user`, `prenom_user`, `dateNaissance_user`, `sexe_user`, `telephone_user`, `photo_user`, `description_user`, `maxDistance_user`, `preferredMinAge_user`, `preferredMaxAge_user`, `adresse_user`, `latitude`, `longitude`, `Interet_user`, `archive`, `reset_token`) VALUES
(1, 'yakoubi.marwen@esprit.tn', '1234', 'Marwen', 'Yakoubi', '1998-05-14', 'homme', 94366666, 'marwen.jpg', 'I love lablebi. Et quibusdam accusamus sed voluptas consectetur est temporibus dignissimos?', 50, 18, 35, 'ESPRIT', 36.8991643, 10.1879781, 24122, 0, '8nlj7ok_NZv1_7B4BXWJo75iRWxx0sXloaA6vmvSDNw'),
(2, 'eya.benromdhane@esprit.tn', '1234', 'Eya', 'Benromdhane', '2001-05-12', 'femme', 94366666, 'femme5.jpeg', 'I love sushi. Et quibusdam accusamus sed voluptas consectetur est temporibus dignissimos?', 50, 18, 50, 'ESPRIT', 36.87427, 10.27263, 22211, 0, NULL),
(3, 'sondes@esprit.tn', '1234', 'Sondes', 'kharroubi', '1996-05-14', 'femme', 94366666, 'femme6.jpeg', 'I love hargma. Et quibusdam accusamus sed voluptas consectetur est temporibus dignissimos?', 50, 18, 50, 'ISI', 36.85858, 10.18436, 21422, 0, NULL),
(21, 'wassimbenr@gmail.com', '1234', 'Wassim', 'Ben R', '1985-09-01', 'Homme', 94366666, 'wassim.jpg', 'I love Coffee. Et quibusdam accusamus sed voluptas consectetur est temporibus dignissimos?', 50, 18, 50, 'MSB', 36.800481, 10.187607, 41212, 0, NULL),
(22, 'said@esprit.tn', '1234', 'Said', 'Mohamed', '2022-06-16', 'Homme', 94366666, 'said.jpg', 'I love chawarma. Et quibusdam accusamus sed voluptas consectetur est temporibus dignissimos?', 50, 18, 50, 'ISET Gafsa', 34.42589577900697, 8.777963316936145, 11121, 0, NULL),
(23, 'lina@esprit.tn', '1234', 'Lina', 'Toumi', '2003-03-08', 'Femme', 94366666, 'femme4.jpeg', 'I love Crepe. Et quibusdam accusamus sed voluptas consectetur est temporibus dignissimos?', 50, 18, 50, 'INSAT', 36.91971402746499, 10.282887734817388, 12444, 0, NULL),
(30, 'foulen@esprit.tn', 'Foulen1', 'foulen', 'ben foulen', '1998-06-26', 'homme', 94366666, 'homme1.jpeg', 'I love Pizza', 50, 18, 35, 'Ariana', 36.9685735, 10.1219855, 42222, 0, NULL);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Index pour la table `conversation`
--
ALTER TABLE `conversation`
  ADD PRIMARY KEY (`id_conversation`);

--
-- Index pour la table `evenement`
--
ALTER TABLE `evenement`
  ADD PRIMARY KEY (`id_event`);

--
-- Index pour la table `gerant`
--
ALTER TABLE `gerant`
  ADD PRIMARY KEY (`id_gerant`);

--
-- Index pour la table `interaction`
--
ALTER TABLE `interaction`
  ADD PRIMARY KEY (`id_interaction`),
  ADD KEY `fk_user1_interaction` (`id_user1`),
  ADD KEY `fk_user2_interaction` (`id_user2`);

--
-- Index pour la table `invitation`
--
ALTER TABLE `invitation`
  ADD PRIMARY KEY (`id_invitation`);

--
-- Index pour la table `jeu`
--
ALTER TABLE `jeu`
  ADD PRIMARY KEY (`id_jeu`);

--
-- Index pour la table `matching`
--
ALTER TABLE `matching`
  ADD PRIMARY KEY (`id_match`),
  ADD KEY `fk_user1_matching` (`id_user1`),
  ADD KEY `fk_user2_matching` (`id_user2`);

--
-- Index pour la table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id_message`);

--
-- Index pour la table `quiz`
--
ALTER TABLE `quiz`
  ADD PRIMARY KEY (`id_quiz`),
  ADD KEY `fk_r` (`id_recette`);

--
-- Index pour la table `recette`
--
ALTER TABLE `recette`
  ADD PRIMARY KEY (`id_recette`);

--
-- Index pour la table `recherche`
--
ALTER TABLE `recherche`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`id_reservation`),
  ADD KEY `FK_U` (`id_restaurant`);

--
-- Index pour la table `restaurant`
--
ALTER TABLE `restaurant`
  ADD PRIMARY KEY (`id_restaurant`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `conversation`
--
ALTER TABLE `conversation`
  MODIFY `id_conversation` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `evenement`
--
ALTER TABLE `evenement`
  MODIFY `id_event` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pour la table `gerant`
--
ALTER TABLE `gerant`
  MODIFY `id_gerant` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT pour la table `interaction`
--
ALTER TABLE `interaction`
  MODIFY `id_interaction` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `invitation`
--
ALTER TABLE `invitation`
  MODIFY `id_invitation` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT pour la table `jeu`
--
ALTER TABLE `jeu`
  MODIFY `id_jeu` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT pour la table `matching`
--
ALTER TABLE `matching`
  MODIFY `id_match` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `message`
--
ALTER TABLE `message`
  MODIFY `id_message` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `quiz`
--
ALTER TABLE `quiz`
  MODIFY `id_quiz` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT pour la table `recette`
--
ALTER TABLE `recette`
  MODIFY `id_recette` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT pour la table `recherche`
--
ALTER TABLE `recherche`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `id_reservation` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT pour la table `restaurant`
--
ALTER TABLE `restaurant`
  MODIFY `id_restaurant` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `interaction`
--
ALTER TABLE `interaction`
  ADD CONSTRAINT `FK_378DFDA762D4C465` FOREIGN KEY (`id_user1`) REFERENCES `user` (`id_user`),
  ADD CONSTRAINT `FK_378DFDA7FBDD95DF` FOREIGN KEY (`id_user2`) REFERENCES `user` (`id_user`);

--
-- Contraintes pour la table `matching`
--
ALTER TABLE `matching`
  ADD CONSTRAINT `fk_user1_matching` FOREIGN KEY (`id_user1`) REFERENCES `user` (`id_user`),
  ADD CONSTRAINT `fk_user2_matching` FOREIGN KEY (`id_user2`) REFERENCES `user` (`id_user`);

--
-- Contraintes pour la table `quiz`
--
ALTER TABLE `quiz`
  ADD CONSTRAINT `FK_A412FA929726CAE0` FOREIGN KEY (`id_recette`) REFERENCES `recette` (`id_recette`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `FK_U` FOREIGN KEY (`id_restaurant`) REFERENCES `restaurant` (`id_restaurant`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
