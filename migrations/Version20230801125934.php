<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230801125934 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE questionnaire DROP FOREIGN KEY FK_7A64DAFA76ED395');
        $this->addSql('DROP INDEX UNIQ_7A64DAFA76ED395 ON questionnaire');
        $this->addSql('ALTER TABLE questionnaire DROP user_id');
        $this->addSql('ALTER TABLE user ADD questionnaire_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649CE07E8FF FOREIGN KEY (questionnaire_id) REFERENCES questionnaire (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649CE07E8FF ON user (questionnaire_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE questionnaire ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE questionnaire ADD CONSTRAINT FK_7A64DAFA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_7A64DAFA76ED395 ON questionnaire (user_id)');
        $this->addSql('ALTER TABLE `user` DROP FOREIGN KEY FK_8D93D649CE07E8FF');
        $this->addSql('DROP INDEX UNIQ_8D93D649CE07E8FF ON `user`');
        $this->addSql('ALTER TABLE `user` DROP questionnaire_id');
    }
}
