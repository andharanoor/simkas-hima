<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Data Pembayaran Kas
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow rounded-lg p-6">
                <div class="flex justify-between mb-4">

                    <h3 class="text-lg font-bold">
                        Daftar Pembayaran Kas
                    </h3>

                    @if(auth()->user()->role == 'bendahara')

                    <a href="{{ route('pembayaran-kas.create') }}"
                        class="bg-blue-600 text-white px-4 py-2 rounded-lg">
                        + Tambah Pembayaran
                    </a>

                    @endif

                </div>

                @if(session('success'))

                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 px-5 py-4 rounded-lg mb-5">
                    <span class="font-semibold">
                        {{ session('success') }}
                    </span>
                </div>

                @endif

                <table class="min-w-full table-fixed border border-gray-300 text-center">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="border px-3 py-2">No</th>
                            <th class="border px-3 py-2">Nama</th>
                            <th class="border px-3 py-2">Tanggal</th>
                            <th class="border px-3 py-2">Bulan</th>
                            <th class="border px-3 py-2">Tahun</th>
                            <th class="border px-3 py-2">Nominal</th>
                            <th class="border px-3 py-2">Status</th>
                            <th class="border px-3 py-2">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($pembayaranKas as $kas)

                        <tr>
                            <td class="border px-3 py-2">
                                {{ $loop->iteration }}
                            </td>

                            <td class="border px-3 py-2">
                                {{ $kas->nama_anggota }}
                            </td>

                            <td class="border px-3 py-2">
                                {{ $kas->tanggal }}
                            </td>

                            <td class="border px-3 py-2">
                                {{ $kas->bulan }}
                            </td>

                            <td class="border px-3 py-2">
                                {{ $kas->tahun }}
                            </td>

                            <td class="border px-3 py-2">
                                Rp {{ number_format($kas->jumlah,0,',','.') }}
                            </td>

                            <td class="border px-3 py-2">

                                @if($kas->status=='lunas')

                                <span class="text-green-600 font-bold">
                                    Lunas
                                </span>

                                @else

                                <span class="text-red-600 font-bold">
                                    Belum Lunas
                                </span>

                                @endif

                            </td>

                            <td class="border px-3 py-2">
                                <div class="flex justify-center gap-2 whitespace-nowrap">
                                    <a href="{{ route('pembayaran-kas.show', $kas->id) }}"
                                        class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600">
                                        Detail
                                    </a>    
                                
                                    @if(auth()->user()->role == 'bendahara')

                                    <a href="{{ route('pembayaran-kas.edit', $kas->id) }}"
                                        class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600">
                                        Edit
                                    </a>

                                    <form action="{{ route('pembayaran-kas.destroy', $kas->id) }}"
                                        method="POST">

                                        @csrf
                                        @method('DELETE')

                                        <button 
                                            type="submit"
                                            class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700"
                                            onclick="return confirm('Yakin ingin menghapus data pembayaran kas ini?')">
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
                                Belum ada pembayaran.
                            </td>
                        </tr>

                        @endforelse

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
