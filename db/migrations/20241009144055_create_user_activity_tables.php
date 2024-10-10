<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateUserActivityTables extends AbstractMigration
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
        // Create the 'user_points' table
        $userPointsTable = $this->table('user_points');
        $userPointsTable->addColumn('amount', 'integer')
                        ->addColumn('action', 'string', ['limit' => 100])
                        ->addColumn('notes', 'text', ['null' => true])
                        ->addTimestamps()
                        ->addColumn('user_id', 'integer', ['signed' => false]) // Unsigned to match users.id
                        ->addForeignKey('user_id', 'users', 'id', ['delete' => 'CASCADE', 'update' => 'NO_ACTION'])
                        ->create();

        // Create the 'user_activity' table
        $userActivityTable = $this->table('user_activity');
        $userActivityTable->addColumn('activity', 'text')
                          ->addTimestamps()
                          ->addColumn('user_id', 'integer', ['signed' => false]) // Unsigned to match users.id
                          ->addForeignKey('user_id', 'users', 'id', ['delete' => 'CASCADE', 'update' => 'NO_ACTION'])
                          ->create();
    }
}
