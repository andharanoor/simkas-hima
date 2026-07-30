<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Data Anggota
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow rounded-lg p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-bold">
                        Daftar Anggota
                    </h3>

                    @if(auth()->user()->role == 'bendahara')

                    <a href="{{ route('anggota.create') }}"
                        class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                        + Tambah Anggota
                    </a>

                    @endif

                </div>

                @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                <table class="min-w-full border border-gray-300 text-center">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="border px-4 py-2">No</th>
                            <th class="border px-4 py-2">NIM</th>
                            <th class="border px-4 py-2">Nama</th>
                            <th class="border px-4 py-2">Jurusan</th>
                            <th class="border px-4 py-2">No HP</th>
                            <th class="border px-4 py-2">Status</th>
                            <th class="border px-4 py-2"> Aksi </th>
                        </tr>
                    </thead>
                    <tbody>

                        @forelse($anggotas as $anggota)

                        <tr>
                            <td class="border px-4 py-2">
                                {{ $loop->iteration }}
                            </td>
                            <td class="border px-4 py-2">
                                {{ $anggota->nim }}
                            </td>
                            <td class="border px-4 py-2">
                                {{ $anggota->nama }}
                            </td>
                            <td class="border px-4 py-2">
                                {{ $anggota->jurusan }}
                            </td>
                            <td class="border px-4 py-2">
                                {{ $anggota->no_hp }}
                            </td>
                            <td class="border px-4 py-2">
                                {{ $anggota->status }}
                            </td>

                            <td class="border px-4 py-2">
                                <div class="flex justify-center gap-3">
                                    <a href="{{ route('anggota.show',$anggota->id) }}"
                                        class="bg-green-500 text-white px-3 py-1 rounded">
                                        Detail
                                    </a>

                                    @if(auth()->user()->role == 'bendahara')

                                    <a href="{{ route('anggota.edit', $anggota->id) }}"
                                        class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600">
                                        Edit
                                    </a>

                                    <form action="{{ route('anggota.destroy', $anggota->id) }}"
                                        method="POST" class="inline"
                                        onsubmit="return confirm('Yakin ingin menghapus data ini?')">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700">
                                            Hapus
                                        </button>
                                    </form>

                                @endif

                                </div>
                            </td>
                        </tr>

                        @empty

                        <tr>
                            <td colspan="7" class="text-center py-4">
                                Belum ada data anggota.
                            </td>
                        </tr>

                        @endforelse

                    </tbody>
                </table>
            </div>
        </div>
    </div>

</x-app-layout>
