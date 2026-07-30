<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AnggotaController extends Controller
{
    public function index(){
        $anggotas = Anggota::all();
        return view('anggota.index', compact('anggotas'));
    }

    public function create(){
        return view('anggota.create');
    }

    public function store(Request $request){
        $request->validate([
            'nama'      => ['required', 'regex:/^[a-zA-Z\s]+$/'],
            'username'  => 'required|unique:users',
            'password'  => 'required',
            'nim'       => 'required|unique:anggotas',
            'jurusan'   => 'required',
            'no_hp'     => ['required', 'digits_between:11,13'],
            'status'    => 'required',
        ],
        
        [ 
            'nama.regex' => 'Nama hanya boleh berisi huruf dan spasi.',
            'no_hp.digits_between' => 'Nomor HP harus terdiri dari 11 sampai 13 angka.',
        ]);

        $user = User::create([
            'nama'      => $request->nama,
            'username'  => $request->username,
            'password'  => Hash::make($request->password),
            'role'      => 'anggota',
        ]);

        Anggota::create([
            'user_id'   => $user->id,
            'nim'       => $request->nim,
            'nama'      => $request->nama,
            'jurusan'   => $request->jurusan,
            'no_hp'     => $request->no_hp,
            'status'    => $request->status,
        ]);

        return redirect()
            ->route('anggota.index')
            ->with('success', 'Data anggota berhasil ditambahkan');
    }

    public function show(string $id)
    {
        $anggota = Anggota::with('pembayaranKas')->findOrFail($id);
        return view('anggota.show', compact('anggota'));
    }

    public function edit(string $id)
    {
        $anggota = Anggota::findOrFail($id);
        return view('anggota.edit', compact('anggota'));
    }

    public function update(Request $request, string $id)
    {
        $anggota = Anggota::findOrFail($id);

        $request->validate([
            'nama'      => ['required', 'regex:/^[a-zA-Z\s]+$/'],
            'username'  => 'required|unique:users,username,' . $anggota->user_id,
            'nim'       => 'required|unique:anggotas,nim,' . $anggota->id,
            'jurusan'   => 'required',
            'no_hp'     => ['required','digits_between:11,13'],
            'status'    => 'required',
        ],

        [
            'nama.regex' => 'Nama hanya boleh berisi huruf dan spasi.',
            'no_hp.digits_between' => 'Nomor HP harus terdiri dari 11 sampai 13 angka.',
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
            'nama'      => $request->nama,
            'nim'       => $request->nim,
            'jurusan'   => $request->jurusan,
            'no_hp'     => $request->no_hp,
            'status'    => $request->status,
        ]);

        return redirect()
            ->route('anggota.index')
            ->with('success', 'Data anggota berhasil diperbarui');
    }

    public function destroy($id)
    {
        $anggota = Anggota::findOrFail($id);
        $user = $anggota->user;
        $anggota->delete();

        if ($user && $user->role == 'anggota') {
            $user->delete();
        }

        return redirect()
            ->route('anggota.index')
            ->with('success', 'Anggota berhasil dihapus.');
    }
}
