<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL; // <-- Tambahkan ini

class AppServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        // Paksa HTTPS jika bukan di localhost
        if (config('app.env') !== 'local') {
            URL::forceScheme('https');
        }
    }
}