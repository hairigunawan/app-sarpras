<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Sarpras;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
     * Menampilkan halaman dashboard dengan ringkasan data.
     */
    public function index()
    {
        // Menghitung statistik utama
        $peminjamanDiajukan = Peminjaman::where('status_peminjaman', 'Diajukan')->count();
        $peminjamanDisetujui = Peminjaman::where('status_peminjaman', 'Disetujui')->count();
        $sarprasTersedia = Sarpras::where('status_sarpras', 'Tersedia')->count();

        // Mengambil 5 peminjaman terbaru untuk ditampilkan di tabel
        $peminjamanTerbaru = Peminjaman::with(['user', 'sarpras'])
                                ->latest()
                                ->take(5)
                                ->get();

        return view('dashboard', compact(
            'peminjamanDiajukan',
            'peminjamanDisetujui',
            'sarprasTersedia',
            'peminjamanTerbaru'
        ));
    }

    /**
     * Menyediakan data untuk grafik peminjaman.
     */
    public function chartData()
    {
        // Mengambil data peminjaman 7 hari terakhir
        $peminjamanData = Peminjaman::select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as count'))
            ->where('created_at', '>=', Carbon::now()->subDays(7))
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get();

        $labels = $peminjamanData->pluck('date')->map(function ($date) {
            return Carbon::parse($date)->format('d M');
        });

        $data = $peminjamanData->pluck('count');

        return response()->json(['labels' => $labels, 'data' => $data]);
    }
}

