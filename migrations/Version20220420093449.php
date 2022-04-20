<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220420093449 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_U');
        $this->addSql('ALTER TABLE reservation CHANGE id_restaurant id_restaurant INT DEFAULT NULL');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C849554E1F92E8 FOREIGN KEY (id_restaurant) REFERENCES restaurant (id_restaurant)');
        $this->addSql('ALTER TABLE restaurant CHANGE nom_restaurant nom_restaurant VARCHAR(255) NOT NULL, CHANGE id_gerant id_gerant INT NOT NULL, CHANGE image_structure_resturant image_structure_resturant VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C849554E1F92E8');
        $this->addSql('ALTER TABLE reservation CHANGE id_restaurant id_restaurant INT NOT NULL');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_U FOREIGN KEY (id_restaurant) REFERENCES restaurant (id_restaurant) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE restaurant CHANGE nom_restaurant nom_restaurant VARCHAR(20) NOT NULL, CHANGE id_gerant id_gerant INT DEFAULT NULL, CHANGE image_structure_resturant image_structure_resturant VARCHAR(255) DEFAULT NULL');
    }
}
