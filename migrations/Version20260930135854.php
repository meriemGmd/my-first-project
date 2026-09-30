<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260930135854 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE anime (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, year VARCHAR(100) DEFAULT NULL, synopsis VARCHAR(255) NOT NULL, image_url VARCHAR(255) NOT NULL, statut_anime_id INT DEFAULT NULL, INDEX IDX_1304594264D0228 (statut_anime_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE anime_user (anime_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_2266041D794BBE89 (anime_id), INDEX IDX_2266041DA76ED395 (user_id), PRIMARY KEY (anime_id, user_id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE genre (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE genre_anime (genre_id INT NOT NULL, anime_id INT NOT NULL, INDEX IDX_AE0246874296D31F (genre_id), INDEX IDX_AE024687794BBE89 (anime_id), PRIMARY KEY (genre_id, anime_id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE lecture (id INT AUTO_INCREMENT NOT NULL, user_id_id INT DEFAULT NULL, anime_id_id INT DEFAULT NULL, statut_id_id INT DEFAULT NULL, INDEX IDX_C16779489D86650F (user_id_id), INDEX IDX_C167794813EDFE68 (anime_id_id), INDEX IDX_C16779484DB9F129 (statut_id_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE statut_anime (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE statut_lecture (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('ALTER TABLE anime ADD CONSTRAINT FK_1304594264D0228 FOREIGN KEY (statut_anime_id) REFERENCES statut_anime (id)');
        $this->addSql('ALTER TABLE anime_user ADD CONSTRAINT FK_2266041D794BBE89 FOREIGN KEY (anime_id) REFERENCES anime (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE anime_user ADD CONSTRAINT FK_2266041DA76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE genre_anime ADD CONSTRAINT FK_AE0246874296D31F FOREIGN KEY (genre_id) REFERENCES genre (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE genre_anime ADD CONSTRAINT FK_AE024687794BBE89 FOREIGN KEY (anime_id) REFERENCES anime (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE lecture ADD CONSTRAINT FK_C16779489D86650F FOREIGN KEY (user_id_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE lecture ADD CONSTRAINT FK_C167794813EDFE68 FOREIGN KEY (anime_id_id) REFERENCES anime (id)');
        $this->addSql('ALTER TABLE lecture ADD CONSTRAINT FK_C16779484DB9F129 FOREIGN KEY (statut_id_id) REFERENCES statut_lecture (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE anime DROP FOREIGN KEY FK_1304594264D0228');
        $this->addSql('ALTER TABLE anime_user DROP FOREIGN KEY FK_2266041D794BBE89');
        $this->addSql('ALTER TABLE anime_user DROP FOREIGN KEY FK_2266041DA76ED395');
        $this->addSql('ALTER TABLE genre_anime DROP FOREIGN KEY FK_AE0246874296D31F');
        $this->addSql('ALTER TABLE genre_anime DROP FOREIGN KEY FK_AE024687794BBE89');
        $this->addSql('ALTER TABLE lecture DROP FOREIGN KEY FK_C16779489D86650F');
        $this->addSql('ALTER TABLE lecture DROP FOREIGN KEY FK_C167794813EDFE68');
        $this->addSql('ALTER TABLE lecture DROP FOREIGN KEY FK_C16779484DB9F129');
        $this->addSql('DROP TABLE anime');
        $this->addSql('DROP TABLE anime_user');
        $this->addSql('DROP TABLE genre');
        $this->addSql('DROP TABLE genre_anime');
        $this->addSql('DROP TABLE lecture');
        $this->addSql('DROP TABLE statut_anime');
        $this->addSql('DROP TABLE statut_lecture');
    }
}
