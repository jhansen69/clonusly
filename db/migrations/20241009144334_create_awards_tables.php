<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateAwardsTables extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change(): void
    {
        // Create the 'keywords' table
        $keywordsTable = $this->table('keywords');
        $keywordsTable->addColumn('keyword', 'string', ['limit' => 100])
                      ->create();

        // Create the 'awards' table
        $awardsTable = $this->table('awards');
        $awardsTable->addColumn('gifter', 'integer',['signed' => false])
                    ->addColumn('recipient', 'integer',['signed' => false])
                    ->addColumn('amount', 'integer', ['default' => 0])
                    ->addColumn('message', 'text', ['null' => true])
                    ->addTimestamps()
                    ->addForeignKey('gifter', 'users', 'id', ['delete' => 'NO_ACTION', 'update' => 'NO_ACTION'])
                    ->addForeignKey('recipient', 'users', 'id', ['delete' => 'NO_ACTION', 'update' => 'NO_ACTION'])
                    ->create();

        // Create the 'award_keywords' table for one-to-many relationship between awards and keywords
        $awardKeywordsTable = $this->table('award_keywords');
        $awardKeywordsTable->addColumn('award_id', 'integer', ['signed' => false])
                           ->addColumn('keyword_id', 'integer', ['signed' => false])
                           ->addForeignKey('award_id', 'awards', 'id', ['delete' => 'CASCADE', 'update' => 'NO_ACTION'])
                           ->addForeignKey('keyword_id', 'keywords', 'id', ['delete' => 'CASCADE', 'update' => 'NO_ACTION'])
                           ->create();
    }
}
