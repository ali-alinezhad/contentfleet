<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200726162933 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql("INSERT INTO book (name,release_date,length,genres,user_readable,admin_readable) VALUES 
                ('Doctor WithBig Eyes','2016-02-01',200,'Police','Yes','Yes'),
                ('Hunger Of My Town','2016-05-02',10,'Comedy','Yes','Yes'),
                ('Colleagues And Demons','2015-04-06',30,'Drama','Yes','Yes'),
                ('Humans In The Library','1982-06-15',600,'Non-fiction,Horror','No','Yes'),
                ('Founders Of Evil','1530-08-30',900,'Drama','Yes','Yes'),
                ('Ancestor With Horns','2019-10-10',1000,'Drama','Yes','Yes'),
                ('Age Of The Light','1923-12-06',234,'Tragedy','Yes','Yes'),
                ('Learning With TheRiver','1965-02-02',200,'Children,Fiction','Yes','Yes'),
                ('Lord And Buffoon','2001-07-09',240,'Horror,Satire','Yes','Yes')
            ");
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('Delete from book');
    }
}
