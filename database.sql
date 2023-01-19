DROP DATABASE IF EXISTS ROBOTCV;
CREATE DATABASE IF NOT EXISTS ROBOTCV;
use ROBOTCV;

/*-- Créations des tables de la base de données --*/
/*------------------------------------------------*/

/*-- TABLE : statut --*/
/*--
	- Table contenant les différents statuts des utilisateurs de la plateforme (ex: Administrateur, Utilisateur, ...)
	- Elle contient deux entrées :
		- ID_Statut : Identifiant du statut
		- Statut : Statut
	- Clé primaire : ID_Statut
--*/
DROP TABLE IF EXISTS statut;
CREATE TABLE IF NOT EXISTS statut (
	ID_Statut INT NOT NULL AUTO_INCREMENT COMMENT "Identifiant du statut",
	Statut VARCHAR(50) NOT NULL UNIQUE COMMENT "Statut",
	PRIMARY KEY (ID_Statut),
	UNIQUE (Statut)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_unicode_ci;


/*-- TABLE : utilisateur --*/
/*--
	- Table contenant les informations des utilisateurs de la plateforme
	- Elle contient six entrées :
		- ID_Utilisateur : Identifiant de l'utilisateur
		- Prenom : Le prénom de l'utilisateur
		- Nom : Le nom de l'utilisateur
		- Email : L'adresse email de l'utilisateur
		- MotdePasse : Le mot de passe de l'utilisateur
		- ID_Statut : Le statut de l'utilisateur
	- Clé primaire : ID_Utilisateur
	- Clé étrangère :
		- ID_Statut
--*/
DROP TABLE IF EXISTS utilisateur;
CREATE TABLE IF NOT EXISTS utilisateur (
	ID_Utilisateur INT NOT NULL AUTO_INCREMENT COMMENT "Identifiant de l'utilisateur",
	Prenom VARCHAR(100) NOT NULL COMMENT "Prénom de l'utilisateur",
	Nom VARCHAR(100) NOT NULL COMMENT "Nom de l'utilisateur",
	Email VARCHAR(200) NOT NULL UNIQUE COMMENT "Adresse email de l'utilisateur",
	MotDePasse TEXT NOT NULL COMMENT "Mot de passe de l'utilisateur",
	ID_Statut INT NOT NULL COMMENT "Statut de l'utilisateur",
	PRIMARY KEY (ID_Utilisateur),
	FOREIGN KEY (ID_Statut) REFERENCES statut(ID_Statut),
	UNIQUE (Email)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_unicode_ci;


/*-- TABLE : langue --*/
/*--
	Table contenant les différentes langues parlées par les candidats
	- Elle contient deux entrées :
		- ID_Langue : Identifiant de la langue
		- Langue : La langue
	- Clé primaire : ID_Langue
--*/
DROP TABLE IF EXISTS langue;
CREATE TABLE IF NOT EXISTS langue (
	ID_Langue INT NOT NULL AUTO_INCREMENT COMMENT "Identifiant de la langue",
	Langue VARCHAR(50) NOT NULL COMMENT "Langue",
	PRIMARY KEY (ID_Langue),
	UNIQUE (Langue)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_unicode_ci;


/*-- TABLE : niveau --*/
/*-- 
	Table contenant les différents niveaux de pratique d'une langue
	- Elle contient deux entrées :
		- ID_Niveau : Identifiant du niveau
		- Niveau : Niveau de pratique
	- Clé primaire : ID_Niveau
--*/
DROP TABLE IF EXISTS niveau;
CREATE TABLE IF NOT EXISTS niveau (
	ID_Niveau INT NOT NULL AUTO_INCREMENT COMMENT "Identifiant du niveau",
	Niveau VARCHAR(50) NOT NULL COMMENT "Niveau de pratique",
	PRIMARY KEY (ID_Niveau),
	UNIQUE (Niveau)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_unicode_ci;


/*-- TABLE : domaine --*/
/*--
	Table contenant les différents domaines techniques
	Elle contient deux entrées :
		- ID_Domaine : Identifiant du domaine technique
		- Domaine : Le domaine technique
	Clé primaire : ID_Domaine
--*/
DROP TABLE IF EXISTS domaine;
CREATE TABLE IF NOT EXISTS domaine (
	ID_Domaine INT NOT NULL AUTO_INCREMENT COMMENT "Identifiant du domaine",
	Domaine VARCHAR(100) NOT NULL COMMENT "Domaine technique",
	PRIMARY KEY (ID_Domaine),
	UNIQUE (Domaine)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_unicode_ci;


/*-- TABLE : connaissance --*/
/*--
	 Table contenant les différentes connaissances techniques
	 Elle contient trois entrées :
	 	- ID_Connaissance : Identifiant de la connaissance technique
	 	- Connaissance : La connaissance technique
	 	- ID_Domaine : L'identifiant du domaine de la connaissance
	 Clé primaire : ID_Connaissance
	 Clé étrangère :
	 	- ID_Domaine
--*/
DROP TABLE IF EXISTS connaissance;
CREATE TABLE IF NOT EXISTS connaissance (
	ID_Connaissance INT NOT NULL AUTO_INCREMENT COMMENT "Identifiant de la connaissance technique",
	Connaissance VARCHAR(200) NOT NULL COMMENT "Connaissance technique",
	ID_Domaine INT NOT NULL COMMENT "Identifiant du domaine de la connaissance",
	PRIMARY KEY (ID_Connaissance),
	FOREIGN KEY (ID_Domaine) REFERENCES domaine(ID_Domaine),
	UNIQUE (Connaissance)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_unicode_ci;


/*-- TABLE : recherche
/*--
	Table contenant les différentes étapes de recherche possible
	Elle contient deux entrées :
		- ID_Recherche : Identifiant de l'étape de recherche
		- Recherche : L'étape de recherche
	Clé primaire : ID_Recherche
--*/
DROP TABLE IF EXISTS recherche;
CREATE TABLE IF NOT EXISTS recherche (
	ID_Recherche INT NOT NULL AUTO_INCREMENT COMMENT "Identifiant de l'étape de recherche",
	Recherche VARCHAR(200) NOT NULL COMMENT "Etape de la recherche",
	PRIMARY KEY (ID_Recherche),
	UNIQUE (Recherche)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_unicode_ci;


/*-- TABLE : certification --*/
/*--
	Table contenant les informations des différentes certifications
	Elle prend trois entrées :
		- ID_Certification : Identifiant de la certification
		- Certification : Le nom de la certification
		- Logo_certification : Le lien vers le logo de la certification
	Clé primaire : ID_Certification
--*/
DROP TABLE IF EXISTS certification;
CREATE TABLE IF NOT EXISTS certification (
	ID_Certification INT NOT NULL AUTO_INCREMENT COMMENT "Identifiant de la certification",
	Certification VARCHAR(200) NOT NULL COMMENT "Nom de la certification",
	Logo_certification TEXT COMMENT "Lien vers le logo de la certification",
	PRIMARY KEY (ID_Certification),
	UNIQUE (Certification)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_unicode_ci;


/*-- TABLE : formation --*/
/*--
	Table contenant les informations des différentes foramtions
	Elle prend trois entrées :
		- ID_Formation : Identifiant de la formation
		- Formation : Le nom de la formation
		- Institution : Le nom de l'institution délivrant le diplome 
	Clé primaire : ID_Formation
--*/
DROP TABLE IF EXISTS formation;
CREATE TABLE IF NOT EXISTS formation (
	ID_Formation INT NOT NULL AUTO_INCREMENT COMMENT "Identifiant de la formation",
	Formation VARCHAR(200) NOT NULL COMMENT "Le nom de la formation",
	Institution VARCHAR(200) NOT NULL COMMENT "Institution délivrant le diplome",
	PRIMARY KEY (ID_Formation),
	UNIQUE (Formation)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_unicode_ci;


/*-- TABLE : candidat --*/
/*--
	Table contenant les informations des candidats
	- Elle contient sept entrées :
		- ID_Candidat : Identifiant du candidat
		- Prenom : Le prénom du candidat
		- Nom : Le nom du candidat
		- Email : L'adresse email du candidat
		- Telephone : Le numéro de téléphone du candidat
		- Poste : Le poste auquel le candidat postule
		- Annees_experience : Le nombre d'années d'expérience du candidat
		- ID_Recherche : Identifiant de l'étape d'avancement de la recherche
	- Clé primaire : ID_Candidat
	- Clé étrangère : ID_Recherche
--*/
DROP TABLE IF EXISTS candidat;
CREATE TABLE IF NOT EXISTS candidat (
	ID_Candidat INT NOT NULL AUTO_INCREMENT COMMENT "Identifiant du candidat",
	Prenom VARCHAR(100) NOT NULL COMMENT "Prénom du candidat",
	Nom VARCHAR(100) NOT NULL COMMENT "Nom du candidat",
	Email VARCHAR(200) NOT NULL COMMENT "Email du candidat",
	Telephone VARCHAR(10) NOT NULL COMMENT "Téléphone du candidat",
	Poste VARCHAR(200) NOT NULL COMMENT "Poste auquel le candidat postule",
	Annees_experience INT NOT NULL COMMENT "Nombre d'années d'expérience du candidat",
	ID_Recherche INT COMMENT "Identifiant de l'étape d'avancement de la recherche",
	PRIMARY KEY (ID_Candidat),
	FOREIGN KEY (ID_Recherche) REFERENCES recherche(ID_Recherche),
	UNIQUE (Email)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_unicode_ci;


/*-- TABLE : candidat_langue --*/
/*--
	Table de jointure pour associer les candidat aux langues pratiquées ainsi qu'à leurs niveaux de pratique
	- Elle contient trois entrées :
		- ID_Candidat : Identifiant du candidat
		- ID_Langue : Identifiant de la langue
		- ID_Niveau : Identifiant du niveau de pratique
	- Clé primaire : (ID_Candidat, ID_Langue, ID_Niveau)
	- Clés étrangères :
		- ID_Candidat
		- ID_Langue
		- ID_Niveau
--*/
DROP TABLE IF EXISTS candidat_langue;
CREATE TABLE IF NOT EXISTS candidat_langue (
	ID_Candidat INT NOT NULL COMMENT "Identifiant du candidat",
	ID_Langue INT NOT NULL COMMENT "Identifiant de la langue",
	ID_Niveau INT NOT NULL COMMENT "Identifiant du niveau",
	PRIMARY KEY (ID_Candidat, ID_Langue, ID_Niveau),
	FOREIGN KEY (ID_Candidat) REFERENCES candidat(ID_Candidat),
	FOREIGN KEY (ID_Langue) REFERENCES langue(ID_Langue),
	FOREIGN KEY (ID_Niveau) REFERENCES niveau(ID_Niveau)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_unicode_ci;


/*-- TABLE : connaissance_candidat --*/
/*--
	Table de jointure pour associer les candidats aux connaissances techniques
	Elle contient deux entrées :
		- ID_Candidat : Identifiant du candidat
		- ID_Connaissance : Identifiant de la connaissance
	Clé primaire : (ID_Candidat, ID_Connaissance)
	Clés étrangères : 
		- ID_Candidat
		- ID_Connaissance
--*/
DROP TABLE IF EXISTS candidat_connaissance;
CREATE TABLE IF NOT EXISTS candidat_connaissance (
	ID_Candidat INT NOT NULL COMMENT "Identifiant du candidat",
	ID_Connaissance INT NOT NULL COMMENT "Identifiant de la connaissance technique",
	PRIMARY KEY (ID_Candidat, ID_Connaissance),
	FOREIGN KEY (ID_Candidat) REFERENCES candidat(ID_Candidat),
	FOREIGN KEY (ID_Connaissance) REFERENCES connaissance(ID_Connaissance)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_unicode_ci;


/*-- TABLE : candidat_certification --*/
/*--
	Table contenant les informations des certificats passées par les candidats
	Elle contient trois entrées :
		- ID_Candidat : Identifiant du candidat
		- ID_Certification : Identifiant de la certification
		- Date_certification : Date d'obtention de la certification,
	Clé primaire : (ID_Candidat, ID_Certification)
	Clés étrangères :
		- ID_Candidat
		- ID_Connaissance
--*/
DROP TABLE IF EXISTS candidat_certification;
CREATE TABLE IF NOT EXISTS candidat_certification (
	ID_Candidat INT NOT NULL COMMENT "Identifiant du candidat",
	ID_Certification INT NOT NULL COMMENT "Identifiant de la certification",
	Date_certification DATE NOT NULL COMMENT "Date d'obention de la certification",
	PRIMARY KEY (ID_Candidat, ID_Certification),
	FOREIGN KEY (ID_Candidat) REFERENCES candidat(ID_Candidat),
	FOREIGN KEY (ID_Certification) REFERENCES certification(ID_Certification)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_unicode_ci;


/*-- TABLE : candidat_formation --*/
/*--
	Table contenant les informations des formations passées par les candidats
	Elle contient trois entrées :
		- ID_Candidat : Identifiant du candidat
		- ID_Formation : Identifiant de la formation
		- Date_formation : La date d'obtention du diplome
	Clé primaire : (ID_Candidat, ID_Formation)
	Clés étrangères :
		- ID_Candidat
		- ID_Formation
--*/
DROP TABLE IF EXISTS candidat_formation;
CREATE TABLE IF NOT EXISTS candidat_formation (
	ID_Candidat INT NOT NULL COMMENT "Identifiant du candidat",
	ID_Formation INT NOT NULL COMMENT "Identifiant de la formation",
	Date_formation DATE NOT NULL COMMENT "Date d'obtention du diplome",
	PRIMARY KEY (ID_Candidat, ID_Formation),
	FOREIGN KEY (ID_Candidat) REFERENCES candidat(ID_Candidat),
	FOREIGN KEY (ID_Formation) REFERENCES formation(ID_Formation)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_unicode_ci;


/*-- TABLE : experience_professionnelle --*/
/*--
	Table contenant les informations sur les expériences professionnelles des candidats
	Elle contient huit entrées :
		- ID_Experience : Identifiant de l'expérience professionnelle
		- ID_Candidat : Identifiant du candidat
		- Entreprise : Le nom de l'entreprise
		- Date_debut : La date de début de la mission
		- Date_fin : La date de fin de la mission
		- Poste : Le poste au sein de l'entreprise
		- Lieu : Le lieu de la mission
		- Description : La description de la mission
		- Elements_cles : Les éléments clés de la mission
		- Environnement : L'environnement de travail
	Clé primaire : ID_Experience
	Clé étrangère :
		- ID_Candidat
--*/
DROP TABLE IF EXISTS experience_professionnelle;
CREATE TABLE IF NOT EXISTS experience_professionnelle (
	ID_Experience INT NOT NULL AUTO_INCREMENT COMMENT "Identifiant de l'expérience professionnelle",
	ID_Candidat INT NOT NULL COMMENT "Identifiant du candidat",
	Entreprise VARCHAR(200) NOT NULL COMMENT "Nom de l'entreprise",
	Date_debut DATE NOT NULL COMMENT "Date de début de la mission",
	Date_fin DATE COMMENT "Date de fin de la mission",
	Poste VARCHAR(200) NOT NULL COMMENT "Poste au sein de l'entreprise",
	Lieu VARCHAR(200) NOT NULL COMMENT "Lieu de la mission",
	Description TEXT NOT NULL COMMENT "Description de la mission",
	Elements_cles TEXT COMMENT "Eléments clés de la mission",
	Environnement TEXT NOT NULL COMMENT "Description de l'environnement de travail",
	PRIMARY KEY (ID_Experience),
	FOREIGN KEY (ID_Candidat) REFERENCES candidat(ID_Candidat)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_unicode_ci;

/*------------------------------------------------*/



/*-- Créations des procédures de la base de données --*/
/*----------------------------------------------------*/

DELIMITER |


/*-- Procédures CREATE pour créer des nouvelles entrées dans la base de données --*/
/*--------------------------------------------------------------------------------*/


/*-- PROCEDURE : create_statut --*/
/*--
	Procédure pour ajouter un nouveau statut d'utilisateur
	Elle prend un paramètre :
		- p_Statut : Le nouveau statut à ajouter
--*/
CREATE PROCEDURE create_statut(p_Statut VARCHAR(50))
BEGIN
	INSERT INTO statut (Statut) VALUES
		(p_Statut)
	;
END |


/*-- PROCEDURE : create_utilisateur --*/
/*--
	Procédure pour ajouter un nouvel utilisateur
	Elle prend cinq paramètres :
		- p_Prenom : Le prénom du nouvel utilisateur
		- p_Nom : Le nom du nouvel utilisateur
		- P_Email : L'email du nouvel utilisateur
		- p_MotDePasse : Le mot de passe du nouvel utilisateur
		- p_ID_Statut : Identifiant du statut
--*/
CREATE PROCEDURE create_utilisateur(p_Prenom VARCHAR(100), p_Nom VARCHAR(100), p_Email VARCHAR(200), p_MotDePasse TEXT, p_ID_Statut INT)
BEGIN
	INSERT INTO utilisateur (Prenom, Nom, Email, MotDePasse, ID_Statut) VALUES
		(P_Prenom, p_Nom, p_Email, p_MotDePasse, p_ID_Statut)
	;
END |


/*-- PROCEDURE : create_langue --*/
/*--
	Procédure pour ajouter une nouvelle langue
	Elle prend un paramètre :
		- p_Langue : La langue à ajouter
--*/
CREATE PROCEDURE create_langue(p_Langue VARCHAR(50))
BEGIN
	INSERT INTO langue (Langue) VALUES
		(p_Langue)
	;
END |


/*-- PROCEDURE : create_niveau --*/
/*--
	Procédure pour ajouter un nouveau niveau de pratique d'une langue
	Elle prend un paramètre :
		- p_Niveau : Le niveau de pratique à ajouter
--*/
CREATE PROCEDURE create_niveau(p_Niveau VARCHAR(50))
BEGIN
	INSERT INTO niveau (Niveau) VALUES
		(p_Niveau)
	;
END |


/*-- PROCEDURE : create_domaine --*/
/*--
	Procédure pour ajouter un nouveau domaine technique
	Elle prend un paramètre :
		- p_Domaine : Le domaine technique à ajouter
--*/
CREATE PROCEDURE create_domaine(p_Domaine VARCHAR(100))
BEGIN
	INSERT INTO domaine (Domaine) VALUES
		(p_Domaine)
	;
END |


/*-- PROCEDURE : create_connaissance --*/
/*--
	Procédure pour ajouter une nouvelle connaissance technique
	Elle prend un paramètre :
		- p_Connaissance : La connaissance technique à ajouter
--*/
CREATE PROCEDURE create_connaissance(p_Connaissance VARCHAR(200))
BEGIN
	INSERT INTO connaissance (Connaissance) VALUES
		(p_Connaissance)
	;
END |


/*-- PROCEDURE : create_recherche --*/
/*--
	Procédure pour ajouter un nouveau statut de recherche
	Elle prend un paramètre :
		- p_Recherche : Le nouveau statut de recherche à ajouter
--*/
CREATE PROCEDURE create_recherche(p_Recherche VARCHAR(200))
BEGIN
	INSERT INTO recherche (Recherche) VALUES
		(p_Recherche)
	;
END |


/*-- PROCEDURE : create_certification --*/
/*--
	Procédure pour ajouter une nouvelle certification
	Elle prend deux paramètres :
		- p_Certification : La nouvelle certification à ajouter
		- p_Logo_certification : Le lien vers le logo de la nouvelle certification
--*/
CREATE PROCEDURE create_certification(p_Certification VARCHAR(200), p_Logo_certification TEXT)
BEGIN
	INSERT INTO certification (Certification, Logo_certification) VALUES
		(p_Certification, p_Logo_certification)
	;
END |


/*-- PROCEDURE : create_formation --*/
/*--
	Procédure pour ajouter une nouvelle formation
	Elle prend deux paramètres :
		- p_Formation : Le nom de la nouvelle formation à ajouter
		- p_Institution : Le nom de l'institution délivrant le diplôme
--*/
CREATE PROCEDURE create_formation(p_Formation VARCHAR(200), p_Institution VARCHAR(200))
BEGIN
	INSERT INTO formation (Formation, Institution) VALUES
		(p_Formation, p_Institution)
	;
END |


/*-- PROCEDURE : create_candidat --*/
/*--
	Procédure pour ajouter un nouveau profil candidat
	Elle prend paramètres :
		- p_Prenom : Le prénom du nouveau candidat
		- p_Nom : Le nom du nouveau candidat
		- p_Email : L'adresse email du nouveau candidat
		- p_Telephone : Le téléphone du nouveau candidat
		- p_Poste : Le poste recherché par le nouveau candidat
		- p_Annees_exp : Le nombre d'années d'expérience du nouveau candidat
--*/
CREATE PROCEDURE create_candidat(p_Prenom VARCHAR(100), p_Nom VARCHAR(100), p_Email VARCHAR(200), p_Telephone VARCHAR(10), p_Poste VARCHAR(200), p_Annees_exp INT)
BEGIN
	INSERT INTO candidat (Prenom, Nom, Email, Telephone, Poste, Annees_experience, ID_Recherche) VALUES
		(p_Prenom, p_Nom, p_Email, p_Telephone, p_Poste, p_Annees_exp, "1")
	;
END |


/*-- PROCEDURE : create_langue_candidat --*/
/*--
	Procédure pour ajouter une langue pratiquée à un candidat
	Elle prend trois paramètres :
		- p_ID_Candidat : Identifiant du candidat
		- p_ID_Langue : Identifiant de la langue
		- p_ID_Niveau : Identifiant du niveau de pratique de la langue
--*/
CREATE PROCEDURE create_langue_candidat(p_ID_Candidat INT, p_ID_Langue INT, p_ID_Niveau INT)
BEGIN
	INSERT INTO candidat_langue (ID_Candidat, ID_Langue, ID_Niveau) VALUES
		(p_ID_Candidat, p_ID_Langue, p_ID_Niveau)
	;
END |


/*-- PROCEDURE : create_connaissance_candidat --*/
/*--
	Procédure pour ajouter une connaissance technique à un candidat
	Elle prend 2 paramètres :
		- p_ID_Candidat : Identifiant du candidat
		- p_ID_Connaissance : Identifiant de la connaissance technique
--*/
CREATE PROCEDURE create_connaissance_candidat(p_ID_Candidat INT, p_ID_Connaissance INT)
BEGIN
	INSERT INTO candidat_connaissance (ID_Candidat, ID_Connaissance) VALUES
		(p_ID_Candidat, p_ID_Connaissance)
	;
END |


/*-- PROCEDURE : create_certification_candidat --*/
/*--
	Procédure pour ajouter une certification à un candidat
	Elle prend trois paramètres :
		- p_ID_Candidat : Identifiant du candidat
		- p_ID_Certification : Identifiant de la certification
		- p_Date_certification : Date d'obtention de la certification
--*/
CREATE PROCEDURE create_certification_candidat(p_ID_Candidat INT, p_ID_Certification INT, p_Date_certification DATE)
BEGIN
	INSERT INTO candidat_certification (ID_Candidat, ID_Certification, Date_certification) VALUES
		(p_ID_Candidat, p_ID_Certification, p_Date_certification)
	;
END |


/*-- PROCEDURE : create_formation_candidat --*/
/*--
	Procédure pour ajouter une formation à un candidat
	Elle prend trois paramètres :
		- p_ID_Candidat : Identifiant du candidat
		- p_ID_Formation : Identifiant de la formation
		- p_Date_formation : Date d'obtention du diplôme
--*/
CREATE PROCEDURE create_formation_candidat(p_ID_Candidat INT, p_ID_Formation INT, p_Date_formation DATE)
BEGIN
	INSERT INTO candidat_formation (ID_Candidat, ID_Formation, Date_formation) VALUES
		(p_ID_Candidat, p_ID_Formation, p_Date_formation)
	;
END |


/*-- PROCEDURE : create_experience_professionnelle --*/
/*--
	Procédure pour ajouter une nouvelle expérience professionnelle
	Elle prend neuf paramètres :
		- p_ID_Candidat : Identifiant du candidat
		- p_Entreprise : Le nom de l'entreprise
		- p_Date_debut : La date de début de la mission
		- p_Date_fin : La date de fin de la mission
		- p_Poste : Le poste occupé au sein de l'entreprise
		- p_Lieu : Le lieu de la mission
		- p_Description : La description de la mission effectuée
		- p_Elements_cles : La description des éléments clés de la mission
		- p_Environnement : La description de l'environnement de travail
--*/
CREATE PROCEDURE create_experience_professionnelle(p_ID_Candidat INT, p_Entreprise VARCHAR(200), p_Date_debut DATE, p_Date_fin DATE, p_Poste VARCHAR(200), p_Lieu VARCHAR(200), p_Description TEXT, p_Elements_cles TEXT, p_Environnement TEXT)
BEGIN
	INSERT INTO experience_professionnelle (ID_Candidat, Entreprise, Date_debut, Date_fin, Poste, Lieu, Description, Elements_cles, Environnement) VALUES
		(p_ID_Candidat, p_Entreprise, p_Date_debut, p_Date_fin, p_Poste, p_Lieu, p_Description, p_Elements_cles, p_Environnement)
	;
END |


/*-- Procédures GET pour récupérer les informations dans la base de données--*/
/*---------------------------------------------------------------------------*/

/*-- PROCEDURE : get_infos_utilisateur --*/
/*--
	Procédure qui permet de récupérer les informations d'un utilisateur
	Elle prend en paramètres :
		- p_ID_Utilisateur : Identifiant de l'utilisateur
--*/
CREATE PROCEDURE get_infos_utilisateur(p_ID_Utilisateur INT)
BEGIN
	SELECT u.Prenom, u.Nom, u.Email, s.Statut FROM utilisateur AS u
		JOIN statut AS s ON s.ID_Statut = u.ID_Statut
			WHERE ID_Utilisateur = p_ID_Utilisateur
	;
END |


/*-- PROCEDURE : get_langues --*/
/*--
	Procédure qui permet de récupérer la liste des langues
--*/
CREATE PROCEDURE get_langues()
BEGIN
	SELECT Langue FROM langue
	;
END |


/*-- PROCEDURE : get_niveaux --*/
/*--
	Procédure qui permet de récupérer la liste des niveaux de pratique d'une langue
--*/
CREATE PROCEDURE get_niveaux()
BEGIN
	SELECT Niveau FROM niveau
	;
END |


/*-- PROCEDURE : get_domaine --*/
/*--
	Procédure qui permet de récupérer la liste des domaines techniques
--*/
CREATE PROCEDURE get_domaines()
BEGIN
	SELECT Domaine FROM domaine
	;
END |


/*-- PROCEDURE : get_connaissance --*/
/*--
	Procédure qui permet de récupérer la liste des connaissances techniques
--*/
CREATE PROCEDURE get_connaissances()
BEGIN
	SELECT Connaissance FROM connaissance
	;
END |


/*-- PROCEDURE : get_recherches --*/
/*--
	Procédure qui permet de récupérer la liste des différents statuts de recherche
--*/
CREATE PROCEDURE get_recherches()
BEGIN
	SELECT Recherche FROM recherche
	;
END |


/*-- PROCEDURE : get_certifications --*/
/*--
	Procédure qui permet de récupérer la liste des certifications
--*/
CREATE PROCEDURE get_certifications()
BEGIN
	SELECT Certification, Logo_certification FROM certification
	;
END |


/*-- PROCEDURE : get_formations --*/
/*--
	Procédure qui permet de récupérer la liste des formations
--*/
CREATE PROCEDURE get_formations()
BEGIN
	SELECT Formation, Institution FROM formation
	;
END |


/*-- PROCEDURE : get_candidats --*/
/*--
	Procédure qui permet de récupérer la liste des candidats
--*/
CREATE PROCEDURE get_candidats()
BEGIN
	SELECT Prenom, Nom FROM candidat
	;
END |


/*-- PROCEDURE : get_infos_candidat --*/
/*--
	Procédure qui permet de récupérer les informations d'un candidat
	Elle prend un paramètre :
		- p_ID_Candidat : Identifiant du candidat
--*/
CREATE PROCEDURE get_infos_candidat(p_ID_Candidat INT)
BEGIN
	SELECT c.Prenom, c.Nom, c.Email, c.Telephone, c.Poste, c.Annees_experience, r.Recherche FROM candidat AS c
		JOIN recherche AS r ON r.ID_Recherche = c.ID_Recherche
			WHERE c.ID_Candidat = p_ID_Candidat
	; 
END |


/*-- PROCEDURE : get_langues_candidat --*/
/*--
	Procédure qui permet de récupérer les langues pratiquées par le candidat et le niveau de pratique
	Elle prend un paramètres :
		- p_ID_Candidat : Identifiant du candidat
--*/
CREATE PROCEDURE get_langues_candidat(p_ID_Candidat INT)
BEGIN
	SELECT cl.ID_Candidat, l.Langue, n.Niveau FROM candidat_langue AS cl
		JOIN langue AS l ON l.ID_Langue = cl.ID_Langue
		JOIN niveau AS n ON n.ID_Niveau = cl.ID_Niveau
			WHERE p_ID_Candidat = cl.ID_Candidat
	;
END |


/*-- PROCEDURE : get_connaissances_candidat --*/
/*--
	Procédure qui permet de récupérer les différentes connaissances techniques d'un candidat
	Elle prend un paramètres :
		- p_ID_Candidat : Identifiant du candidat
--*/
CREATE PROCEDURE get_connaissances_candidat(p_ID_Candidat INT)
BEGIN
	SELECT cc.ID_Candidat, co.Connaissance, d.Domaine FROM candidat_connaissance AS cc
		JOIN connaissance AS co ON co.ID_Connaissance = cc.ID_Connaissance
		JOIN candidat AS ca ON ca.ID_Candidat = cc.ID_Candidat
		JOIN domaine AS d ON d.ID_Domaine = co.ID_Domaine
			WHERE cc.ID_Candidat = p_ID_Candidat
	;
END |


/*-- PROCEDURE : get_certifications_candidat --*/
/*--
	Procédure qui permet de récupérer les différentes formations d'un candidat
	Elle prend un paramètres :
		- p_ID_Candidat : Identifiant du candidat
--*/
CREATE PROCEDURE get_certifications_candidat(p_ID_Candidat INT)
BEGIN
	SELECT cc.ID_Candidat, ce.Certification, cc.Date_certification, ce.Logo_certification FROM candidat_certification AS cc
		JOIN certification AS ce ON ce.ID_Certification = cc.ID_Certification
			WHERE cc.ID_Candidat = p_ID_Candidat
	; 
END |


/*-- PROCEDURE : get_formations_candidat --*/
/*-- 
	Procédure qui permet de récupérer la liste des formations d'un candidat
	Elle prend un paramètres :
		- p_ID_Candidat : Identifiant du candidat
--*/
CREATE PROCEDURE get_formations_candidat(p_ID_Candidat INT)
BEGIN
	SELECT f.Formation, f.Institution, cf.Date_formation FROM candidat_formation AS cf
		JOIN formation AS f ON f.ID_Formation = cf.ID_Formation
			WHERE cf.ID_Candidat = p_ID_Candidat
	;
END |


/*-- PROCEDURE : get_experiences_candidat --*/
/*--
	Procédure qui permet de récupérer les informations des différentes expériences professionnelles d'un candidat
	Elle prend un paramètres :
		- p_ID_Candidat : Identifiant du candidat
--*/
CREATE PROCEDURE get_experiences_candidat(p_ID_Candidat INT)
BEGIN
	SELECT Entreprise, Date_debut, Date_fin, Poste, Lieu, Description, Elements_cles, Environnement FROM experience_professionnelle
		WHERE ID_Candidat = p_ID_Candidat
	;
END |


/*-- Procédures SET pour mettre à jour les informations dans la base de données--*/
/*-------------------------------------------------------------------------------*/

/*-- PROCEDURE set_informations_utilisateur --*/
/*-- 
	Procédure pour mettre à jour les informations d'un utilisateur
	Elle prend cinq paramètres :
		- p_ID_Utilisateur : Identifiant de l'utilisateur
		- p_Prenom : Le prénom de l'utilisateur
		- p_Nom : Le nom de l'utilisateur
		- p_Email : L'adresse email de l'utilisateur
		- p_MotDePasse : Le mot de passe de l'utilisateur
--*/
CREATE PROCEDURE set_informations_utilisateur(p_ID_Utilisateur INT, p_Prenom VARCHAR(100), p_Nom VARCHAR(100), p_Email VARCHAR(200), p_MotDePasse TEXT)
BEGIN
	UPDATE utilisateur
		SET Prenom = p_Prenom,
			Nom = p_Nom,
			Email = p_Email,
			MotdePasse = p_MotDePasse
		WHERE ID_Utilisateur = p_ID_Utilisateur
	;
END |


/*-- PROCEDURE : set_informations_candidat --*/
/*--
	Procédure pour mettre à jour les informations du candidat
	Elle prend huit paramètres :
		- p_ID_Candidat : Identifiant du candidat
		- p_Prenom : Le prenom du candidat
		- p_Nom : le nom du candidat
		- p_Email : L'adresse email du candidat
		- p_Telephone : Le numéro de téléphone du candidat
		- p_Poste : Le poste recherché par le candidat
		- p_Annees_exp : Le nombre d'années d'expérience du candidat
		- p_ID_Recherche : Le statut d'avancée des recherches du candidat
--*/
CREATE PROCEDURE set_informations_candidat(p_ID_Candidat INT, p_Prenom VARCHAR(100), p_Nom VARCHAR(100), p_Email VARCHAR(200), p_Telephone VARCHAR(10), p_Poste VARCHAR(200), p_Annees_exp INT, p_ID_Recherche INT)
BEGIN
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
END |


/*-- PROCEDURE :  set_langues_candidat --*/
/*--
	Procédure pour mettre à jour les langues pratiquées par le candidat
	Elle prend trois paramètres :
		- p_ID_Candidat : Identifiant du candidat
		- p_ID_Langue : Identifiant de la langue
		- p_ID_Niveau : Identifiant du niveau de pratique de la langue
--*/
CREATE PROCEDURE set_langues_candidat(p_ID_Candidat INT, p_ID_Langue INT, p_ID_Niveau INT)
BEGIN
	UPDATE candidat_langue
		SET ID_Langue = p_ID_Langue,
			ID_Niveau = p_ID_Niveau
		WHERE ID_Candidat = p_ID_Candidat
	;
END |


/*-- PROCEDURE : set_connaissances_candidat --*/
/*--
	Procédure pour mettre à jour les connaissances techniques du candidat
	Elle prend deux paramètres :
		- p_ID_Candidat : Identifiant du candidat
		- p_ID_Connaissance : Identifiant de la connaissance technique du candidat
--*/
CREATE PROCEDURE set_connaissances_candidat(p_ID_Candidat INT, p_ID_Connaissance INT)
BEGIN
	UPDATE candidat_connaissance
		SET ID_Connaissance = p_ID_Connaissance
		WHERE ID_Candidat = p_ID_Candidat
	;
END |


/*-- PROCEDURE :  set_certifications_candidat --*/
/*--
	Procédure pour mettre à jour les certifications du candidat
	Elle prend trois paramètres :
		- p_ID_Candidat : Identifiant du candidat
		- p_ID_Certification : Identifiant de la certification
		- p_Date_certification : La date d'obtention de la certification
--*/
CREATE PROCEDURE set_certifications_candidat(p_ID_Candidat INT, p_ID_Certification INT, p_Date_certification DATE)
BEGIN
	UPDATE candidat_certification
		SET ID_Certification = p_ID_Certification,
			Date_certification = p_Date_certification
		WHERE ID_Candidat = p_ID_Candidat
	;
END |


/*-- PROCEDURE :  set_formations_candidat --*/
/*--
	Procédure pour mettre à jour les formations du candidat
	Elle prend trois paramètres :	
		- p_ID_Candidat : Identifiant du candidat
		- p_ID_Formation : Identifiant de la formation
		- p_Date_formation : Date d'obtention du diplôme
--*/
CREATE PROCEDURE set_formations_candidat(p_ID_Candidat INT, p_ID_Formation INT, p_Date_formation DATE)
BEGIN
	UPDATE candidat_formation
		SET ID_Formation = p_ID_Formation,
			Date_formation = p_Date_formation
		WHERE ID_Candidat = p_ID_Candidat
	;
END |


/*-- PROCEDURE : set_experience_professionnelle --*/
/*--
	Procédure pour mettre à jour une expérience professionnelle d'un candidat
	Elle prend neuf paramètres :
		- p_ID_Experience : Identifiant de l'expérience
		- p_Entreprise : Le nom de l'entreprise
		- p_Date_debut : La date de début de la mission
		- p_Date_fin : La date de fin de la mission
		- p_Poste : Le poste occupé au sein de l'entreprise
		- p_Lieu : Le lieu de la mission
		- p_Description : La description de la mission effectuée
		- p_Elements_cles : La description des éléments clés de la mission
		- p_Environnement : La description de l'environnement de travail
--*/
CREATE PROCEDURE set_experience_professionnelle(p_ID_Experience INT, p_Entreprise VARCHAR(200), p_Date_debut DATE, p_Date_fin DATE, p_Poste VARCHAR(200), p_Lieu VARCHAR(200), p_Description TEXT, p_Elements_cles TEXT, p_Environnement TEXT)
BEGIN
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
END |


/*-- Procédures DELETE supprimer les informations dans la base de données--*/
/*-------------------------------------------------------------------------*/

/*-- PROCEDURE : delete_statut --*/
/*--
	Procédure pour supprimer un statut d'utilisateur de la base de données
	Elle prend un paramètre :
		- p_ID_Statut : Identifiant du statut à supprimer
--*/
CREATE PROCEDURE delete_statut(p_ID_Statut INT)
BEGIN
	DELETE FROM statut
		WHERE ID_Statut = p_ID_Statut
	;
END |


/*-- PROCEDURE : delete_utilisateur --*/
/*--
	Procédure pour supprimer un utilisateur de la base de données
	Elle prend un paramètre : 
		- p_ID_Utilisateur : Identifiant de l'utilisateur à supprimer
--*/
CREATE PROCEDURE delete_utilisateur(p_ID_Utilisateur INT)
BEGIN
	DELETE FROM utilisateur
		WHERE ID_Utilisateur = p_ID_Utilisateur
	;
END |


/*-- PROCEDURE : delete_langue --*/
/*--
	Procédure pour supprimer une langue de la base de données
	Elle prend un paramètre :
		- p_ID_Langue : Identifiant de la langue à supprimer
--*/
CREATE PROCEDURE delete_langue(p_ID_Langue INT)
BEGIN
	DELETE FROM candidat_langue
		WHERE ID_Langue = p_ID_Langue
	;

	DELETE FROM langue
		WHERE ID_Langue = p_ID_Langue
	;
END |


/*-- PROCEDURE : delete_niveau --*/
/*--
	Procédure pour supprimer un niveau de pratique d'une langue de la base de données
	Elle prend un paramètre :
		- p_ID_Niveau : Identifiant du niveau de pratique à supprimer
--*/
CREATE PROCEDURE delete_niveau(p_ID_Niveau INT)
BEGIN
	DELETE FROM candidat_langue
		WHERE ID_Niveau = p_ID_Niveau
	;

	DELETE FROM niveau
		WHERE ID_Niveau = p_ID_Niveau
	;
END |


/*-- PROCEDURE : delete_domaine --*/
/*--
	Procédure pour supprimer un domaine technique de la base de données
	Elle prend un paramètre :
		- p_ID_Domaine : Identifiant du domaine technique à supprimer
--*/
CREATE PROCEDURE delete_domaine(p_ID_Domaine INT)
BEGIN
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
END |


/*-- PROCEDURE : delete_connaissance --*/
/*--
	Procédure pour supprimer une connaissance technique de la base de données
	Elle prend un paramètre :
		- p_ID_Connaissance : Identifiant de la connaissance technique à supprimer
--*/
CREATE PROCEDURE delete_connaissance(p_ID_Connaissance INT)
BEGIN
	DELETE FROM candidat_connaissance
		WHERE ID_Connaissance = p_ID_Connaissance
	;

	DELETE FROM connaissance
		WHERE ID_Connaissance = p_ID_Connaissance
	;
END |


/*-- PROCEDURE : delete_recherche --*/
/*--
	Procédure pour supprimer un statut de recherche de la base de données
	Elle prend un paramètre :
		- p_ID_Recherche : Identifiant du statut d'avancée de la recherche à supprimer
--*/
CREATE PROCEDURE delete_recherche(p_ID_Recherche INT)
BEGIN
	UPDATE candidat
		SET ID_Recherche = NULL
		WHERE ID_Recherche = p_ID_Recherche
	;

	DELETE FROM recherche
		WHERE ID_Recherche = p_ID_Recherche
	;
END |



/*-- PROCEDURE : delete_certification --*/
/*--
	Procédure pour supprimer une certification de la base de données
	Elle prend un paramètre :
		- p_ID_Certification : Identifiant de la certification à supprimer
--*/
CREATE PROCEDURE delete_certification(p_ID_Certification INT)
BEGIN
	DELETE FROM candidat_certification
		WHERE ID_Certification = p_ID_Certification
	;

	DELETE FROM certification
		WHERE ID_Certification = p_ID_Certification
	;
END |


/*-- PROCEDURE : delete_formation --*/
/*--
	Procédure pour supprimer une formation de la base de données
	Elle prend un paramètre :
		- p_ID_Formation : Identifiant de la formation à supprimer
--*/
CREATE PROCEDURE delete_formation(p_ID_Formation INT)
BEGIN
	DELETE FROM candidat_formation
		WHERE ID_Formation = p_ID_Formation
	;

	DELETE FROM formation
		WHERE ID_Formation = p_ID_Formation
	;
END |


/*-- PROCEDURE : delete_candidat --*/
/*--
	Procédure pour supprimer un candidat de la base de données
	Elle prend un paramètre :
		- p_ID_Candidat : Identifiant du profil candidat à supprimer
--*/
CREATE PROCEDURE delete_candidat(p_ID_Candidat INT)
BEGIN
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
END |


/*-- PROCEDURE : delete_langue_candidat --*/
/*--
	Procédure pour supprimer une langue pratiquée par un candidat
	Elle prend deux paramètres :
		- p_ID_Candidat : Identifiant du candidat
		- p_ID_Langue : Identifiant de la langue à supprimer
--*/
CREATE PROCEDURE delete_langue_candidat(p_ID_Candidat INT, p_ID_Langue INT)
BEGIN
	DELETE FROM candidat_langue
		WHERE ID_Candidat = p_ID_Candidat AND ID_Langue = p_ID_Langue
	;
END |


/*-- PROCEDURE : delete_connaissance_candidat --*/
/*--
	Procédure pour supprimer une connaissance technique d'un candidat
	Elle prend deux paramètres :
		- p_ID_Candidat : Identifiant du candidat
		- p_ID_Connaissance : Identifiant de la connaissance technique à supprimer
--*/
CREATE PROCEDURE delete_connaissance_candidat(p_ID_Candidat INT, p_ID_Connaissance INT)
BEGIN
	DELETE FROM candidat_connaissance
		WHERE ID_Candidat = p_ID_Candidat AND ID_Connaissance = p_ID_Connaissance
	;
END |


/*-- PROCEDURE : delete_certification_candidat --*/
/*--
	Procédure pour supprimer une langue pratiquée par un candidat
	Elle prend deux paramètres :
		- p_ID_Candidat : Identifiant du candidat
		- p_ID_Certification : Identifiant de la certification à supprimer
--*/
CREATE PROCEDURE delete_certification_candidat(p_ID_Candidat INT, p_ID_Certification INT)
BEGIN
	DELETE FROM candidat_certification
		WHERE ID_Candidat = p_ID_Candidat AND ID_Certification = p_ID_Certification
	;
END |


/*-- PROCEDURE : delete_formation_candidat --*/
/*--
	Procédure pour supprimer une langue pratiquée par un candidat
	Elle prend deux paramètres :
		- p_ID_Candidat : Identifiant du candidat
		- p_ID_Langue : Identifiant de la formation à supprimer
--*/
CREATE PROCEDURE delete_formation_candidat(p_ID_Candidat INT, p_ID_Formation INT)
BEGIN
	DELETE FROM candidat_formation
		WHERE ID_Candidat = p_ID_Candidat AND ID_Formation = p_ID_Formation
	;
END |


/*-- PROCEDURE : delete_experience_candidat --*/
/*--
	Procédure pour supprimer une expérience professionnelle d'un candidat
	Elle prend deux paramètres :
		- p_ID_Candidat : Identifiant du candidat
		- p_ID_Experience : Identifiant de l'experience
--*/
CREATE PROCEDURE delete_experience_candidat(p_ID_Candidat INT, p_ID_Experience INT)
BEGIN
	DELETE FROM candidat_formation
		WHERE ID_Candidat = p_ID_Candidat AND ID_Experience = p_ID_Experience
	;
END |


/*-- Autres procédures de la base de donneés --*/
/*---------------------------------------------*/


DELIMITER ;

/*----------------------------------------------------*/



/*-- Insertion des données initiales dans la base de données --*/
/*-------------------------------------------------------------*/


/*-- TABLE : statut --*/
/*--
	Insertion des différents statuts dans la table statut
--*/
INSERT INTO statut (Statut) VALUES
	("Administrateur"), ("Utilisateur")
;


/*-- TABLE : langue --*/
/*--
	Insertion des différentes langues dans la table langue
--*/
INSERT INTO langue (Langue) VALUES
	("Anglais"), ("Français"), ("Espagnol"), ("Allemand")
;


/*-- TABLE : niveau --*/
/*--
	Insertion des différents niveaux de pratique dans la table niveau
--*/
INSERT INTO niveau (Niveau) VALUES
	("Courant"), ("Lu, écrit, parlé"), ("Scolaire")
;


/*-- TABLE : domaine --*/
/*--
	Insertion des différents domaines techniques dans la table domaine
--*/
INSERT INTO domaine (Domaine) VALUES
	("Systèmes"), ("Virtualisation"), ("BDD"), ("Langages"), ("Logiciels"), ("Bureautique"), ("Réseaux")
;


/*-- TABLE : recherche --*/
/*--
	Insertion des différentes étapes de recherche
--*/
/*INSERT INTO recherche (Recherche) VALUES 
	
;*/

/*-------------------------------------------------------------*/