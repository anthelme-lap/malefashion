<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220418082838 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE branding_product DROP FOREIGN KEY FK_2C862DE0560BC00E');
        $this->addSql('ALTER TABLE shoesize_product DROP FOREIGN KEY FK_13C587F21475669');
        $this->addSql('DROP TABLE branding');
        $this->addSql('DROP TABLE branding_product');
        $this->addSql('DROP TABLE shoesize');
        $this->addSql('DROP TABLE shoesize_product');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE branding (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, description LONGTEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE branding_product (branding_id INT NOT NULL, product_id INT NOT NULL, INDEX IDX_2C862DE04584665A (product_id), INDEX IDX_2C862DE0560BC00E (branding_id), PRIMARY KEY(branding_id, product_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE shoesize (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, description LONGTEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE shoesize_product (shoesize_id INT NOT NULL, product_id INT NOT NULL, INDEX IDX_13C587F24584665A (product_id), INDEX IDX_13C587F21475669 (shoesize_id), PRIMARY KEY(shoesize_id, product_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE branding_product ADD CONSTRAINT FK_2C862DE04584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE branding_product ADD CONSTRAINT FK_2C862DE0560BC00E FOREIGN KEY (branding_id) REFERENCES branding (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE shoesize_product ADD CONSTRAINT FK_13C587F21475669 FOREIGN KEY (shoesize_id) REFERENCES shoesize (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE shoesize_product ADD CONSTRAINT FK_13C587F24584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE');
    }
}
