<?php

namespace App\Http\Controllers;

use App\Models\KasMasuk;
use App\Models\KasKeluar;
use App\Models\PembayaranKas;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function index(Request $request)
    {
        $kasMasuk = KasMasuk::all()->map(function($kas){
            return [
                'tanggal'   => $kas->tanggal,
                'keterangan'=> $kas->keterangan,
                'jumlah'    => $kas->jumlah,
                'jenis'     => 'Kas Masuk'
            ];
        });

        $kasKeluar = KasKeluar::all()->map(function($kas){
            return [
                'tanggal'   => $kas->tanggal,
                'keterangan'=> $kas->kategori,
                'jumlah'    => $kas->jumlah,
                'jenis'     => 'Kas Keluar'
            ];
        });

        $pembayaran = PembayaranKas::with('anggota')->get()->map(function($kas){
            return [
                'tanggal'   => $kas->tanggal,
                'keterangan' => 'Pembayaran '.$kas->nama_anggota,
                'jumlah'    => $kas->jumlah,
                'jenis'     => 'Pembayaran Kas'
            ];
        });

        $transaksi = $kasMasuk
            ->merge($kasKeluar)
            ->merge($pembayaran);

        if ($request->filled('dari')) {
            $transaksi = $transaksi->filter(function ($item) use ($request) {
                return $item['tanggal'] >= $request->dari;
            });
        }

        if ($request->filled('sampai')) {
            $transaksi = $transaksi->filter(function ($item) use ($request) {
                return $item['tanggal'] <= $request->sampai;
            });
        }

        $transaksi = $transaksi->sortByDesc('tanggal');
        return view('transaksi.index', compact('transaksi'));
    }
}
