<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190703080407 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE tireur_arme (tireur_id INT NOT NULL, arme_id INT NOT NULL, INDEX IDX_354D5D92CE287986 (tireur_id), INDEX IDX_354D5D9221D9C0A (arme_id), PRIMARY KEY(tireur_id, arme_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commentaire_objectif (id INT AUTO_INCREMENT NOT NULL, objectif_id INT DEFAULT NULL, ecrit_par_id INT NOT NULL, commentaire VARCHAR(255) NOT NULL, INDEX IDX_10E9A08D157D1AD4 (objectif_id), INDEX IDX_10E9A08DAAF6E29 (ecrit_par_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE presence (id INT AUTO_INCREMENT NOT NULL, entrainement_id INT NOT NULL, UNIQUE INDEX UNIQ_6977C7A5A15E8FD (entrainement_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE presence_tireur (presence_id INT NOT NULL, tireur_id INT NOT NULL, INDEX IDX_3BABB627F328FFC4 (presence_id), INDEX IDX_3BABB627CE287986 (tireur_id), PRIMARY KEY(presence_id, tireur_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE arme (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commentaire_lecon (id INT AUTO_INCREMENT NOT NULL, lecon_id INT DEFAULT NULL, ecrit_par_id INT NOT NULL, commentaire VARCHAR(255) NOT NULL, INDEX IDX_116AEC32EC1308A5 (lecon_id), INDEX IDX_116AEC32AAF6E29 (ecrit_par_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE tireur_arme ADD CONSTRAINT FK_354D5D92CE287986 FOREIGN KEY (tireur_id) REFERENCES tireur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tireur_arme ADD CONSTRAINT FK_354D5D9221D9C0A FOREIGN KEY (arme_id) REFERENCES arme (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE commentaire_objectif ADD CONSTRAINT FK_10E9A08D157D1AD4 FOREIGN KEY (objectif_id) REFERENCES objectif (id)');
        $this->addSql('ALTER TABLE commentaire_objectif ADD CONSTRAINT FK_10E9A08DAAF6E29 FOREIGN KEY (ecrit_par_id) REFERENCES membre (id)');
        $this->addSql('ALTER TABLE presence ADD CONSTRAINT FK_6977C7A5A15E8FD FOREIGN KEY (entrainement_id) REFERENCES entrainement (id)');
        $this->addSql('ALTER TABLE presence_tireur ADD CONSTRAINT FK_3BABB627F328FFC4 FOREIGN KEY (presence_id) REFERENCES presence (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE presence_tireur ADD CONSTRAINT FK_3BABB627CE287986 FOREIGN KEY (tireur_id) REFERENCES tireur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE commentaire_lecon ADD CONSTRAINT FK_116AEC32EC1308A5 FOREIGN KEY (lecon_id) REFERENCES lecon (id)');
        $this->addSql('ALTER TABLE commentaire_lecon ADD CONSTRAINT FK_116AEC32AAF6E29 FOREIGN KEY (ecrit_par_id) REFERENCES membre (id)');
        $this->addSql('ALTER TABLE tireur ADD presence_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE tireur ADD CONSTRAINT FK_D63A0737F328FFC4 FOREIGN KEY (presence_id) REFERENCES presence (id)');
        $this->addSql('CREATE INDEX IDX_D63A0737F328FFC4 ON tireur (presence_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE tireur DROP FOREIGN KEY FK_D63A0737F328FFC4');
        $this->addSql('ALTER TABLE presence_tireur DROP FOREIGN KEY FK_3BABB627F328FFC4');
        $this->addSql('ALTER TABLE tireur_arme DROP FOREIGN KEY FK_354D5D9221D9C0A');
        $this->addSql('DROP TABLE tireur_arme');
        $this->addSql('DROP TABLE commentaire_objectif');
        $this->addSql('DROP TABLE presence');
        $this->addSql('DROP TABLE presence_tireur');
        $this->addSql('DROP TABLE arme');
        $this->addSql('DROP TABLE commentaire_lecon');
        $this->addSql('DROP INDEX IDX_D63A0737F328FFC4 ON tireur');
        $this->addSql('ALTER TABLE tireur DROP presence_id');
    }
}
