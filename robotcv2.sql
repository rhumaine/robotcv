-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 03 fév. 2023 à 11:16
-- Version du serveur : 10.4.21-MariaDB
-- Version de PHP : 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `robotcv2`
--
CREATE DATABASE IF NOT EXISTS `robotcv2` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `robotcv2`;

-- --------------------------------------------------------

--
-- Structure de la table `candidat`
--

CREATE TABLE `candidat` (
  `ID_Candidat` int(11) NOT NULL COMMENT 'Identifiant du candidat',
  `Profil` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `Prenom` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Prénom du candidat',
  `Nom` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Nom du candidat',
  `Email` varchar(200) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Email du candidat',
  `Telephone` varchar(10) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Téléphone du candidat',
  `Poste` varchar(200) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Poste auquel le candidat postule',
  `Annees_experience` int(11) NOT NULL COMMENT 'Nombre d''années d''expérience du candidat',
  `ID_Recherche` int(11) DEFAULT NULL COMMENT 'Identifiant de l''étape de recherche'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `candidat`
--

INSERT INTO `candidat` (`ID_Candidat`, `Profil`, `Prenom`, `Nom`, `Email`, `Telephone`, `Poste`, `Annees_experience`, `ID_Recherche`) VALUES
(1, 'rde', 'Romain', 'DEMAY', 'romain.demay56@gmail.com', '0670601589', 'Développeur web', 3, 1);

-- --------------------------------------------------------

--
-- Structure de la table `candidat_certification`
--

CREATE TABLE `candidat_certification` (
  `ID_Candidat` int(11) NOT NULL COMMENT 'Identifiant du candidat',
  `ID_Certification` int(11) NOT NULL COMMENT 'Identifiant de la certification'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `candidat_connaissance`
--

CREATE TABLE `candidat_connaissance` (
  `ID_Candidat` int(11) NOT NULL COMMENT 'Identifiant du candidat',
  `ID_Connaissance` int(11) NOT NULL COMMENT 'Identifiant de la connaissance technique'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `candidat_formation`
--

CREATE TABLE `candidat_formation` (
  `ID_Candidat` int(11) NOT NULL COMMENT 'Identifiant du candidat',
  `ID_Formation` int(11) NOT NULL COMMENT 'Identifiant de la formation',
  `Date_formation` date NOT NULL COMMENT 'Date d''obtention du diplome'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `candidat_langue`
--

CREATE TABLE `candidat_langue` (
  `ID_Candidat` int(11) NOT NULL COMMENT 'Identifiant du candidat',
  `ID_Langue` int(11) NOT NULL COMMENT 'Identifiant de la langue',
  `ID_Niveau` int(11) NOT NULL COMMENT 'Identifiant du niveau'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `certification`
--

CREATE TABLE `certification` (
  `ID_Certification` int(11) NOT NULL COMMENT 'Identifiant de la certification',
  `Certification` varchar(200) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Nom de la certification',
  `Logo_certification` text COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Lien vers le logo de la certification'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `certification`
--

INSERT INTO `certification` (`ID_Certification`, `Certification`, `Logo_certification`) VALUES
(1, 'Php', NULL),
(2, 'html css', NULL),
(3, 'mysql', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `connaissance`
--

CREATE TABLE `connaissance` (
  `ID_Connaissance` int(11) NOT NULL COMMENT 'Identifiant de la connaissance technique',
  `Connaissance` varchar(200) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Connaissance technique',
  `ID_Domaine` int(11) NOT NULL COMMENT 'Identifiant du domaine de la connaissance'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `domaine`
--

CREATE TABLE `domaine` (
  `ID_Domaine` int(11) NOT NULL COMMENT 'Identifiant du domaine',
  `Domaine` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Domaine technique'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `domaine`
--

INSERT INTO `domaine` (`ID_Domaine`, `Domaine`) VALUES
(3, 'BDD'),
(6, 'Bureautique'),
(4, 'Langages'),
(5, 'Logiciels'),
(7, 'Réseaux'),
(1, 'Systèmes'),
(2, 'Virtualisation');

-- --------------------------------------------------------

--
-- Structure de la table `experience_professionnelle`
--

CREATE TABLE `experience_professionnelle` (
  `ID_Experience` int(11) NOT NULL COMMENT 'Identifiant de l''expérience professionnelle',
  `ID_Candidat` int(11) NOT NULL COMMENT 'Identifiant du candidat',
  `Entreprise` varchar(200) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Nom de l''entreprise',
  `Date_debut` date NOT NULL COMMENT 'Date de début de la mission',
  `Date_fin` date DEFAULT NULL COMMENT 'Date de fin de la mission',
  `Poste` varchar(200) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Poste au sein de l''entreprise',
  `Lieu` varchar(200) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Lieu de la mission',
  `Description` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'Description de la mission',
  `Elements_cles` text COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Eléments clés de la mission',
  `Environnement` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'Description de l''environnement de travail'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `formation`
--

CREATE TABLE `formation` (
  `ID_Formation` int(11) NOT NULL COMMENT 'Identifiant de la formation',
  `Formation` varchar(200) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Le nom de la formation',
  `Institution` varchar(200) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Institution délivrant le diplome'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `langue`
--

CREATE TABLE `langue` (
  `ID_Langue` int(11) NOT NULL COMMENT 'Identifiant de la langue',
  `Langue` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Langue'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `langue`
--

INSERT INTO `langue` (`ID_Langue`, `Langue`) VALUES
(4, 'Allemand'),
(1, 'Anglais'),
(3, 'Espagnol'),
(2, 'Français');

-- --------------------------------------------------------

--
-- Structure de la table `messenger_messages`
--

CREATE TABLE `messenger_messages` (
  `id` bigint(20) NOT NULL,
  `body` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `headers` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue_name` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `available_at` datetime NOT NULL,
  `delivered_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `niveau`
--

CREATE TABLE `niveau` (
  `ID_Niveau` int(11) NOT NULL COMMENT 'Identifiant du niveau',
  `Niveau` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Niveau de pratique'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `niveau`
--

INSERT INTO `niveau` (`ID_Niveau`, `Niveau`) VALUES
(1, 'Courant'),
(2, 'Lu, écrit, parlé'),
(3, 'Scolaire');

-- --------------------------------------------------------

--
-- Structure de la table `recherche`
--

CREATE TABLE `recherche` (
  `ID_Recherche` int(11) NOT NULL COMMENT 'Identifiant de l''étape de recherche',
  `Recherche` varchar(200) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Etape de la recherche'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `recherche`
--

INSERT INTO `recherche` (`ID_Recherche`, `Recherche`) VALUES
(2, 'En cours'),
(1, 'En recherche');

-- --------------------------------------------------------

--
-- Structure de la table `statut`
--

CREATE TABLE `statut` (
  `ID_Statut` int(11) NOT NULL COMMENT 'Identifiant du statut',
  `Statut` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Statut'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `statut`
--

INSERT INTO `statut` (`ID_Statut`, `Statut`) VALUES
(1, 'Administrateur'),
(2, 'Utilisateur');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `ID_Utilisateur` int(11) NOT NULL COMMENT 'Identifiant de l''utilisateur',
  `prenom` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Prénom de l''utilisateur',
  `nom` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Nom de l''utilisateur',
  `email` varchar(200) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Adresse email de l''utilisateur',
  `password` varchar(200) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Mot de passe de l''utilisateur',
  `ID_Statut` int(11) NOT NULL COMMENT 'Statut de l''utilisateur'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`ID_Utilisateur`, `prenom`, `nom`, `email`, `password`, `ID_Statut`) VALUES
(1, 'Romain', 'Demay', 'romain.demay56@gmail.com', 'azertyuiop', 1),
(2, 'PrenomTest', 'NomTest', 'emailtest@test.fr', 'mdptest', 2);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `candidat`
--
ALTER TABLE `candidat`
  ADD PRIMARY KEY (`ID_Candidat`),
  ADD UNIQUE KEY `Email` (`Email`),
  ADD KEY `ID_Recherche` (`ID_Recherche`);

--
-- Index pour la table `candidat_certification`
--
ALTER TABLE `candidat_certification`
  ADD PRIMARY KEY (`ID_Candidat`,`ID_Certification`),
  ADD KEY `ID_Certification` (`ID_Certification`);

--
-- Index pour la table `candidat_connaissance`
--
ALTER TABLE `candidat_connaissance`
  ADD PRIMARY KEY (`ID_Candidat`,`ID_Connaissance`),
  ADD KEY `ID_Connaissance` (`ID_Connaissance`);

--
-- Index pour la table `candidat_formation`
--
ALTER TABLE `candidat_formation`
  ADD PRIMARY KEY (`ID_Candidat`,`ID_Formation`),
  ADD KEY `ID_Formation` (`ID_Formation`);

--
-- Index pour la table `candidat_langue`
--
ALTER TABLE `candidat_langue`
  ADD PRIMARY KEY (`ID_Candidat`,`ID_Langue`,`ID_Niveau`),
  ADD KEY `ID_Langue` (`ID_Langue`),
  ADD KEY `ID_Niveau` (`ID_Niveau`);

--
-- Index pour la table `certification`
--
ALTER TABLE `certification`
  ADD PRIMARY KEY (`ID_Certification`),
  ADD UNIQUE KEY `Certification` (`Certification`);

--
-- Index pour la table `connaissance`
--
ALTER TABLE `connaissance`
  ADD PRIMARY KEY (`ID_Connaissance`),
  ADD UNIQUE KEY `Connaissance` (`Connaissance`),
  ADD KEY `ID_Domaine` (`ID_Domaine`);

--
-- Index pour la table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Index pour la table `domaine`
--
ALTER TABLE `domaine`
  ADD PRIMARY KEY (`ID_Domaine`),
  ADD UNIQUE KEY `Domaine` (`Domaine`);

--
-- Index pour la table `experience_professionnelle`
--
ALTER TABLE `experience_professionnelle`
  ADD PRIMARY KEY (`ID_Experience`),
  ADD KEY `ID_Candidat` (`ID_Candidat`);

--
-- Index pour la table `formation`
--
ALTER TABLE `formation`
  ADD PRIMARY KEY (`ID_Formation`),
  ADD UNIQUE KEY `Formation` (`Formation`);

--
-- Index pour la table `langue`
--
ALTER TABLE `langue`
  ADD PRIMARY KEY (`ID_Langue`),
  ADD UNIQUE KEY `Langue` (`Langue`);

--
-- Index pour la table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  ADD KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  ADD KEY `IDX_75EA56E016BA31DB` (`delivered_at`);

--
-- Index pour la table `niveau`
--
ALTER TABLE `niveau`
  ADD PRIMARY KEY (`ID_Niveau`),
  ADD UNIQUE KEY `Niveau` (`Niveau`);

--
-- Index pour la table `recherche`
--
ALTER TABLE `recherche`
  ADD PRIMARY KEY (`ID_Recherche`),
  ADD UNIQUE KEY `Recherche` (`Recherche`);

--
-- Index pour la table `statut`
--
ALTER TABLE `statut`
  ADD PRIMARY KEY (`ID_Statut`),
  ADD UNIQUE KEY `Statut` (`Statut`),
  ADD UNIQUE KEY `Statut_2` (`Statut`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`ID_Utilisateur`),
  ADD UNIQUE KEY `Email` (`email`),
  ADD UNIQUE KEY `Email_2` (`email`),
  ADD KEY `ID_Statut` (`ID_Statut`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `candidat`
--
ALTER TABLE `candidat`
  MODIFY `ID_Candidat` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identifiant du candidat', AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `certification`
--
ALTER TABLE `certification`
  MODIFY `ID_Certification` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identifiant de la certification', AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `connaissance`
--
ALTER TABLE `connaissance`
  MODIFY `ID_Connaissance` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identifiant de la connaissance technique';

--
-- AUTO_INCREMENT pour la table `domaine`
--
ALTER TABLE `domaine`
  MODIFY `ID_Domaine` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identifiant du domaine', AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `experience_professionnelle`
--
ALTER TABLE `experience_professionnelle`
  MODIFY `ID_Experience` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identifiant de l''expérience professionnelle';

--
-- AUTO_INCREMENT pour la table `formation`
--
ALTER TABLE `formation`
  MODIFY `ID_Formation` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identifiant de la formation';

--
-- AUTO_INCREMENT pour la table `langue`
--
ALTER TABLE `langue`
  MODIFY `ID_Langue` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identifiant de la langue', AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `niveau`
--
ALTER TABLE `niveau`
  MODIFY `ID_Niveau` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identifiant du niveau', AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `recherche`
--
ALTER TABLE `recherche`
  MODIFY `ID_Recherche` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identifiant de l''étape de recherche', AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `statut`
--
ALTER TABLE `statut`
  MODIFY `ID_Statut` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identifiant du statut', AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `ID_Utilisateur` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identifiant de l''utilisateur', AUTO_INCREMENT=3;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `candidat`
--
ALTER TABLE `candidat`
  ADD CONSTRAINT `candidat_ibfk_1` FOREIGN KEY (`ID_Recherche`) REFERENCES `recherche` (`ID_Recherche`);

--
-- Contraintes pour la table `candidat_certification`
--
ALTER TABLE `candidat_certification`
  ADD CONSTRAINT `candidat_certification_ibfk_1` FOREIGN KEY (`ID_Candidat`) REFERENCES `candidat` (`ID_Candidat`),
  ADD CONSTRAINT `candidat_certification_ibfk_2` FOREIGN KEY (`ID_Certification`) REFERENCES `certification` (`ID_Certification`);

--
-- Contraintes pour la table `candidat_connaissance`
--
ALTER TABLE `candidat_connaissance`
  ADD CONSTRAINT `candidat_connaissance_ibfk_1` FOREIGN KEY (`ID_Candidat`) REFERENCES `candidat` (`ID_Candidat`),
  ADD CONSTRAINT `candidat_connaissance_ibfk_2` FOREIGN KEY (`ID_Connaissance`) REFERENCES `connaissance` (`ID_Connaissance`);

--
-- Contraintes pour la table `candidat_formation`
--
ALTER TABLE `candidat_formation`
  ADD CONSTRAINT `candidat_formation_ibfk_1` FOREIGN KEY (`ID_Candidat`) REFERENCES `candidat` (`ID_Candidat`),
  ADD CONSTRAINT `candidat_formation_ibfk_2` FOREIGN KEY (`ID_Formation`) REFERENCES `formation` (`ID_Formation`);

--
-- Contraintes pour la table `candidat_langue`
--
ALTER TABLE `candidat_langue`
  ADD CONSTRAINT `candidat_langue_ibfk_1` FOREIGN KEY (`ID_Candidat`) REFERENCES `candidat` (`ID_Candidat`),
  ADD CONSTRAINT `candidat_langue_ibfk_2` FOREIGN KEY (`ID_Langue`) REFERENCES `langue` (`ID_Langue`),
  ADD CONSTRAINT `candidat_langue_ibfk_3` FOREIGN KEY (`ID_Niveau`) REFERENCES `niveau` (`ID_Niveau`);

--
-- Contraintes pour la table `connaissance`
--
ALTER TABLE `connaissance`
  ADD CONSTRAINT `connaissance_ibfk_1` FOREIGN KEY (`ID_Domaine`) REFERENCES `domaine` (`ID_Domaine`);

--
-- Contraintes pour la table `experience_professionnelle`
--
ALTER TABLE `experience_professionnelle`
  ADD CONSTRAINT `experience_professionnelle_ibfk_1` FOREIGN KEY (`ID_Candidat`) REFERENCES `candidat` (`ID_Candidat`);

--
-- Contraintes pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD CONSTRAINT `utilisateur_ibfk_1` FOREIGN KEY (`ID_Statut`) REFERENCES `statut` (`ID_Statut`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
