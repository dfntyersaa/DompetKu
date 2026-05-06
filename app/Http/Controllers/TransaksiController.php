<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransaksiController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $transaksi = $user->transaksis()
            ->orderBy('tanggal', 'desc')
            ->paginate(10);

        return view('transaksi.index', compact('transaksi'));
    }

    public function create()
    {
        $kategoriPemasukan = ['Gaji', 'Bonus', 'Investasi', 'Lainnya'];
        $kategoriPengeluaran = ['Makanan', 'Transportasi', 'Hiburan', 'Tagihan', 'Lainnya'];

        return view('transaksi.create', compact('kategoriPemasukan', 'kategoriPengeluaran'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tipe' => 'required|in:pemasukan,pengeluaran',
            'kategori' => 'required|string',
            'jumlah' => 'required|numeric|min:0.01',
            'deskripsi' => 'nullable|string',
            'tanggal' => 'required|date'
        ]);

        Auth::user()->transaksis()->create([
            'tipe' => $validated['tipe'],
            'kategori' => $validated['kategori'],
            'jumlah' => $validated['jumlah'],
            'deskripsi' => $validated['deskripsi'],
            'tanggal' => $validated['tanggal']
        ]);

        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil ditambahkan!');
    }

    public function edit(Transaksi $transaksi)
    {
        $this->authorize('update', $transaksi);
        
        $kategoriPemasukan = ['Gaji', 'Bonus', 'Investasi', 'Lainnya'];
        $kategoriPengeluaran = ['Makanan', 'Transportasi', 'Hiburan', 'Tagihan', 'Lainnya'];

        return view('transaksi.edit', compact('transaksi', 'kategoriPemasukan', 'kategoriPengeluaran'));
    }

    public function update(Request $request, Transaksi $transaksi)
    {
        $this->authorize('update', $transaksi);

        $validated = $request->validate([
            'tipe' => 'required|in:pemasukan,pengeluaran',
            'kategori' => 'required|string',
            'jumlah' => 'required|numeric|min:0.01',
            'deskripsi' => 'nullable|string',
            'tanggal' => 'required|date'
        ]);

        $transaksi->update($validated);

        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil diperbarui!');
    }

    public function destroy(Transaksi $transaksi)
    {
        $this->authorize('delete', $transaksi);
        
        $transaksi->delete();

        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil dihapus!');
    }
}
