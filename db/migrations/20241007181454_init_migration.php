<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class InitMigration extends AbstractMigration
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
        $table = $this->table('users', ['id' => false, 'primary_key' => ['id']]);
        $table->addColumn('id', 'integer', ['identity' => true, 'signed' => false]) // Unsigned auto-increment ID
            ->addColumn('first_name', 'string', ['limit' => 100])
            ->addColumn('last_name', 'string', ['limit' => 100])
            ->addColumn('email', 'string', ['limit' => 100])
            ->addColumn('password', 'string', ['limit' => 100])
            ->addColumn('remember_token', 'string', ['limit' => 100])
            ->addColumn('is_admin','boolean',['default'=>0])
            ->addColumn('points_current','integer',['default'=>0])
            ->addIndex(['email'], ['unique' => true])
            ->addTimestamps()
            ->create();
    }

}
