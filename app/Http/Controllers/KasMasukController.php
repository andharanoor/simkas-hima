<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KasMasuk;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class KasMasukController extends Controller
{
    public function index()
    {
        $kasMasuks = KasMasuk::latest()->get();
        return view('kas_masuk.index', compact('kasMasuks'));
    }

    public function create()
    {
        return view('kas_masuk.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal'   => 'required|date',
            'sumber'    => 'required',
            'jumlah'    => 'required|numeric|min:1',
            'keterangan'=> 'nullable',
            'bukti'     => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ],
        [
            'tanggal.required'  => 'Tanggal wajib diisi.',
            'sumber.required'   => 'Sumber kas wajib dipilih.',
            'jumlah.required'   => 'Jumlah wajib diisi.',
            'jumlah.numeric'    => 'Jumlah harus berupa angka.',
            'jumlah.min'        => 'Jumlah minimal Rp1.',
            'bukti.image'       => 'Bukti harus berupa gambar.',
            'bukti.mimes'       => 'Bukti harus berformat JPG, JPEG, atau PNG.',
            'bukti.max'         => 'Ukuran bukti maksimal 2 MB.',
        ]);

        $path = null;

        if ($request->hasFile('bukti')) {
            $path = $request->file('bukti')->store('bukti_kas_masuk', 'public');
        }

        KasMasuk::create([
            'tanggal'   => $request->tanggal,
            'sumber'    => $request->sumber,
            'jumlah'    => $request->jumlah,
            'keterangan'=> $request->keterangan,
            'bukti'     => $path,
            'user_id'   => auth()->id(),
        ]);

        return redirect()
            ->route('kas-masuk.index')
            ->with('success', 'Kas masuk berhasil ditambahkan');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $kasMasuk = KasMasuk::findOrFail($id);
        return view('kas_masuk.edit', compact('kasMasuk'));
    }

    public function update(Request $request, string $id)
    {
        $kasMasuk = KasMasuk::findOrFail($id);
        $request->validate(
        [
            'tanggal'    => 'required|date',
            'sumber'     => 'required',
            'jumlah'     => 'required|numeric|min:1',
            'keterangan' => 'nullable',
            'bukti'      => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ],
        [
            'tanggal.required'  => 'Tanggal wajib diisi.',
            'sumber.required'   => 'Sumber kas wajib dipilih.',
            'jumlah.required'   => 'Jumlah wajib diisi.',
            'jumlah.numeric'    => 'Jumlah harus berupa angka.',
            'jumlah.min'        => 'Jumlah minimal Rp1.',
            'bukti.image'       => 'Bukti harus berupa gambar.',
            'bukti.mimes'       => 'Bukti harus berformat JPG, JPEG, atau PNG.',
            'bukti.max'         => 'Ukuran bukti maksimal 2 MB.',
        ]);

        $path = $kasMasuk->bukti;

        if ($request->hasFile('bukti')) {
            if ($kasMasuk->bukti) { //hapus bukti lama
                Storage::disk('public')->delete($kasMasuk->bukti);
            }
            $path = $request->file('bukti')
                            ->store('bukti_kas_masuk', 'public');
        }

        $kasMasuk->update([
            'tanggal'   => $request->tanggal,
            'sumber'    => $request->sumber,
            'jumlah'    => $request->jumlah,
            'keterangan'=> $request->keterangan,
            'bukti'     => $path,
        ]);

        return redirect()
            ->route('kas-masuk.index')
            ->with('success', 'Data kas masuk berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $kasMasuk = KasMasuk::findOrFail($id);

        $kasMasuk->delete();

        return redirect()
            ->route('kas-masuk.index')
            ->with('success', 'Data kas masuk berhasil dihapus');
    }
}
