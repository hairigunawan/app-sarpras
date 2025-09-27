<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf; // Import class PDF

class LaporanController extends Controller
{
    /**
     * Menampilkan halaman riwayat peminjaman dengan filter.
     */
    public function index(Request $request)
    {
        // Validasi input tanggal
        $request->validate([
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);

        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        // Query dasar
        $query = Peminjaman::with(['user', 'sarpras'])->latest();

        // Terapkan filter tanggal jika ada
        if ($startDate && $endDate) {
            $query->whereBetween('tanggal_peminjaman', [$startDate, $endDate]);
        }

        $peminjamans = $query->paginate(15);

        return view('laporan.index', compact('peminjamans', 'startDate', 'endDate'));
    }

    /**
     * Mengunduh laporan peminjaman dalam format PDF.
     */
    public function downloadPDF(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $query = Peminjaman::with(['user', 'sarpras'])->latest();

        if ($startDate && $endDate) {
            $query->whereBetween('tanggal_peminjaman', [$startDate, $endDate]);
        }

        $peminjamans = $query->get(); // Ambil semua data sesuai filter untuk PDF

        // Data yang akan dikirim ke view PDF
        $data = [
            'peminjamans' => $peminjamans,
            'startDate' => $startDate,
            'endDate' => $endDate,
        ];

        // Membuat PDF
        $pdf = Pdf::loadView('laporan.pdf', $data);

        // Mengunduh PDF dengan nama file dinamis
        $fileName = 'laporan-peminjaman-' . now()->format('Y-m-d') . '.pdf';
        return $pdf->download($fileName);
    }
}

