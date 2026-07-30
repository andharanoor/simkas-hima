<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PembayaranKas extends Model
{
    protected $table = 'pembayaran_kas';
    protected $fillable = [
        'anggota_id',
        'nama_anggota',
        'tanggal',
        'bulan',
        'tahun',
        'jumlah',
        'status',
        'bukti',
    ];

    public function anggota()
    {
        return $this->belongsTo(Anggota::class);
    }
}
