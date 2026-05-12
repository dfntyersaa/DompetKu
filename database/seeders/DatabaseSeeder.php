<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin DompetKu',
            'email' => 'admin@example.com', // Saya perbaiki typo "examle" jadi "example"
            'password' => Hash::make('admin123'),
        ]);
    }
}