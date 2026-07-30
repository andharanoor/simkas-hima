<?php

namespace App\Http\Controllers;

use App\Models\KasKeluar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class KasKeluarController extends Controller
{
    public function index()
    {
        $kasKeluars = KasKeluar::all();
        return view('kas_keluar.index', compact('kasKeluars'));
    }

    public function create()
    {
        return view('kas_keluar.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal'   => 'required|date|before_or_equal:today',
            'kategori'  => 'required',
            'jumlah'    => 'required|numeric|min:1',
            'keterangan'=> 'nullable',
            'bukti'     => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ],[
            'tanggal.required' => 'Tanggal wajib diisi.',
            'tanggal.before_or_equal' => 'Tanggal tidak boleh melebihi hari ini.',
            'kategori.required' => 'Kategori wajib dipilih.',
            'jumlah.required' => 'Nominal wajib diisi.',
            'jumlah.numeric' => 'Nominal harus berupa angka.',
            'jumlah.min' => 'Nominal minimal Rp1.',
            'bukti.image' => 'File bukti harus berupa gambar.',
            'bukti.mimes' => 'Bukti harus jpg, jpeg, atau png.',
            'bukti.max' => 'Ukuran bukti maksimal 2MB.',
        ]);

        $path = null;

        if($request->hasFile('bukti')){
            $path = $request->file('bukti')->store('kas_keluar','public');
        }

        KasKeluar::create([
            'tanggal'   =>$request->tanggal,
            'kategori'  =>$request->kategori,
            'jumlah'    =>$request->jumlah,
            'keterangan'=>$request->keterangan,
            'bukti'     =>$path,
            'user_id'   =>auth()->id(),
        ]);

        return redirect()->route('kas-keluar.index')
                ->with('success','Data kas keluar berhasil ditambahkan.');
    }

    public function show(string $id)
    {
        $kasKeluar = KasKeluar::findOrFail($id);
        return view('kas_keluar.show', compact('kasKeluar'));
    }

    public function edit(string $id)
    {
        $kasKeluar = KasKeluar::findOrFail($id);
        return view('kas_keluar.edit', compact('kasKeluar'));
    }

    public function update(Request $request, $id)
    {
        $kasKeluar = KasKeluar::findOrFail($id);

        $request->validate([
            'tanggal'   => 'required|date|before_or_equal:today',
            'kategori'  => 'required',
            'jumlah'    => 'required|numeric|min:1',
            'keterangan'=> 'nullable',
            'bukti'     => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ],[
            'tanggal.required' => 'Tanggal wajib diisi.',
            'tanggal.before_or_equal' => 'Tanggal tidak boleh melebihi hari ini.',
            'kategori.required' => 'kategori wajib dipilih.',
            'jumlah.required' => 'Nominal wajib diisi.',
            'jumlah.numeric' => 'Nominal harus berupa angka.',
            'jumlah.min' => 'Nominal minimal Rp1.',
        ]);

        if($request->hasFile('bukti')){
            if($kasKeluar->bukti){
                \Storage::disk('public')->delete($kasKeluar->bukti);
            }
            $kasKeluar->bukti = $request->file('bukti')->store('kas_keluar','public');
        }

        $kasKeluar->tanggal = $request->tanggal;
        $kasKeluar->kategori = $request->kategori;
        $kasKeluar->jumlah = $request->jumlah;
        $kasKeluar->keterangan = $request->keterangan;

        $kasKeluar->save();

        return redirect()->route('kas-keluar.index')
                ->with('success','Data kas keluar berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $kasKeluar = KasKeluar::findOrFail($id);

        if ($kasKeluar->bukti) {
            Storage::disk('public')->delete($kasKeluar->bukti);
        }

        $kasKeluar->delete();
        return redirect()
            ->route('kas-keluar.index')
            ->with('success', 'Data kas keluar berhasil dihapus.');
    }
}
