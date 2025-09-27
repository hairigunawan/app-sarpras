<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Sarpras;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PeminjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Mengambil data peminjaman dengan relasi ke user (akun) dan sarpras
        // Menggunakan with() untuk Eager Loading agar query lebih efisien
        // Diurutkan berdasarkan tanggal peminjaman terbaru dan di-paginate
        $peminjamans = Peminjaman::with(['user', 'sarpras'])
                                ->latest('tanggal_peminjaman')
                                ->paginate(10); // Menampilkan 10 item per halaman

        return view('peminjaman.index', compact('peminjamans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $sarprasList = Sarpras::where('status_sarpras', 'Tersedia')->get();
        return view('peminjaman.create', compact('sarprasList'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_sarpras' => 'required|exists:sarpras,id',
            'tanggal_peminjaman' => 'required|date|after_or_equal:today',
            'tanggal_pengembalian' => 'required|date|after_or_equal:tanggal_peminjaman',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required|after:jam_mulai',
            'keterangan_peminjaman' => 'nullable|string|max:255',
        ]);

        Peminjaman::create([
            'id_akun' => Auth::id() ?? 1,
            'id_sarpras' => $request->id_sarpras,
            'tanggal_peminjaman' => $request->tanggal_peminjaman,
            'tanggal_pengembalian' => $request->tanggal_pengembalian,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'keterangan_peminjaman' => $request->keterangan_peminjaman,
            'status_peminjaman' => 'Diajukan',
        ]);

        return redirect()->route('peminjaman.index')->with('success', 'Peminjaman berhasil diajukan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Peminjaman $peminjaman)
    {
        // Load relasi user dan sarpras untuk ditampilkan di view
        $peminjaman->load(['user', 'sarpras']);
        return view('peminjaman.show', compact('peminjaman'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Peminjaman $peminjaman)
    {
        // Validasi input status
        $request->validate([
            'status' => 'required|in:Disetujui,Ditolak',
        ]);

        // Update status peminjaman
        $peminjaman->update([
            'status_peminjaman' => $request->status,
        ]);

        // TODO: Kirim notifikasi jika ada

        return redirect()->route('peminjaman.index')->with('success', 'Status peminjaman berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Peminjaman $peminjaman)
    {
        // TODO: Logika untuk menghapus/membatalkan peminjaman
    }
}

