<?php

declare(strict_types=1);

use Phinx\Seed\AbstractSeed;

class KeywordSeeder extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * https://book.cakephp.org/phinx/0/en/seeding.html
     */
    public function run(): void
    {
        $faker = Faker\Factory::create();

        $data = [];
        for ($i = 0; $i < 50; $i++) {
            $data[] = [
                'keyword' => $faker->word,
            ];
        }

        $this->table('keywords')->insert($data)->saveData();
    }
}
