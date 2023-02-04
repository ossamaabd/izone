<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('clients')->insert([
            [
                'name' => 'ossama',
                'phone_number' => '0987654321',
                'password' => Hash::make('hahatest'),
            ],
            [
                'name' => 'izone',
                'phone_number' => '0988888888',
                'password' => Hash::make('123123123'),
            ],
        ]);
    }
}
