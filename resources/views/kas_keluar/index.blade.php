<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Data Kas Keluar
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow rounded-lg p-6">
                <div class="flex justify-between items-center mb-4">

                    <h3 class="text-lg font-bold">
                        Daftar Kas Keluar
                    </h3>

                    @if(auth()->user()->role=='bendahara')

                    <a href="{{ route('kas-keluar.create') }}"
                       class="bg-blue-600 text-white px-4 py-2 rounded-lg">
                        + Tambah Kas Keluar
                    </a>

                    @endif

                </div>

                @if(session('success'))

                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                        {{ session('success') }}
                    </div>

                @endif

                <table class="min-w-full table-fixed border border-gray-300 text-center">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="border px-4 py-2">No</th>
                            <th class="border px-4 py-2">Tanggal</th>
                            <th class="border px-4 py-2">Kategori</th>
                            <th class="border px-4 py-2">Nominal</th>
                            <th class="border px-4 py-2">Keterangan</th>
                            <th class="border px-4 py-2">Bukti</th>

                            @if(auth()->user()->role=='bendahara')

                            <th class="border px-4 py-2 w-64">Aksi</th>

                            @endif

                        </tr>

                    </thead>

                    <tbody>

                    @forelse($kasKeluars as $kas)

                    <tr>
                        <td class="border px-4 py-2">
                            {{ $loop->iteration }}
                        </td>
                        <td class="border px-4 py-2">
                            {{ $kas->tanggal }}
                        </td>
                        <td class="border px-4 py-2">
                            {{ $kas->kategori }}
                        </td>
                        <td class="border px-4 py-2">
                            Rp {{ number_format($kas->jumlah,0,',','.') }}
                        </td>
                        <td class="border px-4 py-2">
                            {{ $kas->keterangan }}
                        </td>
                        <td class="border px-4 py-2">

                            @if($kas->bukti)

                                <a href="{{ asset('storage/'.$kas->bukti) }}"
                                   target="_blank"
                                   class="text-blue-600">
                                    Lihat Bukti
                                </a>

                            @else

                                -

                            @endif

                        </td>

                        @if(auth()->user()->role=='bendahara')

                        <td class="border px-4 py-2">
                            <div class="flex justify-center gap-2">
                                <a href="{{ route('kas-keluar.show', $kas->id) }}"
                                    class="bg-green-600 text-white px-3 py-1 rounded">
                                    Detail
                                </a>

                                <a href="{{ route('kas-keluar.edit', $kas->id) }}"
                                    class="bg-yellow-500 text-white px-3 py-1 rounded">
                                    Edit
                                </a>

                                <form action="{{ route('kas-keluar.destroy', $kas->id) }}"
                                    method="POST">

                                    @csrf
                                    @method('DELETE')

                                    <button class="bg-red-600 text-white px-3 py-1 rounded"
                                        onclick="return confirm('Yakin ingin menghapus data kas keluar ini?')">
                                        Hapus
                                    </button>

                                </form>

                            </div>
                        </td>

                        @endif

                    </tr>

                    @empty

                    <tr>
                        <td colspan="7"
                            class="text-center py-4">
                            Belum ada data kas keluar.
                        </td>
                    </tr>

                    @endforelse

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
