<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Sarpras;
use Illuminate\Support\Facades\Schema; // <-- TAMBAHKAN INI

class SarprasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Nonaktifkan foreign key checks untuk sementara
        Schema::disableForeignKeyConstraints();

        // Kosongkan tabel. Ini adalah baris yang kita ubah.
        Sarpras::truncate();

        // Aktifkan kembali foreign key checks
        Schema::enableForeignKeyConstraints();

        // Contoh Data Ruangan (Data Anda tetap sama)
        Sarpras::create([
            'nama_sarpras' => 'Laboratorium Jaringan Komputer',
            'jenis_sarpras' => 'Ruangan',
            'status_sarpras' => 'Tersedia',
            'lokasi' => 'Gedung A, Lantai 2',
            'kapasitas_ruangan' => 30,
            'kode_ruangan' => 'A201',
        ]);

        Sarpras::create([
            'nama_sarpras' => 'Ruang Rapat Utama',
            'jenis_sarpras' => 'Ruangan',
            'status_sarpras' => 'Tersedia',
            'lokasi' => 'Gedung Rektorat, Lantai 3',
            'kapasitas_ruangan' => 50,
            'kode_ruangan' => 'R301',
        ]);

        // Contoh Data Proyektor
        Sarpras::create([
            'nama_sarpras' => 'Proyektor Epson EB-S41',
            'jenis_sarpras' => 'Proyektor',
            'status_sarpras' => 'Tersedia',
            'kode_proyektor' => 'PRO-001',
        ]);

        Sarpras::create([
            'nama_sarpras' => 'Proyektor BenQ MX550',
            'jenis_sarpras' => 'Proyektor',
            'status_sarpras' => 'Tersedia',
            'kode_proyektor' => 'PRO-002',
        ]);
    }
}

