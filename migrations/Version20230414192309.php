<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230414192309 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE message (id INT AUTO_INCREMENT NOT NULL, messagerie_id INT DEFAULT NULL, author_id INT DEFAULT NULL, contenu LONGTEXT DEFAULT NULL, date DATETIME DEFAULT NULL, INDEX IDX_B6BD307F836C1031 (messagerie_id), INDEX IDX_B6BD307FF675F31B (author_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messagerie (id INT AUTO_INCREMENT NOT NULL, objet VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messagerie_user (messagerie_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_3F145465836C1031 (messagerie_id), INDEX IDX_3F145465A76ED395 (user_id), PRIMARY KEY(messagerie_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307F836C1031 FOREIGN KEY (messagerie_id) REFERENCES messagerie (id)');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307FF675F31B FOREIGN KEY (author_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE messagerie_user ADD CONSTRAINT FK_3F145465836C1031 FOREIGN KEY (messagerie_id) REFERENCES messagerie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE messagerie_user ADD CONSTRAINT FK_3F145465A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307F836C1031');
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307FF675F31B');
        $this->addSql('ALTER TABLE messagerie_user DROP FOREIGN KEY FK_3F145465836C1031');
        $this->addSql('ALTER TABLE messagerie_user DROP FOREIGN KEY FK_3F145465A76ED395');
        $this->addSql('DROP TABLE message');
        $this->addSql('DROP TABLE messagerie');
        $this->addSql('DROP TABLE messagerie_user');
    }
}
