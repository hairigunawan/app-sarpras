<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;
    protected $table = 'peminjamans';

    protected $fillable = [
        'id_akun',
        'id_sarpras',
        'tanggal_peminjaman',
        'tanggal_pengembalian',
        'jam_mulai',
        'jam_selesai',
        'status_peminjaman',
        'keterangan_peminjaman',
    ];

    /**
     * Relasi ke model User (Akun)
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'id_akun');
    }

    /**
     * Relasi ke model Sarpras
     */
    public function sarpras()
    {
        return $this->belongsTo(Sarpras::class, 'id_sarpras');
    }

    /**
     * Relasi ke model Notifikasi
     */
    public function notifikasis()
    {
        return $this->hasMany(Notifikasi::class, 'id_peminjaman');
    }
}

