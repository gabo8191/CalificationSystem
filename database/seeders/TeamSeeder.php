<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $teams = [
            [
                'name' => 'Backend',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Frontend',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'DevOps',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Techical Department',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Management',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('teams')->insert($teams);
    }
}
