<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TechnicianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('technicians')->insert([
            [
                'name' => 'ossama',
                'hour_cost' => 3.2,
            ],
            [
                'name' => 'izone',
                'hour_cost' => 2.2,
            ]
            ]);

    }
}
