<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateImagesTable extends AbstractMigration
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
        // Create the 'images' table
        $imagesTable = $this->table('images');
        $imagesTable->addColumn('path', 'string', ['limit' => 255])
                    ->addColumn('filename', 'string', ['limit' => 255])
                    ->addTimestamps()
                    ->addColumn('caption', 'text', ['null' => true])
                    ->addColumn('uploaded_by', 'integer', ['signed' => false])
                    ->create();
    }
}
