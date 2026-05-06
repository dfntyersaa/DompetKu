<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'last_activity',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'last_activity' => 'datetime',
        ];
    }

    public function transaksis()
    {
        return $this->hasMany(Transaksi::class);
    }

    public function budgets()
    {
        return $this->hasMany(Budget::class);
    }

    public function logins()
    {
        return $this->hasMany(UserLogin::class);
    }

    /**
     * Check if user is admin
     */
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    /**
     * Check if user is currently online (last activity within 30 minutes)
     */
    public function isOnline()
    {
        return $this->last_activity && $this->last_activity->diffInMinutes(now()) <= 30;
    }

    public function getTotalSaldoAttribute()
    {
        $pemasukan = $this->transaksis()
            ->where('tipe', 'pemasukan')
            ->sum('jumlah');
        $pengeluaran = $this->transaksis()
            ->where('tipe', 'pengeluaran')
            ->sum('jumlah');
        
        return $pemasukan - $pengeluaran;
    }
}
