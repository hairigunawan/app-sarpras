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
        Schema::create('peminjamans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_akun')->constrained('users');
            $table->foreignId('id_sarpras')->constrained('sarpras');
            $table->date('tanggal_peminjaman');
            $table->date('tanggal_pengembalian');
            $table->time('jam_mulai');
            $table->time('jam_selesai');
            $table->enum('status_peminjaman', ['Diajukan', 'Disetujui', 'Ditolak', 'Selesai', 'Dibatalkan'])->default('Diajukan');
            $table->text('keterangan_peminjaman')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peminjamans');
    }
};

