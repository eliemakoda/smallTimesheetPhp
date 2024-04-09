-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 04 avr. 2024 à 11:04
-- Version du serveur : 10.4.27-MariaDB
-- Version de PHP : 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `timesheet`
--

-- --------------------------------------------------------

--
-- Structure de la table `administrateur`
--

CREATE TABLE `administrateur` (
  `idAdmin` int(11) NOT NULL,
  `nomAdmin` varchar(255) NOT NULL,
  `emailAdmin` varchar(255) NOT NULL,
  `DateNaissAdmin` varchar(255) NOT NULL,
  `BioAdmin` text NOT NULL,
  `ExperienceAdmin` text NOT NULL,
  `CompetenceAdmin` text NOT NULL,
  `passwordAdmin` varchar(255) NOT NULL,
  `statutAdmin` int(11) DEFAULT 1,
  `ImageAdmin` varchar(255) NOT NULL,
  `DateAjoutAdmin` datetime NOT NULL DEFAULT current_timestamp(),
  `NombreProjetAdmin` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='cette table correspond aux admin de  MyTimesheet';

--
-- Déchargement des données de la table `administrateur`
--

INSERT INTO `administrateur` (`idAdmin`, `nomAdmin`, `emailAdmin`, `DateNaissAdmin`, `BioAdmin`, `ExperienceAdmin`, `CompetenceAdmin`, `passwordAdmin`, `statutAdmin`, `ImageAdmin`, `DateAjoutAdmin`, `NombreProjetAdmin`) VALUES
(1, 'Elie Makoda', 'eliemakodakowo@gmail.com', '2003-03-27', '<h2>hey Guys!</h2><p>i\'m call <strong>Elie Makoda Kowo</strong> and i\'m a<strong> junior Data Scientist</strong> and <strong>software developper</strong>.</p><p>&nbsp; &nbsp; &nbsp; &nbsp;I am a highly skilled<strong> software developer </strong>with a passion for <strong>AI and data science</strong> projects. With a strong background in programming languages and a keen eye for detail,</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;I excel at creating innovative solutions that push the boundaries of technology.</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;My dedication to staying current with the latest advancements in the field allows me to deliver cutting-edge results that exceed expectations.</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;I thrive in fast-paced environments and am always eager to tackle new challenges head-on. With a proven track record of success in developing software and implementing AI and data science projects,</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;I am confident in my ability to drive impactful change and deliver exceptional results. Let\'s collaborate and bring your ideas to life!</p>', 'I worked with some Enterprises as software developper and junior datascientist such as Emako Tech', '#python, #javascript,#php, #tensorflow', 'eliemakodakowo@gmail.com', 1, 'IMG-20211117-WA0050.jpg', '2024-04-02 00:00:00', 1);

-- --------------------------------------------------------

--
-- Structure de la table `approbation`
--

CREATE TABLE `approbation` (
  `idApprobation` int(11) NOT NULL,
  `statutApprobation` int(11) DEFAULT 0,
  `IdClientApprob` int(255) NOT NULL,
  `IdProjetApprobation` int(255) NOT NULL,
  `DateApprobation` datetime DEFAULT current_timestamp(),
  `IdAdminApprobation` int(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `approbation`
--

INSERT INTO `approbation` (`idApprobation`, `statutApprobation`, `IdClientApprob`, `IdProjetApprobation`, `DateApprobation`, `IdAdminApprobation`) VALUES
(1, 1, 1, 1, '2024-04-03 15:26:51', 1);

-- --------------------------------------------------------

--
-- Structure de la table `commentaires`
--

CREATE TABLE `commentaires` (
  `idCommentaire` int(11) NOT NULL,
  `contenuCommentaire` text NOT NULL,
  `idUSer` int(255) NOT NULL,
  `idProjet` int(255) NOT NULL,
  `DateCommentaire` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `projet`
--

CREATE TABLE `projet` (
  `idProjet` int(11) NOT NULL,
  `nomProjet` varchar(255) NOT NULL,
  `descriptionProjet` text NOT NULL,
  `dateDebutProjet` varchar(255) NOT NULL,
  `dateFinProjet` varchar(255) NOT NULL,
  `statutProjet` int(255) NOT NULL DEFAULT 0,
  `PrixProjet` int(255) NOT NULL,
  `idUser` int(255) DEFAULT NULL,
  `idAdmin` int(155) NOT NULL,
  `DateAjoutProjet` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `projet`
--

INSERT INTO `projet` (`idProjet`, `nomProjet`, `descriptionProjet`, `dateDebutProjet`, `dateFinProjet`, `statutProjet`, `PrixProjet`, `idUser`, `idAdmin`, `DateAjoutProjet`) VALUES
(1, 'automatisation des services de ventes en ligne ', '<p><a href=\"http://localhost/timesheet/admin/task/AjoutTache.php\">http://localhost/timesheet/admin/task/AjoutTache.php</a> se referer à cette url pour plus de détails sur le projet et son implémentation</p>', '2024-04-11', '2024-04-30', 2, 25000, 1, 1, '2024-04-03 00:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `idUSer` int(11) NOT NULL,
  `nomUSer` varchar(255) NOT NULL,
  `emailUSer` varchar(255) NOT NULL,
  `DateNaissUSer` varchar(255) NOT NULL,
  `BioUSer` text NOT NULL,
  `ExperienceUSer` text NOT NULL,
  `CompetenceUSer` text NOT NULL,
  `passwordUSer` varchar(255) NOT NULL,
  `statutUSer` int(11) DEFAULT 1,
  `ImageUSer` varchar(255) NOT NULL,
  `DateAjoutUSer` datetime NOT NULL DEFAULT current_timestamp(),
  `NombreProjetUSer` int(11) DEFAULT 0,
  `GainsUser` int(12) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='cette table correspond aux utilisateurs  de  MyTimesheet';

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`idUSer`, `nomUSer`, `emailUSer`, `DateNaissUSer`, `BioUSer`, `ExperienceUSer`, `CompetenceUSer`, `passwordUSer`, `statutUSer`, `ImageUSer`, `DateAjoutUSer`, `NombreProjetUSer`, `GainsUser`) VALUES
(1, 'Emako Tech', 'emakotech@gmail.com', '2003-03-27', '<p>Hi Guys!</p><p>i\'m called<strong> Elie Makoda Kowo</strong> abreviated as <strong>EMAKO</strong></p><p>&nbsp; &nbsp; I am a highly<strong> skilled software developer</strong> with a passion for <strong>AI and data science projects</strong>. With a strong background in <strong>programming languages</strong> and a keen eye for detail,</p><p>&nbsp; &nbsp; &nbsp; I excel at creating innovative solutions that push the boundaries of technology</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;My dedication to staying current with the latest advancements in the field allows me to deliver cutting-edge results that exceed expectations.</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;I thrive in fast-paced environments and am always eager to tackle new challenges head-on. With a proven track record of success in developing software and implementing AI and data science projects,</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;I am confident in my ability to drive impactful change and deliver exceptional results. Let\'s collaborate and bring your ideas to life!</p>', 'I worked with some Enterprises as software developper and junior datascientist such as  Makoda Komputer', '#python, #javascript,#php, #tensorflow #scikit-learn #java', 'emakotech@gmail.com', 1, 'IMG-20211016-WA0002.jpg', '2024-04-02 00:00:00', 1, 25000);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `administrateur`
--
ALTER TABLE `administrateur`
  ADD PRIMARY KEY (`idAdmin`);

--
-- Index pour la table `approbation`
--
ALTER TABLE `approbation`
  ADD PRIMARY KEY (`idApprobation`);

--
-- Index pour la table `commentaires`
--
ALTER TABLE `commentaires`
  ADD PRIMARY KEY (`idCommentaire`);

--
-- Index pour la table `projet`
--
ALTER TABLE `projet`
  ADD PRIMARY KEY (`idProjet`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`idUSer`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `administrateur`
--
ALTER TABLE `administrateur`
  MODIFY `idAdmin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `approbation`
--
ALTER TABLE `approbation`
  MODIFY `idApprobation` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `commentaires`
--
ALTER TABLE `commentaires`
  MODIFY `idCommentaire` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `projet`
--
ALTER TABLE `projet`
  MODIFY `idProjet` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `idUSer` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
