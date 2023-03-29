<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230329170629 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE planning ADD date_depart DATETIME NOT NULL, ADD date_fin DATETIME NOT NULL');
        $this->addSql('ALTER TABLE produit ADD nbr_jour INT NOT NULL, ADD nbr_nuit INT NOT NULL, ADD description_programme LONGTEXT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE planning DROP date_depart, DROP date_fin');
        $this->addSql('ALTER TABLE produit DROP nbr_jour, DROP nbr_nuit, DROP description_programme');
    }
}
