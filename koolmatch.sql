-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le : mar. 12 avr. 2022 à 04:04
-- Version du serveur : 5.7.34
-- Version de PHP : 7.4.21

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
  `archive` int(8) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `admin`
--

INSERT INTO `admin` (`id_admin`, `login_admin`, `password_admin`, `archive`) VALUES
(1, 'matchkool@gmail.com', '1234', 0);

-- --------------------------------------------------------

--
-- Structure de la table `conversation`
--

CREATE TABLE `conversation` (
  `id_conversation` int(20) NOT NULL,
  `titre_conversation` varchar(20) NOT NULL,
  `id_user1` int(20) NOT NULL,
  `id_user2` int(20) NOT NULL,
  `archive` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `conversation`
--

INSERT INTO `conversation` (`id_conversation`, `titre_conversation`, `id_user1`, `id_user2`, `archive`) VALUES
(1, 'Eya', 2, 3, 0);

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
  `archive` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `evenement`
--

INSERT INTO `evenement` (`id_event`, `nom_event`, `dd_event`, `df_event`, `theme_event`, `adresse_event`, `telephone`, `archive`) VALUES
(6, 'scary night', '2022-02-14', '2022-02-15', 'halloween ', 'esprit', 99485632, 0),
(10, 'movie night', '2022-03-04', '2022-03-10', 'cinema ', 'pathe , tunis city', 99747824, 0),
(11, 'pizza party', '2022-03-11', '2022-03-12', 'pizza', 'Pizza Hut, 90، 2 Av.', 25698741, 0),
(12, 'jazz fest', '2022-03-25', '2022-03-25', 'music', 'theatre de carthage ', 78256987, 0);

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
  `archive` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `gerant`
--

INSERT INTO `gerant` (`id_gerant`, `nom_gerant`, `prenom_gerant`, `email_gerant`, `password_gerant`, `telephone_gerant`, `dd_abonnement`, `df_abonnement`, `archive`) VALUES
(2, 'khaled', 'ben ammar', 'khaledbenammar@esprit.tn', '1234', 25236212, '2022-03-01', '2022-03-31', 0),
(20, 'Asma', 'Ben Brahim', 'asmabenbrahim@esprit.tn', '1234', 23212526, '2022-03-01', '2022-03-31', 0);

-- --------------------------------------------------------

--
-- Structure de la table `interaction`
--

CREATE TABLE `interaction` (
  `id_interaction` int(20) NOT NULL,
  `type_interaction` varchar(20) NOT NULL,
  `date_interaction` date NOT NULL,
  `id_user1` int(11) NOT NULL,
  `id_user2` int(11) NOT NULL,
  `archive` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `interaction`
--

INSERT INTO `interaction` (`id_interaction`, `type_interaction`, `date_interaction`, `id_user1`, `id_user2`, `archive`) VALUES
(39, 'o', '2017-04-12', 1, 1, 0),
(40, 'o', '2022-04-12', 1, 2, 0),
(41, 'o', '2022-04-12', 1, 1, 0),
(42, 'o', '2022-04-12', 1, 2, 0),
(45, 'o', '2022-04-12', 1, 2, 0);

-- --------------------------------------------------------

--
-- Structure de la table `invitation`
--

CREATE TABLE `invitation` (
  `id_invitation` int(20) NOT NULL,
  `nom_event` varchar(255) NOT NULL,
  `id_user` int(11) NOT NULL,
  `archive` int(1) NOT NULL DEFAULT '0'
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
(17, 'jazz fest', 2, 0);

-- --------------------------------------------------------

--
-- Structure de la table `jeu`
--

CREATE TABLE `jeu` (
  `id_jeu` int(20) NOT NULL,
  `score_jeu` int(20) NOT NULL,
  `id_quiz` int(20) NOT NULL,
  `id_user` int(11) NOT NULL,
  `archive` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `jeu`
--

INSERT INTO `jeu` (`id_jeu`, `score_jeu`, `id_quiz`, `id_user`, `archive`) VALUES
(1, 8, 6, 1, 0),
(2, 8, 6, 1, 0),
(3, 25, 6, 2, 0),
(4, 80, 6, 3, 0),
(5, 60, 6, 3, 0),
(6, 100, 6, 2, 0),
(7, 130, 6, 3, 0),
(8, 200, 6, 2, 0),
(9, 0, 3, 1, 0),
(10, 20, 1, 1, 0);

-- --------------------------------------------------------

--
-- Structure de la table `matching`
--

CREATE TABLE `matching` (
  `id_match` int(20) NOT NULL,
  `id_user1` int(20) NOT NULL,
  `id_user2` int(20) NOT NULL,
  `date_matching` date NOT NULL,
  `archive` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `matching`
--

INSERT INTO `matching` (`id_match`, `id_user1`, `id_user2`, `date_matching`, `archive`) VALUES
(2, 1, 2, '2022-03-09', 0);

-- --------------------------------------------------------

--
-- Structure de la table `message`
--

CREATE TABLE `message` (
  `id_message` int(20) NOT NULL,
  `msg_message` varchar(100) NOT NULL,
  `date_message` date NOT NULL,
  `id_conversation` int(20) NOT NULL,
  `archive` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `quiz`
--

CREATE TABLE `quiz` (
  `id_quiz` int(11) NOT NULL,
  `id_jeu` int(11) NOT NULL,
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
  `archive` int(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `quiz`
--

INSERT INTO `quiz` (`id_quiz`, `id_jeu`, `Q1`, `rc1`, `rf11`, `rf12`, `rf13`, `Q2`, `rc2`, `rf21`, `rf22`, `rf23`, `Q3`, `rc3`, `rf31`, `rf32`, `rf33`, `archive`) VALUES
(1, 6, 'aa', 'dd', 'rf11aa', 'rf12zze', 'rf13ee', 'dd', 'r', 'z', 'zz', 'ee', 'q3z', 's', 'rr', 'd', 'd', 1),
(2, 0, 'pour préparer une Spaghetti', 'on a besoin de sel', 'on a besoin de sucre', 'on a besoin de beurre', 'on a besoin de chocolat', 'pour cuisiner une spaghetti', 'on a besoin du gaz', 'on a besoin de micro onde', 'on a besoin de four', 'on a besoin de frigidaire', 'pour un plat de 4 personne', '500 g de spaghetti', '100 g de spaghetti', '700 g de spaghetti', '300 g de spaghetti', 0),
(3, 0, 'pour préparer un hamburger', 'on a besoin de farine', 'on a besoin de sucre', 'on a besoin de beurre', 'on a besoin de chocolat', 'pour cuisiner un hamburger', 'on a besoin de four', 'on a besoin de micro onde', 'on a besoin gaz', 'on a besoin de frigidaire', 'pour 4 hamburger', '500 g de farine', '100 g de farine', '700 g de  farine', '300 g de farine', 0),
(4, 0, 'pour préparer des croissants', 'on a besoin de farine', 'on a besoin de sucre', 'on a besoin de Harissa', 'on a besoin de chocolat', 'pour cuisiner des croissants', 'on a besoin de four', 'on a besoin de micro onde', 'on a besoin gaz', 'on a besoin de frigidaire', 'pour un petit dej familiale', '500 g de farine', '100 g de farine', '700 g de  farine', '300 g de farine', 1),
(5, 0, 'pour préparer des croissants', 'on a besoin de farine', 'on a besoin de sucre', 'on a besoin de Harissa', 'on a besoin de chocolat', 'pour cuisiner des croissants', 'on a besoin de four', 'on a besoin de micro onde', 'on a besoin gaz', 'on a besoin de frigidaire', 'pour un petit dej familiale', '500 g de farine', '100 g de farine', '700 g de  farine', '300 g de farine', 0);

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
  `archive` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `recette`
--

INSERT INTO `recette` (`id_recette`, `nom_recette`, `photo_recette`, `description_recette`, `categorie_recette`, `duree_recette`, `archive`) VALUES
(4, 'Croissant', 'src/tn/edu/esprit/images/croissants-maison.jpg', 'Farine 500g  sucre 50g  sel12g jaune d oeuif lai\n', 'petit Dej', 60, 1),
(5, 'Croissant', 'src/tn/edu/esprit/images/croissants-maison.jpg', 'Farine 500g  sucre 50g  sel12g \n', 'petit Dej', 60, 0),
(6, 'hamburger', 'src/tn/edu/esprit/images/hamburger.jpg', '500 g de farine 100 ml de lait 1 oeuf 1 c. à café de sel 3 c. à café de sucre', 'Dejeuner', 25, 0),
(7, 'spaghetti', 'src/tn/edu/esprit/images/spaghetti.jpeg', '500 g de spaghetti	2 c. à soupe huile\n1 gousse ail\n1 pincée de thym\nSel poivre\n', 'Diner', 15, 0),
(8, 'lablebi', 'src/tn/edu/esprit/images/lablebi.jpg', 'thon oeuf homs hrisa ziit', 'Dejeuner', 30, 0);

-- --------------------------------------------------------

--
-- Structure de la table `reservation`
--

CREATE TABLE `reservation` (
  `id_reservation` int(20) NOT NULL,
  `date_reservation` date NOT NULL,
  `nbPlace_reservation` int(20) NOT NULL,
  `id_restaurant` int(20) NOT NULL,
  `id_user` int(20) NOT NULL,
  `archive` int(1) NOT NULL DEFAULT '0',
  `nom_resto` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `adresse` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `reservation`
--

INSERT INTO `reservation` (`id_reservation`, `date_reservation`, `nbPlace_reservation`, `id_restaurant`, `id_user`, `archive`, `nom_resto`, `image`, `adresse`) VALUES
(2, '2022-03-10', 50, 22, 1, 0, 'KFC', 'src/tn/edu/esprit/images/téléchargement (1).png', 'aouina'),
(3, '2022-03-10', 2, 23, 2, 0, 'Ha food', 'src/tn/edu/esprit/images/téléchargement.jfif', 'ariena'),
(4, '2022-03-11', 1, 23, 2, 0, 'Ha food', 'src/tn/edu/esprit/images/téléchargement.jfif', 'ariena'),
(5, '2022-03-12', 3, 23, 2, 0, 'Ha food', 'src/tn/edu/esprit/images/téléchargement.jfif', 'ariena'),
(6, '2022-03-14', 8, 23, 2, 0, 'Ha food', 'src/tn/edu/esprit/images/téléchargement.jfif', 'ariena');

-- --------------------------------------------------------

--
-- Structure de la table `restaurant`
--

CREATE TABLE `restaurant` (
  `id_restaurant` int(20) NOT NULL,
  `nom_restaurant` varchar(20) NOT NULL,
  `adresse_restaurant` varchar(50) NOT NULL,
  `telephone_restaurant` int(20) NOT NULL,
  `siteweb_restaurant` varchar(50) NOT NULL,
  `specialite_restaurant` varchar(20) NOT NULL,
  `id_gerant` int(20) NOT NULL,
  `image` varchar(50) NOT NULL,
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
(21, 'Barbarous', 'Hamemet', 28751223, 'www.barbarous.tn', 'Repas', 2, 'src/tn/edu/esprit/images/téléchargement (2).png', 0, 87, 'src/tn/edu/esprit/images/null', 'welcome ', 'https://www.youtube.com/watch?v=6m0zz0eGp-I&t=42s'),
(22, 'KFC', 'aouina', 55552007, 'www.kfc.com', 'Repas américan', 2, 'src/tn/edu/esprit/images/téléchargement (1).png', 0, 100, 'src/tn/edu/esprit/images/null', 'salut', 'https://www.youtube.com/watch?v=MM7HzVXOmOE'),
(23, 'Ha food', 'ariena', 25262325, 'www.hafood.com', 'Fast Food', 20, 'src/tn/edu/esprit/images/téléchargement.jfif', 0, 25, 'src/tn/edu/esprit/images/null', 'Bienvenue', 'https://www.youtube.com/watch?v=EmQ_q3IcpP4');

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
  `maxDistance_user` int(20) NOT NULL,
  `preferredMinAge_user` int(20) NOT NULL,
  `preferredMaxAge_user` int(20) NOT NULL,
  `adresse_user` varchar(255) NOT NULL DEFAULT 'x',
  `latitude` double NOT NULL,
  `longitude` double NOT NULL,
  `Interet_user` int(20) NOT NULL,
  `archive` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id_user`, `email_user`, `password_user`, `nom_user`, `prenom_user`, `dateNaissance_user`, `sexe_user`, `telephone_user`, `photo_user`, `description_user`, `maxDistance_user`, `preferredMinAge_user`, `preferredMaxAge_user`, `adresse_user`, `latitude`, `longitude`, `Interet_user`, `archive`) VALUES
(1, 'yakoubi.marwen@esprit.tn', '1234', 'Marwen', 'Yakoubi', '1998-05-14', 'homme', 29163283, 'marwen.jpg', 'I love lablebi', 50, 18, 35, 'Ariana Essoughra', 36.90138, 10.19012, 24122, 0),
(2, 'eya.benromdhane@esprit.tn', '1234', 'Eya', 'Benromdhane', '2010-05-12', 'femme', 94366666, 'femme1.jpeg', 'I love sushi', 20, 20, 28, 'Soukra', 36.87427, 10.27263, 22211, 0),
(3, 'sondes@esprit.tn', '1234', 'Sondes', 'kharroubi', '1998-05-14', 'femme', 29163283, 'femme3.jpg', 'I love hargma', 10, 20, 28, 'Ariana', 36.85858, 10.18436, 21422, 0),
(21, 'wassimbenr@gmail.com', '1234', 'Wassim', 'Ben R', '1998-09-01', 'Homme', 94366666, 'marwen.jpg', 'I love Coffee', 80, 30, 58, 'Laouina', 36.85853401864276, 10.25627057556146, 41212, 0),
(22, 'said@esprit.tn', '1234', 'Said', 'Mohamed', '1999-06-16', 'Homme', 29932123, 'femme1.jpeg', 'I love chawarma', 55, 18, 24, 'Gafsa', 34.42589577900697, 8.777963316936145, 11121, 0),
(23, 'lina@esprit.tn', '1234', 'Lina', 'Toumi', '1999-03-08', 'Femme', 94377345, 'femme3.jpg', 'I love Crepe', 20, 21, 25, 'Gammarth', 36.91971402746499, 10.282887734817388, 12444, 0);

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
  ADD PRIMARY KEY (`id_interaction`);

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
  ADD PRIMARY KEY (`id_match`);

--
-- Index pour la table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id_message`);

--
-- Index pour la table `quiz`
--
ALTER TABLE `quiz`
  ADD PRIMARY KEY (`id_quiz`);

--
-- Index pour la table `recette`
--
ALTER TABLE `recette`
  ADD PRIMARY KEY (`id_recette`);

--
-- Index pour la table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`id_reservation`);

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
  MODIFY `id_conversation` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `evenement`
--
ALTER TABLE `evenement`
  MODIFY `id_event` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `gerant`
--
ALTER TABLE `gerant`
  MODIFY `id_gerant` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT pour la table `interaction`
--
ALTER TABLE `interaction`
  MODIFY `id_interaction` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT pour la table `invitation`
--
ALTER TABLE `invitation`
  MODIFY `id_invitation` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT pour la table `jeu`
--
ALTER TABLE `jeu`
  MODIFY `id_jeu` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `matching`
--
ALTER TABLE `matching`
  MODIFY `id_match` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `message`
--
ALTER TABLE `message`
  MODIFY `id_message` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `quiz`
--
ALTER TABLE `quiz`
  MODIFY `id_quiz` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `recette`
--
ALTER TABLE `recette`
  MODIFY `id_recette` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `id_reservation` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `restaurant`
--
ALTER TABLE `restaurant`
  MODIFY `id_restaurant` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
