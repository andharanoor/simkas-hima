<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\KasMasuk;
use App\Models\KasKeluar;
use App\Models\PembayaranKas;

class DashboardController extends Controller
{
    public function index()
    {
        $totalAnggota = Anggota::count();
        $totalKasMasuk = KasMasuk::sum('jumlah') + PembayaranKas::where('status','lunas')->sum('jumlah');
        $totalKasKeluar = KasKeluar::sum('jumlah');
        $saldo = $totalKasMasuk - $totalKasKeluar;
        $sudahBayar = PembayaranKas::where('status','lunas')->count();
        $belumBayar = PembayaranKas::where('status','belum lunas')->count();

       $kasMasukTerbaru = KasMasuk::all()->map(function($kas){
            return [
                'tanggal'   => $kas->tanggal,
                'keterangan'=> $kas->keterangan,
                'jumlah'    => $kas->jumlah,
                'jenis'     => 'Kas Masuk'
            ];
        });

        $kasKeluarTerbaru = KasKeluar::all()->map(function($kas){
            return [
                'tanggal'   => $kas->tanggal,
                'keterangan'=> $kas->kategori,
                'jumlah'    => $kas->jumlah,
                'jenis'     => 'Kas Keluar'
            ];
        });

        $pembayaranKasTerbaru = PembayaranKas::with('anggota')->get()->map(function($kas){
            return [
                'tanggal'   => $kas->tanggal,
                'keterangan'=> 'Pembayaran Kas - '.$kas->nama_anggota,
                'jumlah'    => $kas->jumlah,
                'jenis'     => 'Pembayaran Kas'
            ];
        });

        $transaksiTerbaru = $kasMasukTerbaru
            ->merge($kasKeluarTerbaru)
            ->merge($pembayaranKasTerbaru)
            ->sortByDesc('tanggal')
            ->take(10);

        return view('dashboard', compact(
            'totalAnggota',
            'totalKasMasuk',
            'totalKasKeluar',
            'saldo',
            'sudahBayar',
            'belumBayar',
            'transaksiTerbaru'
        ));
    }
}
