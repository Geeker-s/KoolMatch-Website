<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220507210027 extends AbstractMigration
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
        $this->addSql('ALTER TABLE interaction CHANGE id_user1 id_user1 INT DEFAULT NULL, CHANGE id_user2 id_user2 INT DEFAULT NULL, CHANGE archive archive INT NOT NULL');
        $this->addSql('ALTER TABLE invitation CHANGE archive archive INT NOT NULL');
        $this->addSql('ALTER TABLE jeu CHANGE archive archive INT NOT NULL');
        $this->addSql('ALTER TABLE matching CHANGE id_user1 id_user1 INT DEFAULT NULL, CHANGE id_user2 id_user2 INT DEFAULT NULL, CHANGE archive archive INT NOT NULL');
        $this->addSql('ALTER TABLE message CHANGE archive archive INT NOT NULL');
        $this->addSql('ALTER TABLE quiz CHANGE archive archive INT DEFAULT NULL');
        $this->addSql('ALTER TABLE recette CHANGE archive archive INT NOT NULL');
        $this->addSql('ALTER TABLE reservation CHANGE archive archive INT NOT NULL');
        $this->addSql('ALTER TABLE user ADD reset_token VARCHAR(300) DEFAULT NULL, CHANGE preferredMinAge_user preferredMinAge_user INT NOT NULL, CHANGE preferredMaxAge_user preferredMaxAge_user INT NOT NULL, CHANGE archive archive INT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE admin CHANGE archive archive INT DEFAULT 0 NOT NULL');
        $this->addSql('ALTER TABLE conversation CHANGE archive archive INT DEFAULT 0 NOT NULL');
        $this->addSql('ALTER TABLE evenement CHANGE archive archive INT DEFAULT 0 NOT NULL');
        $this->addSql('ALTER TABLE gerant CHANGE archive archive INT DEFAULT 0 NOT NULL');
        $this->addSql('ALTER TABLE interaction CHANGE id_user1 id_user1 INT NOT NULL, CHANGE id_user2 id_user2 INT NOT NULL, CHANGE archive archive INT DEFAULT 0 NOT NULL');
        $this->addSql('ALTER TABLE invitation CHANGE archive archive INT DEFAULT 0 NOT NULL');
        $this->addSql('ALTER TABLE jeu CHANGE archive archive INT DEFAULT 0 NOT NULL');
        $this->addSql('ALTER TABLE matching CHANGE id_user1 id_user1 INT NOT NULL, CHANGE id_user2 id_user2 INT NOT NULL, CHANGE archive archive INT DEFAULT 0 NOT NULL');
        $this->addSql('ALTER TABLE message CHANGE archive archive INT DEFAULT 0 NOT NULL');
        $this->addSql('ALTER TABLE quiz CHANGE archive archive INT DEFAULT 0');
        $this->addSql('ALTER TABLE recette CHANGE archive archive INT DEFAULT 0 NOT NULL');
        $this->addSql('ALTER TABLE reservation CHANGE archive archive INT DEFAULT 0 NOT NULL');
        $this->addSql('ALTER TABLE user DROP reset_token, CHANGE preferredMinAge_user preferredMinAge_user INT DEFAULT 18 NOT NULL, CHANGE preferredMaxAge_user preferredMaxAge_user INT DEFAULT 58 NOT NULL, CHANGE archive archive INT DEFAULT 0 NOT NULL');
    }
}
