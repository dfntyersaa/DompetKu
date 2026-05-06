<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\Budget;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        // Jika admin, redirect ke admin dashboard
        if ($user->isAdmin()) {
            return redirect()->route('admin.dashboard');
        }
        
        // Hitung total saldo
        $pemasukan = $user->transaksis()
            ->where('tipe', 'pemasukan')
            ->sum('jumlah');
        $pengeluaran = $user->transaksis()
            ->where('tipe', 'pengeluaran')
            ->sum('jumlah');
        $totalSaldo = $pemasukan - $pengeluaran;

        // Hitung pemasukan dan pengeluaran bulan ini
        $bulanIni = now()->month;
        $tahunIni = now()->year;
        
        $pemasukan_bulan = $user->transaksis()
            ->where('tipe', 'pemasukan')
            ->whereMonth('tanggal', $bulanIni)
            ->whereYear('tanggal', $tahunIni)
            ->sum('jumlah');
        
        $pengeluaran_bulan = $user->transaksis()
            ->where('tipe', 'pengeluaran')
            ->whereMonth('tanggal', $bulanIni)
            ->whereYear('tanggal', $tahunIni)
            ->sum('jumlah');

        // Ambil transaksi terbaru (5 item)
        $transaksi_terbaru = $user->transaksis()
            ->orderBy('tanggal', 'desc')
            ->limit(5)
            ->get();

        // Ambil budget bulan ini
        $budget = $user->budgets()
            ->where('bulan', $bulanIni)
            ->where('tahun', $tahunIni)
            ->first();

        return view('dashboard', compact(
            'user',
            'totalSaldo',
            'pemasukan',
            'pengeluaran',
            'pemasukan_bulan',
            'pengeluaran_bulan',
            'transaksi_terbaru',
            'budget'
        ));
    }
}
