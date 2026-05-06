<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Budget extends Model
{
    protected $fillable = [
        'user_id',
        'jumlah',
        'bulan',
        'tahun'
    ];

    protected $casts = [
        'jumlah' => 'decimal:2'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getTotalPengeluaranAttribute()
    {
        return Transaksi::where('user_id', $this->user_id)
            ->where('tipe', 'pengeluaran')
            ->whereMonth('tanggal', $this->bulan)
            ->whereYear('tanggal', $this->tahun)
            ->sum('jumlah');
    }

    public function getSisaBudgetAttribute()
    {
        return max(0, $this->jumlah - $this->getTotalPengeluaranAttribute());
    }

    public function getPersentaseAttribute()
    {
        if ($this->jumlah == 0) return 0;
        return ($this->getTotalPengeluaranAttribute() / $this->jumlah) * 100;
    }
}
