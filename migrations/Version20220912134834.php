<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220912134834 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user_invoice (user_id INT NOT NULL, invoice_id INT NOT NULL, INDEX IDX_C868094EA76ED395 (user_id), INDEX IDX_C868094E2989F1FD (invoice_id), PRIMARY KEY(user_id, invoice_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user_invoice ADD CONSTRAINT FK_C868094EA76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_invoice ADD CONSTRAINT FK_C868094E2989F1FD FOREIGN KEY (invoice_id) REFERENCES invoice (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE invoice ADD user_id INT NOT NULL');
        $this->addSql('ALTER TABLE invoice ADD CONSTRAINT FK_90651744A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('CREATE INDEX IDX_90651744A76ED395 ON invoice (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user_invoice DROP FOREIGN KEY FK_C868094EA76ED395');
        $this->addSql('ALTER TABLE user_invoice DROP FOREIGN KEY FK_C868094E2989F1FD');
        $this->addSql('DROP TABLE user_invoice');
        $this->addSql('ALTER TABLE invoice DROP FOREIGN KEY FK_90651744A76ED395');
        $this->addSql('DROP INDEX IDX_90651744A76ED395 ON invoice');
        $this->addSql('ALTER TABLE invoice DROP user_id');
    }
}
