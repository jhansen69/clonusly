<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateMessagesTable extends AbstractMigration
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
        // Create the 'messages' table
        $messagesTable = $this->table('messages');
        $messagesTable->addColumn('email_sent', 'datetime', ['default' => null, 'null' => true])
                      ->addColumn('message_title', 'string', ['limit' => 100])
                      ->addColumn('message_body', 'text')
                      ->addColumn('notification_closed', 'boolean', ['default' => false])
                      ->addColumn('sent_by', 'integer')
                      ->addTimestamps()
                      ->addColumn('user_id', 'integer', ['signed' => false])
                      ->addForeignKey('user_id', 'users', 'id', ['delete' => 'CASCADE', 'update' => 'NO_ACTION'])
                      ->create();
    }
}
