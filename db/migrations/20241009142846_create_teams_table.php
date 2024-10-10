<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateTeamsTable extends AbstractMigration
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
        // Create the 'teams' table
        $table = $this->table('teams');
        $table->addColumn('name', 'string', ['limit' => 100])
              ->addColumn('description', 'text', ['null' => true])
              ->addTimestamps()
              ->create();

        // Create the 'teams_users' table for many-to-many relationship between users and teams
        $teamsUsersTable = $this->table('teams_users');
        $teamsUsersTable->addColumn('user_id', 'integer', ['signed' => false]) // Unsigned to match users.id
                       ->addColumn('team_id', 'integer', ['signed' => false])
                       ->addForeignKey('user_id', 'users', 'id', ['delete' => 'CASCADE', 'update' => 'NO_ACTION'])
                       ->addForeignKey('team_id', 'teams', 'id', ['delete' => 'CASCADE', 'update' => 'NO_ACTION'])
                       ->create();
    }
}
