<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateRewardsTable extends AbstractMigration
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
        // Create the 'rewards' table
        $rewardsTable = $this->table('rewards');
        $rewardsTable->addColumn('created_by', 'integer')
                     ->addColumn('title', 'string', ['limit' => 200])
                     ->addColumn('description', 'text', ['null' => true])
                     ->addColumn('startdate', 'datetime', ['default' => null, 'null' => true])
                     ->addColumn('enddate', 'datetime', ['default' => null, 'null' => true])
                     ->addColumn('active', 'boolean', ['default' => false])
                     ->addColumn('cost', 'integer', ['default' => 0])
                     ->addColumn('available', 'integer', ['default' => 0])
                     ->addColumn('remaining', 'integer', ['default' => 0])
                     ->addTimestamps()
                     ->create();

        // Create the 'reward_images' table
        $rewardImagesTable = $this->table('reward_images');
        $rewardImagesTable->addColumn('reward_id', 'integer', ['signed' => false])
                          ->addColumn('image_id', 'integer', ['signed' => false])
                          ->addForeignKey('reward_id', 'rewards', 'id', ['delete' => 'NO_ACTION', 'update' => 'NO_ACTION'])
                          ->addForeignKey('image_id', 'images', 'id', ['delete' => 'CASCADE', 'update' => 'NO_ACTION'])
                          ->create();
    }
}
