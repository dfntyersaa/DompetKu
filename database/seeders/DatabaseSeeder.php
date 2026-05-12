<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Ini akan menghapus user lama dengan email yang sama supaya tidak bentrok
        User::where('email', 'admin@example.com')->delete();

        // Ini membuat user admin baru
        User::create([
            'name' => 'Admin Utama',
            'email' => 'admin@example.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
            'is_admin' => 1,
        ]);
    }
}