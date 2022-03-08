<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220222112416 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE avis (id INT AUTO_INCREMENT NOT NULL, note INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE commentaire_avis ADD avis_id INT NOT NULL');
        $this->addSql('ALTER TABLE commentaire_avis ADD CONSTRAINT FK_66696FA2197E709F FOREIGN KEY (avis_id) REFERENCES avis (id)');
        $this->addSql('CREATE INDEX IDX_66696FA2197E709F ON commentaire_avis (avis_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commentaire_avis DROP FOREIGN KEY FK_66696FA2197E709F');
        $this->addSql('DROP TABLE avis');
        $this->addSql('DROP INDEX IDX_66696FA2197E709F ON commentaire_avis');
        $this->addSql('ALTER TABLE commentaire_avis DROP avis_id');
    }
}
