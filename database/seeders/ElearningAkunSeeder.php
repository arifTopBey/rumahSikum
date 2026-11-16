<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ElearningAkunSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'AdminElearning1',
            'email' => 'AdminElearning1@gmail.com',
            'user_role' => 'admin',
            'password' => bcrypt('12345678'),
        ]);
    }
}
