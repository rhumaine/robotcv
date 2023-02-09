<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230209162310 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE site (id INT AUTO_INCREMENT NOT NULL, localisation VARCHAR(255) NOT NULL, adresse VARCHAR(255) NOT NULL, code_postal INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE candidat DROP FOREIGN KEY candidat_ibfk_1');
        $this->addSql('ALTER TABLE candidat_certification DROP FOREIGN KEY candidat_certification_ibfk_1');
        $this->addSql('ALTER TABLE candidat_certification DROP FOREIGN KEY candidat_certification_ibfk_2');
        $this->addSql('ALTER TABLE candidat_connaissance DROP FOREIGN KEY candidat_connaissance_ibfk_2');
        $this->addSql('ALTER TABLE candidat_connaissance DROP FOREIGN KEY candidat_connaissance_ibfk_1');
        $this->addSql('ALTER TABLE candidat_formation DROP FOREIGN KEY candidat_formation_ibfk_1');
        $this->addSql('ALTER TABLE candidat_formation DROP FOREIGN KEY candidat_formation_ibfk_2');
        $this->addSql('ALTER TABLE candidat_langue DROP FOREIGN KEY candidat_langue_ibfk_1');
        $this->addSql('ALTER TABLE candidat_langue DROP FOREIGN KEY candidat_langue_ibfk_2');
        $this->addSql('ALTER TABLE candidat_langue DROP FOREIGN KEY candidat_langue_ibfk_3');
        $this->addSql('ALTER TABLE connaissance DROP FOREIGN KEY connaissance_ibfk_1');
        $this->addSql('ALTER TABLE experience_professionnelle DROP FOREIGN KEY experience_professionnelle_ibfk_1');
        $this->addSql('ALTER TABLE utilisateur DROP FOREIGN KEY utilisateur_ibfk_1');
        $this->addSql('DROP TABLE candidat');
        $this->addSql('DROP TABLE candidat_certification');
        $this->addSql('DROP TABLE candidat_connaissance');
        $this->addSql('DROP TABLE candidat_formation');
        $this->addSql('DROP TABLE candidat_langue');
        $this->addSql('DROP TABLE certification');
        $this->addSql('DROP TABLE connaissance');
        $this->addSql('DROP TABLE domaine');
        $this->addSql('DROP TABLE experience_professionnelle');
        $this->addSql('DROP TABLE formation');
        $this->addSql('DROP TABLE langue');
        $this->addSql('DROP TABLE niveau');
        $this->addSql('DROP TABLE recherche');
        $this->addSql('DROP TABLE statut');
        $this->addSql('DROP TABLE utilisateur');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE candidat (ID_Candidat INT AUTO_INCREMENT NOT NULL COMMENT \'Identifiant du candidat\', Profil VARCHAR(3) CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci`, Prenom VARCHAR(100) CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci` COMMENT \'Prénom du candidat\', Nom VARCHAR(100) CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci` COMMENT \'Nom du candidat\', Email VARCHAR(200) CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci` COMMENT \'Email du candidat\', Telephone VARCHAR(10) CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci` COMMENT \'Téléphone du candidat\', Poste VARCHAR(200) CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci` COMMENT \'Poste auquel le candidat postule\', Annees_experience INT NOT NULL COMMENT \'Nombre d\'\'années d\'\'expérience du candidat\', ID_Recherche INT DEFAULT NULL COMMENT \'Identifiant de l\'\'étape de recherche\', UNIQUE INDEX Email (Email), INDEX ID_Recherche (ID_Recherche), PRIMARY KEY(ID_Candidat)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE candidat_certification (ID_Candidat INT NOT NULL COMMENT \'Identifiant du candidat\', ID_Certification INT NOT NULL COMMENT \'Identifiant de la certification\', INDEX ID_Certification (ID_Certification), INDEX IDX_8D903D8EAD9B6B5 (ID_Candidat), PRIMARY KEY(ID_Candidat, ID_Certification)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE candidat_connaissance (ID_Candidat INT NOT NULL COMMENT \'Identifiant du candidat\', ID_Connaissance INT NOT NULL COMMENT \'Identifiant de la connaissance technique\', INDEX ID_Connaissance (ID_Connaissance), INDEX IDX_9D02004BAD9B6B5 (ID_Candidat), PRIMARY KEY(ID_Candidat, ID_Connaissance)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE candidat_formation (ID_Candidat INT NOT NULL COMMENT \'Identifiant du candidat\', ID_Formation INT NOT NULL COMMENT \'Identifiant de la formation\', Date_formation DATE NOT NULL COMMENT \'Date d\'\'obtention du diplome\', INDEX ID_Formation (ID_Formation), INDEX IDX_B00F34FDAD9B6B5 (ID_Candidat), PRIMARY KEY(ID_Candidat, ID_Formation)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE candidat_langue (ID_Candidat INT NOT NULL COMMENT \'Identifiant du candidat\', ID_Langue INT NOT NULL COMMENT \'Identifiant de la langue\', ID_Niveau INT NOT NULL COMMENT \'Identifiant du niveau\', INDEX ID_Langue (ID_Langue), INDEX ID_Niveau (ID_Niveau), INDEX IDX_2D9C88F2AD9B6B5 (ID_Candidat), PRIMARY KEY(ID_Candidat, ID_Langue, ID_Niveau)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE certification (ID_Certification INT AUTO_INCREMENT NOT NULL COMMENT \'Identifiant de la certification\', Certification VARCHAR(200) CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci` COMMENT \'Nom de la certification\', Logo_certification TEXT CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_unicode_ci` COMMENT \'Lien vers le logo de la certification\', UNIQUE INDEX Certification (Certification), PRIMARY KEY(ID_Certification)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE connaissance (ID_Connaissance INT AUTO_INCREMENT NOT NULL COMMENT \'Identifiant de la connaissance technique\', Connaissance VARCHAR(200) CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci` COMMENT \'Connaissance technique\', ID_Domaine INT NOT NULL COMMENT \'Identifiant du domaine de la connaissance\', INDEX ID_Domaine (ID_Domaine), UNIQUE INDEX Connaissance (Connaissance), PRIMARY KEY(ID_Connaissance)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE domaine (ID_Domaine INT AUTO_INCREMENT NOT NULL COMMENT \'Identifiant du domaine\', Domaine VARCHAR(100) CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci` COMMENT \'Domaine technique\', UNIQUE INDEX Domaine (Domaine), PRIMARY KEY(ID_Domaine)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE experience_professionnelle (ID_Experience INT AUTO_INCREMENT NOT NULL COMMENT \'Identifiant de l\'\'expérience professionnelle\', ID_Candidat INT NOT NULL COMMENT \'Identifiant du candidat\', Entreprise VARCHAR(200) CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci` COMMENT \'Nom de l\'\'entreprise\', Date_debut DATE NOT NULL COMMENT \'Date de début de la mission\', Date_fin DATE DEFAULT NULL COMMENT \'Date de fin de la mission\', Poste VARCHAR(200) CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci` COMMENT \'Poste au sein de l\'\'entreprise\', Lieu VARCHAR(200) CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci` COMMENT \'Lieu de la mission\', Description TEXT CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci` COMMENT \'Description de la mission\', Elements_cles TEXT CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_unicode_ci` COMMENT \'Eléments clés de la mission\', Environnement TEXT CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci` COMMENT \'Description de l\'\'environnement de travail\', INDEX ID_Candidat (ID_Candidat), PRIMARY KEY(ID_Experience)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE formation (ID_Formation INT AUTO_INCREMENT NOT NULL COMMENT \'Identifiant de la formation\', Formation VARCHAR(200) CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci` COMMENT \'Le nom de la formation\', Institution VARCHAR(200) CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci` COMMENT \'Institution délivrant le diplome\', UNIQUE INDEX Formation (Formation), PRIMARY KEY(ID_Formation)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE langue (ID_Langue INT AUTO_INCREMENT NOT NULL COMMENT \'Identifiant de la langue\', Langue VARCHAR(50) CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci` COMMENT \'Langue\', UNIQUE INDEX Langue (Langue), PRIMARY KEY(ID_Langue)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE niveau (ID_Niveau INT AUTO_INCREMENT NOT NULL COMMENT \'Identifiant du niveau\', Niveau VARCHAR(50) CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci` COMMENT \'Niveau de pratique\', UNIQUE INDEX Niveau (Niveau), PRIMARY KEY(ID_Niveau)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE recherche (ID_Recherche INT AUTO_INCREMENT NOT NULL COMMENT \'Identifiant de l\'\'étape de recherche\', Recherche VARCHAR(200) CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci` COMMENT \'Etape de la recherche\', UNIQUE INDEX Recherche (Recherche), PRIMARY KEY(ID_Recherche)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE statut (ID_Statut INT AUTO_INCREMENT NOT NULL COMMENT \'Identifiant du statut\', Statut VARCHAR(50) CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci` COMMENT \'Statut\', UNIQUE INDEX Statut (Statut), UNIQUE INDEX Statut_2 (Statut), PRIMARY KEY(ID_Statut)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE utilisateur (ID_Utilisateur INT AUTO_INCREMENT NOT NULL COMMENT \'Identifiant de l\'\'utilisateur\', prenom VARCHAR(100) CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci` COMMENT \'Prénom de l\'\'utilisateur\', nom VARCHAR(100) CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci` COMMENT \'Nom de l\'\'utilisateur\', email VARCHAR(200) CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci` COMMENT \'Adresse email de l\'\'utilisateur\', password VARCHAR(200) CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci` COMMENT \'Mot de passe de l\'\'utilisateur\', ID_Statut INT NOT NULL COMMENT \'Statut de l\'\'utilisateur\', UNIQUE INDEX Email (email), UNIQUE INDEX Email_2 (email), INDEX ID_Statut (ID_Statut), PRIMARY KEY(ID_Utilisateur)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE candidat ADD CONSTRAINT candidat_ibfk_1 FOREIGN KEY (ID_Recherche) REFERENCES recherche (ID_Recherche)');
        $this->addSql('ALTER TABLE candidat_certification ADD CONSTRAINT candidat_certification_ibfk_1 FOREIGN KEY (ID_Candidat) REFERENCES candidat (ID_Candidat)');
        $this->addSql('ALTER TABLE candidat_certification ADD CONSTRAINT candidat_certification_ibfk_2 FOREIGN KEY (ID_Certification) REFERENCES certification (ID_Certification)');
        $this->addSql('ALTER TABLE candidat_connaissance ADD CONSTRAINT candidat_connaissance_ibfk_2 FOREIGN KEY (ID_Connaissance) REFERENCES connaissance (ID_Connaissance)');
        $this->addSql('ALTER TABLE candidat_connaissance ADD CONSTRAINT candidat_connaissance_ibfk_1 FOREIGN KEY (ID_Candidat) REFERENCES candidat (ID_Candidat)');
        $this->addSql('ALTER TABLE candidat_formation ADD CONSTRAINT candidat_formation_ibfk_1 FOREIGN KEY (ID_Candidat) REFERENCES candidat (ID_Candidat)');
        $this->addSql('ALTER TABLE candidat_formation ADD CONSTRAINT candidat_formation_ibfk_2 FOREIGN KEY (ID_Formation) REFERENCES formation (ID_Formation)');
        $this->addSql('ALTER TABLE candidat_langue ADD CONSTRAINT candidat_langue_ibfk_1 FOREIGN KEY (ID_Candidat) REFERENCES candidat (ID_Candidat)');
        $this->addSql('ALTER TABLE candidat_langue ADD CONSTRAINT candidat_langue_ibfk_2 FOREIGN KEY (ID_Langue) REFERENCES langue (ID_Langue)');
        $this->addSql('ALTER TABLE candidat_langue ADD CONSTRAINT candidat_langue_ibfk_3 FOREIGN KEY (ID_Niveau) REFERENCES niveau (ID_Niveau)');
        $this->addSql('ALTER TABLE connaissance ADD CONSTRAINT connaissance_ibfk_1 FOREIGN KEY (ID_Domaine) REFERENCES domaine (ID_Domaine)');
        $this->addSql('ALTER TABLE experience_professionnelle ADD CONSTRAINT experience_professionnelle_ibfk_1 FOREIGN KEY (ID_Candidat) REFERENCES candidat (ID_Candidat)');
        $this->addSql('ALTER TABLE utilisateur ADD CONSTRAINT utilisateur_ibfk_1 FOREIGN KEY (ID_Statut) REFERENCES statut (ID_Statut)');
        $this->addSql('DROP TABLE site');
    }
}
