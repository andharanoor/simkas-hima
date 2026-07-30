<?php

namespace App\Http\Controllers;

use App\Models\PembayaranKas;
use App\Models\Anggota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PembayaranKasController extends Controller
{
    public function index()
    {
        $pembayaranKas = PembayaranKas::with('anggota')->get();
        return view('pembayaran_kas.index', compact('pembayaranKas'));
    }

    public function create()
    {
        $anggotas = Anggota::all();
        return view('pembayaran_kas.create', compact('anggotas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'anggota_id' => 'required',
            'tanggal'    => 'required|date',
            'bulan'      => 'required',
            'tahun'      => 'required',
            'jumlah'     => 'required|numeric|min:1',
            'status'     => 'required',
            'bukti'      => 'nullable|mimes:jpg,jpeg,png,pdf|max:2048',
        ],
        [
            'anggota_id.required' => 'Anggota wajib dipilih.',
            'tanggal.required'    => 'Tanggal wajib diisi.',
            'bulan.required'      => 'Bulan wajib dipilih.',
            'tahun.required'      => 'Tahun wajib diisi.',
            'jumlah.required'     => 'Nominal wajib diisi.',
            'jumlah.numeric'      => 'Nominal harus berupa angka.',
            'status.required'     => 'Status wajib dipilih.',
            'bukti.image'         => 'Bukti harus berupa gambar.',
            'bukti.mimes'         => 'Bukti harus berformat JPG, JPEG, atau PNG.',
            'bukti.max'           => 'Ukuran bukti maksimal 2 MB.',
        ]
        );

        $data = $request->all();
        $anggota = Anggota::findOrFail($request->anggota_id);
        $data['nama_anggota'] = $anggota->nama;

        if ($request->hasFile('bukti')) {
            $data['bukti'] = $request->file('bukti')
                ->store('bukti', 'public');
        }

        PembayaranKas::create($data);
        
        return redirect()
            ->route('pembayaran-kas.index')
            ->with('success', 'Pembayaran kas berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $pembayaranKas = PembayaranKas::findOrFail($id);
        $anggotas = Anggota::all();
        return view('pembayaran_kas.edit', compact('pembayaranKas', 'anggotas'));
    }

    public function show($id)
    {
        $pembayaran = PembayaranKas::with('anggota')->findOrFail($id);
        return view('pembayaran_kas.show', compact('pembayaran'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'anggota_id' => 'required',
            'nama_anggota' => Anggota::find($request->anggota_id)->nama,
            'tanggal'    => 'required|date',
            'bulan'      => 'required',
            'tahun'      => 'required',
            'jumlah'     => 'required|numeric|min:1',
            'status'     => 'required',
            'bukti'      => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $pembayaranKas = PembayaranKas::findOrFail($id);

        $path = $pembayaranKas->bukti;

        if ($request->hasFile('bukti')) {

            if ($pembayaranKas->bukti) {
                Storage::disk('public')->delete($pembayaranKas->bukti);
            }

            $path = $request->file('bukti')
                            ->store('bukti_pembayaran', 'public');
        }

        $pembayaranKas->update([
            'anggota_id' => $request->anggota_id,
            'tanggal'    => $request->tanggal,
            'bulan'      => $request->bulan,
            'tahun'      => $request->tahun,
            'jumlah'     => $request->jumlah,
            'status'     => $request->status,
            'bukti'      => $path,
        ]);

        return redirect()
            ->route('pembayaran-kas.index')
            ->with('success', 'Data pembayaran berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $pembayaranKas = PembayaranKas::findOrFail($id);
        $pembayaranKas->delete();
        return redirect()
            ->route('pembayaran-kas.index')
            ->with('success', 'Data pembayaran berhasil dihapus.');
    }
}
