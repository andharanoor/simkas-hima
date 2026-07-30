<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KasKeluar extends Model
{
    protected $fillable = [
        'tanggal',
        'kategori',
        'jumlah',
        'keterangan',
        'bukti',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
