<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220403124216 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE attachement (id INT AUTO_INCREMENT NOT NULL, fkproduct_id INT NOT NULL, image VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_901C1961694110D7 (fkproduct_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE attachement ADD CONSTRAINT FK_901C1961694110D7 FOREIGN KEY (fkproduct_id) REFERENCES product (id)');
        $this->addSql('DROP TABLE image');
        $this->addSql('DROP TABLE product_category');
        $this->addSql('ALTER TABLE category CHANGE image imagecategory VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE product ADD firstimage VARCHAR(255) NOT NULL, CHANGE price price INT NOT NULL, CHANGE description description VARCHAR(255) DEFAULT NULL, CHANGE shoesize shoesize INT DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE image (id INT AUTO_INCREMENT NOT NULL, fkproduct_id INT NOT NULL, imagename VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_C53D045F694110D7 (fkproduct_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE product_category (product_id INT NOT NULL, category_id INT NOT NULL, INDEX IDX_CDFC735612469DE2 (category_id), INDEX IDX_CDFC73564584665A (product_id), PRIMARY KEY(product_id, category_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045F694110D7 FOREIGN KEY (fkproduct_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE product_category ADD CONSTRAINT FK_CDFC73564584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE product_category ADD CONSTRAINT FK_CDFC735612469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE attachement');
        $this->addSql('ALTER TABLE category CHANGE imagecategory image VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE product DROP firstimage, CHANGE shoesize shoesize VARCHAR(255) DEFAULT NULL, CHANGE price price DOUBLE PRECISION NOT NULL, CHANGE description description LONGTEXT DEFAULT NULL');
    }
}
