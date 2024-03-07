<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Your User Name',
            'email' => 'user@example.com',
            'password' => bcrypt('password'),
            'cash' => 50000,
        ]);
    }
}
