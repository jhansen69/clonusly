<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateTasksTable extends AbstractMigration
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
        // Create the 'tasks' table
        $tasksTable = $this->table('tasks');
        $tasksTable->addColumn('title', 'string', ['limit' => 100])
                   ->addColumn('description', 'text', ['null' => true])
                   ->addColumn('code', 'string', ['limit' => 100, 'null' => true])
                   ->addColumn('image_required', 'boolean', ['default' => false])
                   ->addColumn('startdate', 'datetime', ['default' => null, 'null' => true])
                   ->addColumn('enddate', 'datetime', ['default' => null, 'null' => true])
                   ->addColumn('number_available', 'integer', ['default' => 0])
                   ->addColumn('active', 'boolean', ['default' => false])
                   ->addTimestamps()
                    ->create();
    }
}
