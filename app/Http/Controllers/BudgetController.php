<?php

namespace App\Http\Controllers;

use App\Models\Budget;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BudgetController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $bulanIni = now()->month;
        $tahunIni = now()->year;

        $budget = $user->budgets()
            ->where('bulan', $bulanIni)
            ->where('tahun', $tahunIni)
            ->first();

        $totalPengeluaran = $user->transaksis()
            ->where('tipe', 'pengeluaran')
            ->whereMonth('tanggal', $bulanIni)
            ->whereYear('tanggal', $tahunIni)
            ->sum('jumlah');

        $sisaBudget = $budget ? $budget->jumlah - $totalPengeluaran : 0;
        $persentase = $budget ? ($totalPengeluaran / $budget->jumlah) * 100 : 0;

        return view('budget.index', compact('budget', 'totalPengeluaran', 'sisaBudget', 'persentase', 'bulanIni', 'tahunIni'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'jumlah' => 'required|numeric|min:0.01'
        ]);

        $bulanIni = now()->month;
        $tahunIni = now()->year;

        Budget::updateOrCreate(
            [
                'user_id' => Auth::id(),
                'bulan' => $bulanIni,
                'tahun' => $tahunIni
            ],
            [
                'jumlah' => $validated['jumlah']
            ]
        );

        return redirect()->route('budget.index')->with('success', 'Budget berhasil disimpan!');
    }

    public function update(Request $request, Budget $budget)
    {
        $this->authorize('update', $budget);

        $validated = $request->validate([
            'jumlah' => 'required|numeric|min:0.01'
        ]);

        $budget->update($validated);

        return redirect()->route('budget.index')->with('success', 'Budget berhasil diperbarui!');
    }

    public function destroy(Budget $budget)
    {
        $this->authorize('delete', $budget);
        
        $budget->delete();

        return redirect()->route('budget.index')->with('success', 'Budget berhasil dihapus!');
    }
}
