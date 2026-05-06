<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Transaksi;
use App\Models\Budget;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DemoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create admin user
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
            'last_activity' => now(),
        ]);

        // Create demo users
        $users_data = [
            ['name' => 'Demo User', 'email' => 'demo@example.com', 'password' => 'demo123'],
            ['name' => 'John Doe', 'email' => 'john@example.com', 'password' => 'john123'],
            ['name' => 'Jane Smith', 'email' => 'jane@example.com', 'password' => 'jane123'],
            ['name' => 'Budi Rahman', 'email' => 'budi@example.com', 'password' => 'budi123'],
            ['name' => 'Siti Nurhaliza', 'email' => 'siti@example.com', 'password' => 'siti123'],
        ];

        foreach ($users_data as $user_data) {
            $user = User::create([
                'name' => $user_data['name'],
                'email' => $user_data['email'],
                'password' => Hash::make($user_data['password']),
                'role' => 'user',
                'last_activity' => now()->subMinutes(rand(5, 60)),
            ]);

            // Create budget for this month
            Budget::create([
                'user_id' => $user->id,
                'jumlah' => rand(3000000, 10000000),
                'bulan' => now()->month,
                'tahun' => now()->year,
            ]);

            // Create demo transactions
            $transaksi_data = [
                // Pemasukan
                ['tipe' => 'pemasukan', 'kategori' => 'Gaji', 'jumlah' => 5000000, 'tanggal' => now()->subDays(15)],
                ['tipe' => 'pemasukan', 'kategori' => 'Bonus', 'jumlah' => 1000000, 'tanggal' => now()->subDays(10)],
                
                // Pengeluaran
                ['tipe' => 'pengeluaran', 'kategori' => 'Makanan', 'jumlah' => 150000, 'tanggal' => now()->subDays(8)],
                ['tipe' => 'pengeluaran', 'kategori' => 'Transportasi', 'jumlah' => 200000, 'tanggal' => now()->subDays(7)],
                ['tipe' => 'pengeluaran', 'kategori' => 'Hiburan', 'jumlah' => 300000, 'tanggal' => now()->subDays(6)],
                ['tipe' => 'pengeluaran', 'kategori' => 'Tagihan', 'jumlah' => 1500000, 'tanggal' => now()->subDays(5)],
                ['tipe' => 'pengeluaran', 'kategori' => 'Makanan', 'jumlah' => 120000, 'tanggal' => now()->subDays(3)],
                ['tipe' => 'pengeluaran', 'kategori' => 'Transportasi', 'jumlah' => 100000, 'tanggal' => now()->subDays(2)],
                ['tipe' => 'pengeluaran', 'kategori' => 'Hiburan', 'jumlah' => 250000, 'tanggal' => now()->subDays(1)],
                ['tipe' => 'pengeluaran', 'kategori' => 'Makanan', 'jumlah' => 180000, 'tanggal' => now()],
            ];

            foreach ($transaksi_data as $data) {
                Transaksi::create([
                    'user_id' => $user->id,
                    'tipe' => $data['tipe'],
                    'kategori' => $data['kategori'],
                    'jumlah' => $data['jumlah'],
                    'deskripsi' => 'Demo transaksi',
                    'tanggal' => $data['tanggal'],
                ]);
            }
        }
    }
}

