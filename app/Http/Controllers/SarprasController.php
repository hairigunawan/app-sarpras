<?php

namespace App\Http\Controllers;

use App\Models\Sarpras;
use Illuminate\Http\Request;

class SarprasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Mengambil semua data sarpras dari database
        $sarprasList = Sarpras::latest()->paginate(10); // Mengambil data terbaru & paginasi

        // Mengirim data ke view sarpras.index
        return view('sarpras.index', compact('sarprasList'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // TODO: Menampilkan form untuk menambah sarpras baru
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // TODO: Logika untuk menyimpan sarpras baru ke database
    }

    /**
     * Display the specified resource.
     */
    public function show(Sarpras $sarpras)
    {
        // TODO: Menampilkan detail satu sarpras
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sarpras $sarpras)
    {
        // TODO: Menampilkan form untuk mengedit sarpras
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sarpras $sarpras)
    {
        // TODO: Logika untuk memperbarui data sarpras di database
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sarpras $sarpras)
    {
        // TODO: Logika untuk menghapus sarpras dari database
    }

    public function checkAvailability(Request $request)
    {
        // TODO: Logika untuk mengecek ketersediaan sarpras pada waktu tertentu
    }

    public function importSchedule(Request $request)
    {
        // TODO: Logika untuk mengimpor jadwal dari file Excel
    }
}

