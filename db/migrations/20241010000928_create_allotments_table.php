<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateAllotmentsTable extends AbstractMigration
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
    public function change()
    {
        // Create the 'allotments' table
        $allotmentsTable = $this->table('allotments');
        $allotmentsTable->addColumn('team_id', 'integer', ['default' => 0,'signed' => false])
                        ->addForeignKey('team_id', 'teams', 'id', ['delete' => 'CASCADE', 'update' => 'NO_ACTION'])
                        ->addColumn('amount', 'integer', ['default' => 0])
                        ->addColumn('frequency', 'string', ['limit' => 50])
                        ->addColumn('title', 'string', ['limit' => 200])
                        ->addColumn('message', 'text', ['null' => true])
                        ->addColumn('active', 'boolean', ['default' => false])
                        ->addColumn('send_message', 'boolean', ['default' => false])
                        ->addColumn('created_by', 'integer',['signed' => false])
                        ->addForeignKey('created_by', 'users', 'id', ['delete' => 'NO_ACTION', 'update' => 'NO_ACTION'])
                        ->addTimestamps()
                        ->create();
    }
}
