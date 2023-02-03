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

DELIMITER $$
--
-- Procédures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `create_candidat` (`p_Prenom` VARCHAR(100), `p_Nom` VARCHAR(100), `p_Email` VARCHAR(200), `p_Telephone` VARCHAR(10), `p_Poste` VARCHAR(200), `p_Annees_exp` INT)  BEGIN
	INSERT INTO candidat (Prenom, Nom, Email, Telephone, Poste, Annees_experience, ID_Recherche) VALUES
		(p_Prenom, p_Nom, p_Email, p_Telephone, p_Poste, p_Annees_exp, "1")
	;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `create_certification` (`p_Certification` VARCHAR(200), `p_Logo_certification` TEXT)  BEGIN
	INSERT INTO certification (Certification, Logo_certification) VALUES
		(p_Certification, p_Logo_certification)
	;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `create_certification_candidat` (`p_ID_Candidat` INT, `p_ID_Certification` INT, `p_Date_certification` DATE)  BEGIN
	INSERT INTO candidat_certification (ID_Candidat, ID_Certification, Date_certification) VALUES
		(p_ID_Candidat, p_ID_Certification, p_Date_certification)
	;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `create_connaissance` (`p_Connaissance` VARCHAR(200))  BEGIN
	INSERT INTO connaissance (Connaissance) VALUES
		(p_Connaissance)
	;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `create_connaissance_candidat` (`p_ID_Candidat` INT, `p_ID_Connaissance` INT)  BEGIN
	INSERT INTO candidat_connaissance (ID_Candidat, ID_Connaissance) VALUES
		(p_ID_Candidat, p_ID_Connaissance)
	;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `create_domaine` (`p_Domaine` VARCHAR(100))  BEGIN
	INSERT INTO domaine (Domaine) VALUES
		(p_Domaine)
	;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `create_experience_professionnelle` (`p_ID_Candidat` INT, `p_Entreprise` VARCHAR(200), `p_Date_debut` DATE, `p_Date_fin` DATE, `p_Poste` VARCHAR(200), `p_Lieu` VARCHAR(200), `p_Description` TEXT, `p_Elements_cles` TEXT, `p_Environnement` TEXT)  BEGIN
	INSERT INTO experience_professionnelle (ID_Candidat, Entreprise, Date_debut, Date_fin, Poste, Lieu, Description, Elements_cles, Environnement) VALUES
		(p_ID_Candidat, p_Entreprise, p_Date_debut, p_Date_fin, p_Poste, p_Lieu, p_Description, p_Elements_cles, p_Environnement)
	;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `create_formation` (`p_Formation` VARCHAR(200), `p_Institution` VARCHAR(200))  BEGIN
	INSERT INTO formation (Formation, Institution) VALUES
		(p_Formation, p_Institution)
	;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `create_formation_candidat` (`p_ID_Candidat` INT, `p_ID_Formation` INT, `p_Date_formation` DATE)  BEGIN
	INSERT INTO candidat_formation (ID_Candidat, ID_Formation, Date_formation) VALUES
		(p_ID_Candidat, p_ID_Formation, p_Date_formation)
	;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `create_langue` (`p_Langue` VARCHAR(50))  BEGIN
	INSERT INTO langue (Langue) VALUES
		(p_Langue)
	;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `create_langue_candidat` (`p_ID_Candidat` INT, `p_ID_Langue` INT, `p_ID_Niveau` INT)  BEGIN
	INSERT INTO candidat_langue (ID_Candidat, ID_Langue, ID_Niveau) VALUES
		(p_ID_Candidat, p_ID_Langue, p_ID_Niveau)
	;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `create_niveau` (`p_Niveau` VARCHAR(50))  BEGIN
	INSERT INTO niveau (Niveau) VALUES
		(p_Niveau)
	;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `create_recherche` (`p_Recherche` VARCHAR(200))  BEGIN
	INSERT INTO recherche (Recherche) VALUES
		(p_Recherche)
	;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `create_statut` (`p_Statut` VARCHAR(50))  BEGIN
	INSERT INTO statut (Statut) VALUES
		(p_Statut)
	;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `create_utilisateur` (`p_Prenom` VARCHAR(100), `p_Nom` VARCHAR(100), `p_Email` VARCHAR(200), `p_MotDePasse` TEXT, `p_ID_Statut` INT)  BEGIN
	INSERT INTO utilisateur (Prenom, Nom, Email, MotDePasse, ID_Statut) VALUES
		(P_Prenom, p_Nom, p_Email, p_MotDePasse, p_ID_Statut)
	;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_candidat` (`p_ID_Candidat` INT)  BEGIN
	DELETE FROM candidat_langue
		WHERE ID_Candidat = p_ID_Candidat
	;

	DELETE FROM candidat_connaissance
		WHERE ID_Candidat = p_ID_Candidat
	;

	DELETE FROM candidat_certification
		WHERE ID_Candidat = p_ID_Candidat
	;

	DELETE FROM candidat_certification
		WHERE ID_Candidat = p_ID_Candidat
	;

	DELETE FROM experience_professionnelle
		WHERE ID_Candidat = p_ID_Candidat
	;

	DELETE FROM candidat
		WHERE ID_Candidat = p_ID_Candidat
	;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_certification` (`p_ID_Certification` INT)  BEGIN
	DELETE FROM candidat_certification
		WHERE ID_Certification = p_ID_Certification
	;

	DELETE FROM certification
		WHERE ID_Certification = p_ID_Certification
	;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_certification_candidat` (`p_ID_Candidat` INT, `p_ID_Certification` INT)  BEGIN
	DELETE FROM candidat_certification
		WHERE ID_Candidat = p_ID_Candidat AND ID_Certification = p_ID_Certification
	;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_connaissance` (`p_ID_Connaissance` INT)  BEGIN
	DELETE FROM candidat_connaissance
		WHERE ID_Connaissance = p_ID_Connaissance
	;

	DELETE FROM connaissance
		WHERE ID_Connaissance = p_ID_Connaissance
	;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_connaissance_candidat` (`p_ID_Candidat` INT, `p_ID_Connaissance` INT)  BEGIN
	DELETE FROM candidat_connaissance
		WHERE ID_Candidat = p_ID_Candidat AND ID_Connaissance = p_ID_Connaissance
	;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_domaine` (`p_ID_Domaine` INT)  BEGIN
	DELETE FROM candidat_connaissance
		WHERE ID_Connaissance = (
			SELECT ID_Connaissance FROM connaissance
				WHERE ID_Domaine = p_ID_Domaine
		)
	;

	DELETE FROM connaissance 
		WHERE ID_Domaine = p_ID_Domaine
	;

	DELETE FROM domaine
		WHERE ID_Domaine = p_ID_Domaine
	;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_experience_candidat` (`p_ID_Candidat` INT, `p_ID_Experience` INT)  BEGIN
	DELETE FROM candidat_formation
		WHERE ID_Candidat = p_ID_Candidat AND ID_Experience = p_ID_Experience
	;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_formation` (`p_ID_Formation` INT)  BEGIN
	DELETE FROM candidat_formation
		WHERE ID_Formation = p_ID_Formation
	;

	DELETE FROM formation
		WHERE ID_Formation = p_ID_Formation
	;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_formation_candidat` (`p_ID_Candidat` INT, `p_ID_Formation` INT)  BEGIN
	DELETE FROM candidat_formation
		WHERE ID_Candidat = p_ID_Candidat AND ID_Formation = p_ID_Formation
	;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_langue` (`p_ID_Langue` INT)  BEGIN
	DELETE FROM candidat_langue
		WHERE ID_Langue = p_ID_Langue
	;

	DELETE FROM langue
		WHERE ID_Langue = p_ID_Langue
	;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_langue_candidat` (`p_ID_Candidat` INT, `p_ID_Langue` INT)  BEGIN
	DELETE FROM candidat_langue
		WHERE ID_Candidat = p_ID_Candidat AND ID_Langue = p_ID_Langue
	;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_niveau` (`p_ID_Niveau` INT)  BEGIN
	DELETE FROM candidat_langue
		WHERE ID_Niveau = p_ID_Niveau
	;

	DELETE FROM niveau
		WHERE ID_Niveau = p_ID_Niveau
	;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_recherche` (`p_ID_Recherche` INT)  BEGIN
	UPDATE candidat
		SET ID_Recherche = NULL
		WHERE ID_Recherche = p_ID_Recherche
	;

	DELETE FROM recherche
		WHERE ID_Recherche = p_ID_Recherche
	;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_statut` (`p_ID_Statut` INT)  BEGIN
	DELETE FROM statut
		WHERE ID_Statut = p_ID_Statut
	;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_utilisateur` (`p_ID_Utilisateur` INT)  BEGIN
	DELETE FROM utilisateur
		WHERE ID_Utilisateur = p_ID_Utilisateur
	;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_candidats` ()  BEGIN
	SELECT Prenom, Nom FROM candidat
	;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_certifications` ()  BEGIN
	SELECT Certification, Logo_certification FROM certification
	;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_certifications_candidat` (`p_ID_Candidat` INT)  BEGIN
	SELECT cc.ID_Candidat, ce.Certification, cc.Date_certification, ce.Logo_certification FROM candidat_certification AS cc
		JOIN certification AS ce ON ce.ID_Certification = cc.ID_Certification
			WHERE cc.ID_Candidat = p_ID_Candidat
	; 
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_connaissances` ()  BEGIN
	SELECT Connaissance FROM connaissance
	;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_connaissances_candidat` (`p_ID_Candidat` INT)  BEGIN
	SELECT cc.ID_Candidat, co.Connaissance, d.Domaine FROM candidat_connaissance AS cc
		JOIN connaissance AS co ON co.ID_Connaissance = cc.ID_Connaissance
		JOIN candidat AS ca ON ca.ID_Candidat = cc.ID_Candidat
		JOIN domaine AS d ON d.ID_Domaine = co.ID_Domaine
			WHERE cc.ID_Candidat = p_ID_Candidat
	;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_domaines` ()  BEGIN
	SELECT Domaine FROM domaine
	;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_experiences_candidat` (`p_ID_Candidat` INT)  BEGIN
	SELECT Entreprise, Date_debut, Date_fin, Poste, Lieu, Description, Elements_cles, Environnement FROM experience_professionnelle
		WHERE ID_Candidat = p_ID_Candidat
	;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_formations` ()  BEGIN
	SELECT Formation, Institution FROM formation
	;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_formations_candidat` (`p_ID_Candidat` INT)  BEGIN
	SELECT f.Formation, f.Institution, cf.Date_formation FROM candidat_formation AS cf
		JOIN formation AS f ON f.ID_Formation = cf.ID_Formation
			WHERE cf.ID_Candidat = p_ID_Candidat
	;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_infos_candidat` (`p_ID_Candidat` INT)  BEGIN
	SELECT c.Prenom, c.Nom, c.Email, c.Telephone, c.Poste, c.Annees_experience, r.Recherche FROM candidat AS c
		JOIN recherche AS r ON r.ID_Recherche = c.ID_Recherche
			WHERE c.ID_Candidat = p_ID_Candidat
	; 
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_infos_utilisateur` (`p_ID_Utilisateur` INT)  BEGIN
	SELECT u.Prenom, u.Nom, u.Email, s.Statut FROM utilisateur AS u
		JOIN statut AS s ON s.ID_Statut = u.ID_Statut
			WHERE ID_Utilisateur = p_ID_Utilisateur
	;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_langues` ()  BEGIN
	SELECT Langue FROM langue
	;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_langues_candidat` (`p_ID_Candidat` INT)  BEGIN
	SELECT cl.ID_Candidat, l.Langue, n.Niveau FROM candidat_langue AS cl
		JOIN langue AS l ON l.ID_Langue = cl.ID_Langue
		JOIN niveau AS n ON n.ID_Niveau = cl.ID_Niveau
			WHERE p_ID_Candidat = cl.ID_Candidat
	;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_niveaux` ()  BEGIN
	SELECT Niveau FROM niveau
	;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_recherches` ()  BEGIN
	SELECT Recherche FROM recherche
	;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `set_certifications_candidat` (`p_ID_Candidat` INT, `p_ID_Certification` INT, `p_Date_certification` DATE)  BEGIN
	UPDATE candidat_certification
		SET ID_Certification = p_ID_Certification,
			Date_certification = p_Date_certification
		WHERE ID_Candidat = p_ID_Candidat
	;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `set_connaissances_candidat` (`p_ID_Candidat` INT, `p_ID_Connaissance` INT)  BEGIN
	UPDATE candidat_connaissance
		SET ID_Connaissance = p_ID_Connaissance
		WHERE ID_Candidat = p_ID_Candidat
	;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `set_experience_professionnelle` (`p_ID_Experience` INT, `p_Entreprise` VARCHAR(200), `p_Date_debut` DATE, `p_Date_fin` DATE, `p_Poste` VARCHAR(200), `p_Lieu` VARCHAR(200), `p_Description` TEXT, `p_Elements_cles` TEXT, `p_Environnement` TEXT)  BEGIN
	UPDATE experience_professionnelle
		SET Entreprise = p_Entreprise,
			Date_debut = p_Date_debut,
			Date_fin = p_Date_fin,
			Poste = p_Poste,
			Lieu = p_Lieu,
			Description = p_Description,
			Elements_cles = p_Elements_cles,
			Environnement = p_Environnement
		WHERE ID_Experience = p_ID_Experience
	;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `set_formations_candidat` (`p_ID_Candidat` INT, `p_ID_Formation` INT, `p_Date_formation` DATE)  BEGIN
	UPDATE candidat_formation
		SET ID_Formation = p_ID_Formation,
			Date_formation = p_Date_formation
		WHERE ID_Candidat = p_ID_Candidat
	;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `set_informations_candidat` (`p_ID_Candidat` INT, `p_Prenom` VARCHAR(100), `p_Nom` VARCHAR(100), `p_Email` VARCHAR(200), `p_Telephone` VARCHAR(10), `p_Poste` VARCHAR(200), `p_Annees_exp` INT, `p_ID_Recherche` INT)  BEGIN
	UPDATE candidat
		SET Prenom = p_Prenom,
			Nom = p_Nom,
			Email = p_Email,
			Telephone = p_Telephone,
			Poste = p_Poste,
			Annees_experience = p_Annees_exp,
			ID_Recherche = p_ID_Recherche
		WHERE ID_Candidat = p_ID_Candidat
	;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `set_informations_utilisateur` (`p_ID_Utilisateur` INT, `p_Prenom` VARCHAR(100), `p_Nom` VARCHAR(100), `p_Email` VARCHAR(200), `p_MotDePasse` TEXT)  BEGIN
	UPDATE utilisateur
		SET Prenom = p_Prenom,
			Nom = p_Nom,
			Email = p_Email,
			MotdePasse = p_MotDePasse
		WHERE ID_Utilisateur = p_ID_Utilisateur
	;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `set_langues_candidat` (`p_ID_Candidat` INT, `p_ID_Langue` INT, `p_ID_Niveau` INT)  BEGIN
	UPDATE candidat_langue
		SET ID_Langue = p_ID_Langue,
			ID_Niveau = p_ID_Niveau
		WHERE ID_Candidat = p_ID_Candidat
	;
END$$

DELIMITER ;

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
