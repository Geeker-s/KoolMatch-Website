<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220408230416 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
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
        $this->addSql('ALTER TABLE recette CHANGE photo_recette photo_recette VARCHAR(255) NOT NULL, CHANGE description_recette description_recette VARCHAR(255) NOT NULL, CHANGE archive archive INT NOT NULL');
        $this->addSql('ALTER TABLE reservation CHANGE archive archive INT NOT NULL');
        $this->addSql('ALTER TABLE user CHANGE archive archive INT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
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
        $this->addSql('ALTER TABLE recette CHANGE photo_recette photo_recette VARCHAR(50) NOT NULL, CHANGE description_recette description_recette VARCHAR(50) NOT NULL, CHANGE archive archive INT DEFAULT 0 NOT NULL');
        $this->addSql('ALTER TABLE reservation CHANGE archive archive INT DEFAULT 0 NOT NULL');
        $this->addSql('ALTER TABLE user CHANGE archive archive INT DEFAULT 0 NOT NULL');
    }
}
