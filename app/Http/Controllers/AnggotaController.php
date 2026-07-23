<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AnggotaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(){
        $anggotas = Anggota::all();
        return view('anggota.index', compact('anggotas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(){
        return view('anggota.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request){
        $request->validate([
            'nama' => 'required',
            'username' => 'required|unique:users',
            'password' => 'required',
            'nim' => 'required|unique:anggotas',
            'jurusan' => 'required',
            'no_hp' => 'nullable',
            'status' => 'required',
        ]);

        $user = User::create([
            'nama' => $request->nama,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role' => 'anggota',
        ]);

        Anggota::create([
            'user_id' => $user->id,
            'nim' => $request->nim,
            'nama' => $request->nama,
            'jurusan' => $request->jurusan,
            'no_hp' => $request->no_hp,
            'status' => $request->status,
        ]);

        return redirect()
            ->route('anggota.index')
            ->with('success', 'Data anggota berhasil ditambahkan');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $anggota = Anggota::findOrFail($id);
        return view('anggota.edit', compact('anggota'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $anggota = Anggota::findOrFail($id);

        $request->validate([
            'nama' => 'required',
            'username' => 'required|unique:users,username,' . $anggota->user_id,
            'nim' => 'required|unique:anggotas,nim,' . $anggota->id,
            'jurusan' => 'required',
            'status' => 'required',
        ]);

        // update tabel user
        $anggota->user->update([
            'nama' => $request->nama,
            'username' => $request->username,
        ]);

        // kalau password diisi, update password
        if ($request->filled('password')) {
            $anggota->user->update([
                'password' => Hash::make($request->password),
            ]);
        }

        // update tabel anggota
        $anggota->update([
            'nama' => $request->nama,
            'nim' => $request->nim,
            'jurusan' => $request->jurusan,
            'no_hp' => $request->no_hp,
            'status' => $request->status,
        ]);

        return redirect()
            ->route('anggota.index')
            ->with('success', 'Data anggota berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $anggota = Anggota::findOrFail($id);

        // hapus akun user
        $anggota->user()->delete();

        // hapus data anggota
        $anggota->delete();

        return redirect()
            ->route('anggota.index')
            ->with('success', 'Data anggota berhasil dihapus');
    }
}
