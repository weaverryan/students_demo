<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20160605192746 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE student_enrollment ADD course_id INT DEFAULT NULL, ADD student_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE student_enrollment ADD CONSTRAINT FK_36033A00591CC992 FOREIGN KEY (course_id) REFERENCES course (id)');
        $this->addSql('ALTER TABLE student_enrollment ADD CONSTRAINT FK_36033A00CB944F1A FOREIGN KEY (student_id) REFERENCES student (id)');
        $this->addSql('CREATE INDEX IDX_36033A00591CC992 ON student_enrollment (course_id)');
        $this->addSql('CREATE INDEX IDX_36033A00CB944F1A ON student_enrollment (student_id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE student_enrollment DROP FOREIGN KEY FK_36033A00591CC992');
        $this->addSql('ALTER TABLE student_enrollment DROP FOREIGN KEY FK_36033A00CB944F1A');
        $this->addSql('DROP INDEX IDX_36033A00591CC992 ON student_enrollment');
        $this->addSql('DROP INDEX IDX_36033A00CB944F1A ON student_enrollment');
        $this->addSql('ALTER TABLE student_enrollment DROP course_id, DROP student_id');
    }
}
