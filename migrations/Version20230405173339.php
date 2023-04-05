<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230405173339 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE achat ADD date_achat DATETIME NULL, ADD quantite INT NOT NULL, ADD status VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE produit ADD prix_ttc INT NOT NULL, ADD etat TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE user ADD conseiller_id INT DEFAULT NULL, ADD nom_entreprise VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6491AC39A0D FOREIGN KEY (conseiller_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_8D93D6491AC39A0D ON user (conseiller_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE achat DROP date_achat, DROP quantite, DROP status');
        $this->addSql('ALTER TABLE produit DROP prix_ttc, DROP etat');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6491AC39A0D');
        $this->addSql('DROP INDEX IDX_8D93D6491AC39A0D ON user');
        $this->addSql('ALTER TABLE user DROP conseiller_id, DROP nom_entreprise');
    }
}
