<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220426015030 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE recherche (id INT AUTO_INCREMENT NOT NULL, nom_gerant VARCHAR(255) NOT NULL, nom_user VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE admin CHANGE archive archive INT NOT NULL');
        $this->addSql('ALTER TABLE conversation CHANGE archive archive INT NOT NULL');
        $this->addSql('ALTER TABLE evenement CHANGE archive archive INT NOT NULL');
        $this->addSql('ALTER TABLE gerant CHANGE archive archive INT NOT NULL');
        $this->addSql('ALTER TABLE interaction CHANGE archive archive INT NOT NULL');
        $this->addSql('ALTER TABLE invitation CHANGE archive archive INT NOT NULL');
        $this->addSql('ALTER TABLE jeu CHANGE archive archive INT NOT NULL');
        $this->addSql('ALTER TABLE matching CHANGE archive archive INT NOT NULL');
        $this->addSql('ALTER TABLE message CHANGE archive archive INT NOT NULL');
        $this->addSql('ALTER TABLE quiz CHANGE archive archive INT DEFAULT NULL');
        $this->addSql('ALTER TABLE recette CHANGE archive archive INT NOT NULL');
        $this->addSql('ALTER TABLE reservation CHANGE archive archive INT NOT NULL');
        $this->addSql('ALTER TABLE user ADD reset_token VARCHAR(300) NOT NULL, CHANGE adresse_user adresse_user VARCHAR(255) DEFAULT \'x\' NOT NULL, CHANGE archive archive INT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE recherche');
        $this->addSql('ALTER TABLE admin CHANGE archive archive INT DEFAULT 0 NOT NULL');
        $this->addSql('ALTER TABLE conversation CHANGE archive archive INT DEFAULT 0 NOT NULL');
        $this->addSql('ALTER TABLE evenement CHANGE archive archive INT DEFAULT 0 NOT NULL');
        $this->addSql('ALTER TABLE gerant CHANGE archive archive INT DEFAULT 0 NOT NULL');
        $this->addSql('ALTER TABLE interaction CHANGE archive archive INT DEFAULT 0 NOT NULL');
        $this->addSql('ALTER TABLE invitation CHANGE archive archive INT DEFAULT 0 NOT NULL');
        $this->addSql('ALTER TABLE jeu CHANGE archive archive INT DEFAULT 0 NOT NULL');
        $this->addSql('ALTER TABLE matching CHANGE archive archive INT DEFAULT 0 NOT NULL');
        $this->addSql('ALTER TABLE message CHANGE archive archive INT DEFAULT 0 NOT NULL');
        $this->addSql('ALTER TABLE quiz CHANGE archive archive INT DEFAULT 0');
        $this->addSql('ALTER TABLE recette CHANGE archive archive INT DEFAULT 0 NOT NULL');
        $this->addSql('ALTER TABLE reservation CHANGE archive archive INT DEFAULT 0 NOT NULL');
        $this->addSql('ALTER TABLE user DROP reset_token, CHANGE adresse_user adresse_user VARCHAR(255) DEFAULT \'\'\'x\'\'\' NOT NULL, CHANGE archive archive INT DEFAULT 0 NOT NULL');
    }
}
