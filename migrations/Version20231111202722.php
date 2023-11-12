<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231111202722 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE burger (id INT AUTO_INCREMENT NOT NULL, bread_id INT NOT NULL, image_id INT NOT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_EFE35A0D5D3405CF (bread_id), UNIQUE INDEX UNIQ_EFE35A0D3DA5256D (image_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE burger_onion (burger_id INT NOT NULL, onion_id INT NOT NULL, INDEX IDX_2BA10D4A17CE5090 (burger_id), INDEX IDX_2BA10D4AC10078DA (onion_id), PRIMARY KEY(burger_id, onion_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE burger_sauce (burger_id INT NOT NULL, sauce_id INT NOT NULL, INDEX IDX_F889AB0F17CE5090 (burger_id), INDEX IDX_F889AB0F7AB984B7 (sauce_id), PRIMARY KEY(burger_id, sauce_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE image (id INT AUTO_INCREMENT NOT NULL, source VARCHAR(1000) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE onion (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE review (id INT AUTO_INCREMENT NOT NULL, burger_id INT NOT NULL, text VARCHAR(1000) NOT NULL, INDEX IDX_794381C617CE5090 (burger_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sauce (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE burger ADD CONSTRAINT FK_EFE35A0D5D3405CF FOREIGN KEY (bread_id) REFERENCES bread (id)');
        $this->addSql('ALTER TABLE burger ADD CONSTRAINT FK_EFE35A0D3DA5256D FOREIGN KEY (image_id) REFERENCES image (id)');
        $this->addSql('ALTER TABLE burger_onion ADD CONSTRAINT FK_2BA10D4A17CE5090 FOREIGN KEY (burger_id) REFERENCES burger (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE burger_onion ADD CONSTRAINT FK_2BA10D4AC10078DA FOREIGN KEY (onion_id) REFERENCES onion (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE burger_sauce ADD CONSTRAINT FK_F889AB0F17CE5090 FOREIGN KEY (burger_id) REFERENCES burger (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE burger_sauce ADD CONSTRAINT FK_F889AB0F7AB984B7 FOREIGN KEY (sauce_id) REFERENCES sauce (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE review ADD CONSTRAINT FK_794381C617CE5090 FOREIGN KEY (burger_id) REFERENCES burger (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE burger DROP FOREIGN KEY FK_EFE35A0D5D3405CF');
        $this->addSql('ALTER TABLE burger DROP FOREIGN KEY FK_EFE35A0D3DA5256D');
        $this->addSql('ALTER TABLE burger_onion DROP FOREIGN KEY FK_2BA10D4A17CE5090');
        $this->addSql('ALTER TABLE burger_onion DROP FOREIGN KEY FK_2BA10D4AC10078DA');
        $this->addSql('ALTER TABLE burger_sauce DROP FOREIGN KEY FK_F889AB0F17CE5090');
        $this->addSql('ALTER TABLE burger_sauce DROP FOREIGN KEY FK_F889AB0F7AB984B7');
        $this->addSql('ALTER TABLE review DROP FOREIGN KEY FK_794381C617CE5090');
        $this->addSql('DROP TABLE burger');
        $this->addSql('DROP TABLE burger_onion');
        $this->addSql('DROP TABLE burger_sauce');
        $this->addSql('DROP TABLE image');
        $this->addSql('DROP TABLE onion');
        $this->addSql('DROP TABLE review');
        $this->addSql('DROP TABLE sauce');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
