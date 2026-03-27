<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SeekumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Diskum Kabupaten Tangerang',
            'email' => 'diskum@gmail.com',
            'password' => bcrypt('12345678'),
        ]);
    }
}
