<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->enum('tipe', ['pemasukan', 'pengeluaran'])->default('pengeluaran');
            $table->string('kategori');
            $table->decimal('jumlah', 12, 2);
            $table->text('deskripsi')->nullable();
            $table->date('tanggal');
            $table->timestamps();
            $table->index(['user_id', 'tanggal']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};
