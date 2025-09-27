<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sarpras extends Model
{
    use HasFactory;

    protected $table = 'sarpras';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nama_sarpras',
        'jenis_sarpras',
        'gambar_sarpras',
        'status_sarpras',
        'lokasi',
        'kapasitas_ruangan',
        'kode_ruangan',
        'kode_proyektor',
    ];

    public function peminjamans()
    {
        return $this->hasMany(Peminjaman::class);
    }
}

