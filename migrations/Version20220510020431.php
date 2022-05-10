<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220510020431 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE interaction DROP FOREIGN KEY fk_user1_interaction');
        $this->addSql('ALTER TABLE interaction DROP FOREIGN KEY fk_user2_interaction');
        $this->addSql('ALTER TABLE interaction ADD CONSTRAINT FK_378DFDA762D4C465 FOREIGN KEY (id_user1) REFERENCES user (id_user)');
        $this->addSql('ALTER TABLE interaction ADD CONSTRAINT FK_378DFDA7FBDD95DF FOREIGN KEY (id_user2) REFERENCES user (id_user)');
        $this->addSql('ALTER TABLE jeu CHANGE id_quiz id_quiz INT NOT NULL');
        $this->addSql('ALTER TABLE quiz DROP FOREIGN KEY fk_r');
        $this->addSql('ALTER TABLE quiz CHANGE id_recette id_recette INT DEFAULT NULL');
        $this->addSql('ALTER TABLE quiz ADD CONSTRAINT FK_A412FA929726CAE0 FOREIGN KEY (id_recette) REFERENCES recette (id_recette)');
        $this->addSql('ALTER TABLE user CHANGE latitude latitude DOUBLE PRECISION DEFAULT NULL, CHANGE longitude longitude DOUBLE PRECISION DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE interaction DROP FOREIGN KEY FK_378DFDA762D4C465');
        $this->addSql('ALTER TABLE interaction DROP FOREIGN KEY FK_378DFDA7FBDD95DF');
        $this->addSql('ALTER TABLE interaction ADD CONSTRAINT fk_user1_interaction FOREIGN KEY (id_user1) REFERENCES user (id_user) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE interaction ADD CONSTRAINT fk_user2_interaction FOREIGN KEY (id_user2) REFERENCES user (id_user) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE jeu CHANGE id_quiz id_quiz INT DEFAULT NULL');
        $this->addSql('ALTER TABLE quiz DROP FOREIGN KEY FK_A412FA929726CAE0');
        $this->addSql('ALTER TABLE quiz CHANGE id_recette id_recette INT NOT NULL');
        $this->addSql('ALTER TABLE quiz ADD CONSTRAINT fk_r FOREIGN KEY (id_recette) REFERENCES recette (id_recette) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user CHANGE latitude latitude DOUBLE PRECISION DEFAULT \'10\' NOT NULL, CHANGE longitude longitude DOUBLE PRECISION DEFAULT \'10\' NOT NULL');
    }
}
