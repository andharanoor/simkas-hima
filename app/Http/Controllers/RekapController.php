<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\PembayaranKas;
use Illuminate\Http\Request;

class RekapController extends Controller
{
    public function index(Request $request)
    {
        $bulan = $request->bulan;
        $tahun = $request->tahun;

        $pembayaran = PembayaranKas::with('anggota');

        if($bulan){
            $pembayaran->where('bulan', $bulan);
        }

        if($tahun){
            $pembayaran->where('tahun', $tahun);
        }

        $pembayaran = $pembayaran->get();

        $totalAnggota = Anggota::count();
        $sudahBayar = $pembayaran
            ->where('status','lunas')
            ->count();

        $belumBayar = $totalAnggota - $sudahBayar;
        $totalKas = $pembayaran
            ->where('status','lunas')
            ->sum('jumlah');

        return view('rekap.index', compact(
            'pembayaran',
            'totalAnggota',
            'sudahBayar',
            'belumBayar',
            'totalKas'
        ));
    }
}
