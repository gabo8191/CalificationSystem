<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'AdminGabriel',
            'email' => 'admin@example.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
            // password
            'remember_token' => Str::random(10),
            'role_id' => 1,
            'team_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ])->assignRole('admin');

        User::create([
            'name' => 'UserGabriel',
            'email' => 'user@example.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
            // password
            'remember_token' => Str::random(10),
            'role_id' => 2,
            'team_id' => 2,
            'created_at' => now(),
            'updated_at' => now(),
        ])->assignRole('user');

        User::create([
            'name' => 'LeaderGabriel',
            'email' => 'leader@example.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
            // password
            'remember_token' => Str::random(10),
            'role_id' => 3,
            'team_id' => 3,
            'created_at' => now(),
            'updated_at' => now(),

        ])->assignRole('leader');

    }
}
