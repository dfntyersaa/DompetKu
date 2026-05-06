<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $fillable = [
        'user_id',
        'tipe',
        'kategori',
        'jumlah',
        'deskripsi',
        'tanggal'
    ];

    protected $casts = [
        'tanggal' => 'date',
        'jumlah' => 'decimal:2'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getKategoriColorAttribute()
    {
        $colors = [
            'gaji' => 'blue',
            'bonus' => 'green',
            'investasi' => 'purple',
            'makanan' => 'yellow',
            'transportasi' => 'orange',
            'hiburan' => 'red',
            'tagihan' => 'indigo',
            'lainnya' => 'gray'
        ];

        return $colors[strtolower($this->kategori)] ?? 'gray';
    }
}
