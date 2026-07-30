<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id', 'nim',
        'nama', 'jurusan',
        'no_hp', 'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pembayaranKas()
    {
        return $this->hasMany(PembayaranKas::class);
    }
}
