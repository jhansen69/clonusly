<?php

declare(strict_types=1);

use Phinx\Seed\AbstractSeed;

class UserSeeder extends AbstractSeed
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
        $faker = \Faker\Factory::create();

        // Generate 5 random users
        $data = [];
        for ($i = 0; $i < 5; $i++) {
            $data[] = [
                'first_name' => $faker->firstName,
                'last_name'  => $faker->lastName,
                'email'      => $faker->unique()->safeEmail,
                'password'   => password_hash('password123', PASSWORD_BCRYPT), // Hashed password
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ];
        }
        $data[] = [
            'first_name' => "Joe",
            'last_name'  => "Hansen",
            'email'      => "jhansen69+clonusly@gmail.com",
            'password'   => password_hash('password123', PASSWORD_BCRYPT), // Hashed password
            'is_admin'   => 1,
            'created_at'    => date('Y-m-d H:i:s'),
            'updated_at'    => date('Y-m-d H:i:s'),
        ];
        // Insert the generated data into the users table
        $this->table('users')->insert($data)->saveData();
    }
}
