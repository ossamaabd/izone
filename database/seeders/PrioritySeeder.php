<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PrioritySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('priorities')->insert([
            [
                'title' => 'normal',
                'value' => 1,
            ],
            [
                'title' => 'mid',
                'value' => 2,
            ],
            [
                'title' => 'emergency',
                'value' => 3,
            ],
        ]);
    }
}
