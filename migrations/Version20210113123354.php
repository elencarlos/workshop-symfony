<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210113123354 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE cliente (id INT AUTO_INCREMENT NOT NULL, nome VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE compra (id INT AUTO_INCREMENT NOT NULL, cliente_id INT DEFAULT NULL, INDEX IDX_9EC131FFDE734E51 (cliente_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE compra_carro (compra_id INT NOT NULL, carro_id INT NOT NULL, INDEX IDX_C79A7B9AF2E704D7 (compra_id), INDEX IDX_C79A7B9A293ADB72 (carro_id), PRIMARY KEY(compra_id, carro_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE compra ADD CONSTRAINT FK_9EC131FFDE734E51 FOREIGN KEY (cliente_id) REFERENCES cliente (id)');
        $this->addSql('ALTER TABLE compra_carro ADD CONSTRAINT FK_C79A7B9AF2E704D7 FOREIGN KEY (compra_id) REFERENCES compra (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE compra_carro ADD CONSTRAINT FK_C79A7B9A293ADB72 FOREIGN KEY (carro_id) REFERENCES carro (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE compra DROP FOREIGN KEY FK_9EC131FFDE734E51');
        $this->addSql('ALTER TABLE compra_carro DROP FOREIGN KEY FK_C79A7B9AF2E704D7');
        $this->addSql('DROP TABLE cliente');
        $this->addSql('DROP TABLE compra');
        $this->addSql('DROP TABLE compra_carro');
    }
}
