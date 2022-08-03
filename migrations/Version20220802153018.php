<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220802153018 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE nazev_jidla_druh_jidla (nazev_jidla_id INT NOT NULL, druh_jidla_id INT NOT NULL, INDEX IDX_75393A0676E26623 (nazev_jidla_id), INDEX IDX_75393A0663D933B2 (druh_jidla_id), PRIMARY KEY(nazev_jidla_id, druh_jidla_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE nazev_jidla_druh_jidla ADD CONSTRAINT FK_75393A0676E26623 FOREIGN KEY (nazev_jidla_id) REFERENCES nazev_jidla (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE nazev_jidla_druh_jidla ADD CONSTRAINT FK_75393A0663D933B2 FOREIGN KEY (druh_jidla_id) REFERENCES druh_jidla (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE druh_jidla DROP druh_jidla');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE nazev_jidla_druh_jidla');
        $this->addSql('ALTER TABLE druh_jidla ADD druh_jidla VARCHAR(255) NOT NULL');
    }
}
