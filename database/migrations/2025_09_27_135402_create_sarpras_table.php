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
        Schema::create('sarpras', function (Blueprint $table) {
            $table->id();
            $table->string('nama_sarpras');
            $table->string('jenis_sarpras'); // Contoh: 'Ruangan', 'Proyektor'
            $table->string('gambar_sarpras')->nullable();
            $table->enum('status_sarpras', ['Tersedia', 'Dipinjam', 'Perawatan'])->default('Tersedia');
            $table->string('lokasi')->nullable(); // Hanya untuk ruangan

            // Kolom spesifik untuk Ruangan
            $table->integer('kapasitas_ruangan')->nullable();
            $table->string('kode_ruangan')->unique()->nullable();

            // Kolom spesifik untuk Proyektor
            $table->string('kode_proyektor')->unique()->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sarpras');
    }
};

