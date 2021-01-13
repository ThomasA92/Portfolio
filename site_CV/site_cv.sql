-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 15 déc. 2020 à 12:06
-- Version du serveur :  10.4.14-MariaDB
-- Version de PHP : 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `site_cv`
--

-- --------------------------------------------------------

--
-- Structure de la table `competences`
--

CREATE TABLE `competences` (
  `id_competence` int(11) NOT NULL,
  `nom_comp` varchar(50) NOT NULL,
  `progress` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `competences`
--

INSERT INTO `competences` (`id_competence`, `nom_comp`, `progress`) VALUES
(1, 'HTML5/CSS3', '90'),
(2, 'JavaScript', '70'),
(3, 'Angular', '35'),
(4, 'PHP procédural', '80'),
(5, 'PHP orienté Objet', '50'),
(6, 'Symfony', '40'),
(7, 'Bootstrap', '90'),
(8, 'WordPress', '70'),
(9, 'VueJs', '30');

-- --------------------------------------------------------

--
-- Structure de la table `experiences`
--

CREATE TABLE `experiences` (
  `id_experience` int(11) NOT NULL,
  `annee_exp` varchar(15) NOT NULL,
  `desc_exp` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `experiences`
--

INSERT INTO `experiences` (`id_experience`, `annee_exp`, `desc_exp`) VALUES
(3, '2020', 'Développeur/Intégrateur Web - Création de sites web en HTML/CSS,JavaScript ,WordPress et PHP.'),
(4, '2017-2019', 'Traduction texte pour particuliers(fanfiction,nouvelles,articles\r\nprincipalement) anglais => français.'),
(5, '2016-2019', 'Installation et entretien d\'équipement informatique pour\r\nparticuliers.'),
(6, '2015', 'Assistant comptabilité, Société Générale (Orléans)'),
(7, '2013', 'Equipier Polyvalent, Mcdonald\'s (Orléans)');

-- --------------------------------------------------------

--
-- Structure de la table `formations`
--

CREATE TABLE `formations` (
  `id_formation` int(11) NOT NULL,
  `annee_for` varchar(50) NOT NULL,
  `desc_for` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `formations`
--

INSERT INTO `formations` (`id_formation`, `annee_for`, `desc_for`) VALUES
(3, '2020', 'Développeur web / intégrateur web - Formation du PoleS à double certification WebForce3.'),
(4, '2018', 'Open Classrooms - HTML 5 / CSS 3, Introduction à WordPress(côté développeur)'),
(5, '2013 - 2018', 'Autodidacte(auto-formations) sur divers sujets - Informatique, Moocs ou cours en ligne divers, montage vidéo(niveau débutant),applications mobiles.'),
(6, '2010 - 2012', 'Université - L1 et L2 MEA, Management des Entreprises et des Administrations.'),
(7, '2010', ' Baccalauréat ES - Economique et Social.');

-- --------------------------------------------------------

--
-- Structure de la table `membre`
--

CREATE TABLE `membre` (
  `id_membre` int(3) NOT NULL,
  `pseudo` varchar(50) NOT NULL,
  `mdp` varchar(255) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `age` int(3) NOT NULL,
  `pays` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `membre`
--

INSERT INTO `membre` (`id_membre`, `pseudo`, `mdp`, `prenom`, `nom`, `email`, `age`, `pays`) VALUES
(4, 'Tridh', 'tridhmdp', 'Thomas', 'Andy', 'tridh@mail.fr', 29, 'France'),
(5, 'Tridh', 'm3Nju128', 'Thomas', 'Andy', 'tridh@mail.fr', 29, 'France');

-- --------------------------------------------------------

--
-- Structure de la table `realisations`
--

CREATE TABLE `realisations` (
  `id_realisation` int(11) NOT NULL,
  `titre` varchar(50) NOT NULL,
  `intro` varchar(50) NOT NULL,
  `img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `realisations`
--

INSERT INTO `realisations` (`id_realisation`, `titre`, `intro`, `img`) VALUES
(1, 'Projet 1', 'Réalisé en HTML / CSS', 'assets/img/12042020103218maq2.jpg'),
(2, 'Projet 2', 'Réalisé en HTML / CSS', 'assets/img/fiascoresto.png'),
(3, 'Projet 3', 'Réalisé en HTML / CSS', 'assets/img/12042020153050maq3.jpg'),
(4, 'Projet 4', 'Galerie d\'image JS', 'assets/img/12152020112307Firefox_Screenshot_2020-12-15T07-22-21.623Z.png'),
(5, 'Projet 5', 'Formulaire d\'inscription JavaScript', 'assets/img/Firefox_Screenshot_2020-12-15T07-23-39.149Z.png'),
(6, 'Projet 6', 'HTML / CSS', 'assets/img/BLOG8TEST.png'),
(7, 'Projet 7', 'fait avec HTML / CSS', 'assets/img/lebilan.png'),
(8, 'Projet 8', 'Site multipage HTML/CSS', 'assets/img/site_multipage.png');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `competences`
--
ALTER TABLE `competences`
  ADD PRIMARY KEY (`id_competence`);

--
-- Index pour la table `experiences`
--
ALTER TABLE `experiences`
  ADD PRIMARY KEY (`id_experience`);

--
-- Index pour la table `formations`
--
ALTER TABLE `formations`
  ADD PRIMARY KEY (`id_formation`);

--
-- Index pour la table `membre`
--
ALTER TABLE `membre`
  ADD PRIMARY KEY (`id_membre`);

--
-- Index pour la table `realisations`
--
ALTER TABLE `realisations`
  ADD PRIMARY KEY (`id_realisation`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `competences`
--
ALTER TABLE `competences`
  MODIFY `id_competence` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `experiences`
--
ALTER TABLE `experiences`
  MODIFY `id_experience` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `formations`
--
ALTER TABLE `formations`
  MODIFY `id_formation` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `membre`
--
ALTER TABLE `membre`
  MODIFY `id_membre` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `realisations`
--
ALTER TABLE `realisations`
  MODIFY `id_realisation` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
