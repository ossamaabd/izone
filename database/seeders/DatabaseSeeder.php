<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            AdminSeeder::class,
            ClientSeeder::class,
            StatusSeeder::class,
            PrioritySeeder::class,
            TechnicianSeeder::class,
            ServiceSeeder::class,
        ]);
    }
}
