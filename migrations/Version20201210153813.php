<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201210153813 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE program CHANGE poster poster VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE season DROP INDEX UNIQ_F0E45BA93EB8070A, ADD INDEX IDX_F0E45BA93EB8070A (program_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE program CHANGE poster poster VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE season DROP INDEX IDX_F0E45BA93EB8070A, ADD UNIQUE INDEX UNIQ_F0E45BA93EB8070A (program_id)');
    }
}
