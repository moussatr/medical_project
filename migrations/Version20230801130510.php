<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230801130510 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649CE07E8FF');
        $this->addSql('DROP INDEX UNIQ_8D93D649CE07E8FF ON user');
        $this->addSql('ALTER TABLE user CHANGE questionnaire_id question_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6491E27F6BF FOREIGN KEY (question_id) REFERENCES questionnaire (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D6491E27F6BF ON user (question_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `user` DROP FOREIGN KEY FK_8D93D6491E27F6BF');
        $this->addSql('DROP INDEX UNIQ_8D93D6491E27F6BF ON `user`');
        $this->addSql('ALTER TABLE `user` CHANGE question_id questionnaire_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE `user` ADD CONSTRAINT FK_8D93D649CE07E8FF FOREIGN KEY (questionnaire_id) REFERENCES questionnaire (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649CE07E8FF ON `user` (questionnaire_id)');
    }
}
