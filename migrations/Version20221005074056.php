<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221005074056 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE historie ADD fruestueck_id INT DEFAULT NULL, ADD snack_id INT DEFAULT NULL, ADD mittagessen_id INT DEFAULT NULL, ADD abendsbrot_id INT DEFAULT NULL, DROP fruestueck, DROP mittagessen, DROP snack, DROP abendsbrot, CHANGE datum datum DATE NOT NULL');
        $this->addSql('ALTER TABLE historie ADD CONSTRAINT FK_44314A637D400D4D FOREIGN KEY (fruestueck_id) REFERENCES nazev_jidla (id)');
        $this->addSql('ALTER TABLE historie ADD CONSTRAINT FK_44314A63F469C3E0 FOREIGN KEY (snack_id) REFERENCES nazev_jidla (id)');
        $this->addSql('ALTER TABLE historie ADD CONSTRAINT FK_44314A63D77C31F3 FOREIGN KEY (mittagessen_id) REFERENCES nazev_jidla (id)');
        $this->addSql('ALTER TABLE historie ADD CONSTRAINT FK_44314A63E979C5DF FOREIGN KEY (abendsbrot_id) REFERENCES nazev_jidla (id)');
        $this->addSql('CREATE INDEX IDX_44314A637D400D4D ON historie (fruestueck_id)');
        $this->addSql('CREATE INDEX IDX_44314A63F469C3E0 ON historie (snack_id)');
        $this->addSql('CREATE INDEX IDX_44314A63D77C31F3 ON historie (mittagessen_id)');
        $this->addSql('CREATE INDEX IDX_44314A63E979C5DF ON historie (abendsbrot_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE historie DROP FOREIGN KEY FK_44314A637D400D4D');
        $this->addSql('ALTER TABLE historie DROP FOREIGN KEY FK_44314A63F469C3E0');
        $this->addSql('ALTER TABLE historie DROP FOREIGN KEY FK_44314A63D77C31F3');
        $this->addSql('ALTER TABLE historie DROP FOREIGN KEY FK_44314A63E979C5DF');
        $this->addSql('DROP INDEX IDX_44314A637D400D4D ON historie');
        $this->addSql('DROP INDEX IDX_44314A63F469C3E0 ON historie');
        $this->addSql('DROP INDEX IDX_44314A63D77C31F3 ON historie');
        $this->addSql('DROP INDEX IDX_44314A63E979C5DF ON historie');
        $this->addSql('ALTER TABLE historie ADD fruestueck VARCHAR(255) DEFAULT NULL, ADD mittagessen VARCHAR(255) DEFAULT NULL, ADD snack VARCHAR(255) DEFAULT NULL, ADD abendsbrot VARCHAR(255) DEFAULT NULL, DROP fruestueck_id, DROP snack_id, DROP mittagessen_id, DROP abendsbrot_id, CHANGE datum datum VARCHAR(255) NOT NULL');
    }
}
