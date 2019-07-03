<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190702210846 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE lecon (id INT AUTO_INCREMENT NOT NULL, entrainement_id INT NOT NULL, entraineur_id INT NOT NULL, tireur_id INT NOT NULL, INDEX IDX_94E6242EA15E8FD (entrainement_id), INDEX IDX_94E6242EF8478A1 (entraineur_id), INDEX IDX_94E6242ECE287986 (tireur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE objectif (id INT AUTO_INCREMENT NOT NULL, tireur_id INT NOT NULL, attribue_par_id INT NOT NULL, objectif VARCHAR(255) NOT NULL, atteint TINYINT(1) NOT NULL, INDEX IDX_E2F86851CE287986 (tireur_id), INDEX IDX_E2F8685193864229 (attribue_par_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE lecon ADD CONSTRAINT FK_94E6242EA15E8FD FOREIGN KEY (entrainement_id) REFERENCES entrainement (id)');
        $this->addSql('ALTER TABLE lecon ADD CONSTRAINT FK_94E6242EF8478A1 FOREIGN KEY (entraineur_id) REFERENCES maitre_arme (id)');
        $this->addSql('ALTER TABLE lecon ADD CONSTRAINT FK_94E6242ECE287986 FOREIGN KEY (tireur_id) REFERENCES tireur (id)');
        $this->addSql('ALTER TABLE objectif ADD CONSTRAINT FK_E2F86851CE287986 FOREIGN KEY (tireur_id) REFERENCES tireur (id)');
        $this->addSql('ALTER TABLE objectif ADD CONSTRAINT FK_E2F8685193864229 FOREIGN KEY (attribue_par_id) REFERENCES membre (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE lecon');
        $this->addSql('DROP TABLE objectif');
    }
}
