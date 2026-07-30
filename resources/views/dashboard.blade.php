<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            Dashboard SIMKas HIMA SI
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                <!-- Total Anggota -->
                <div class="bg-blue-500 text-white rounded-xl shadow-lg p-6">
                    <h3 class="text-lg font-semibold">
                        Total Anggota
                    </h3>

                    <p class="text-4xl font-bold mt-3">
                        {{ $totalAnggota }}
                    </p>
                </div>

                <!-- Kas Masuk -->
                <div class="bg-green-500 text-white rounded-xl shadow-lg p-6">
                    <h3 class="text-lg font-semibold">
                        Total Kas Masuk
                    </h3>

                    <p class="text-3xl font-bold mt-3">
                        Rp {{ number_format($totalKasMasuk,0,',','.') }}
                    </p>
                </div>

                <!-- Kas Keluar -->
                <div class="bg-red-500 text-white rounded-xl shadow-lg p-6">
                    <h3 class="text-lg font-semibold">
                        Total Kas Keluar
                    </h3>

                    <p class="text-3xl font-bold mt-3">
                        Rp {{ number_format($totalKasKeluar,0,',','.') }}
                    </p>
                </div>

                <!-- Saldo -->
                <div class="bg-yellow-500 text-white rounded-xl shadow-lg p-6">
                    <h3 class="text-lg font-semibold">
                        Saldo Saat Ini
                    </h3>

                    <p class="text-3xl font-bold mt-3">
                        Rp {{ number_format($saldo,0,',','.') }}
                    </p>
                </div>

                <!-- Sudah Bayar -->
                <div class="bg-emerald-500 text-white rounded-xl shadow-lg p-6">
                    <h3 class="text-lg font-semibold">
                        Sudah Bayar
                    </h3>

                    <p class="text-4xl font-bold mt-3">
                        {{ $sudahBayar }}
                    </p>
                </div>

                <!-- Belum Bayar -->
                <div class="bg-orange-500 text-white rounded-xl shadow-lg p-6">
                    <h3 class="text-lg font-semibold">
                        Belum Bayar
                    </h3>

                    <p class="text-4xl font-bold mt-3">
                        {{ $belumBayar }}
                    </p>
                </div>
            </div>

            <div class="mt-8 bg-white shadow rounded-lg p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-bold">
                        Transaksi Terbaru
                    </h3>

                    <a href="{{ route('transaksi.index') }}"
                    class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                        Lihat Data
                    </a>

                </div>

                <table class="min-w-full border text-center">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="border px-4 py-2">
                                Tanggal
                            </th>
                            <th class="border px-4 py-2">
                                Keterangan
                            </th>
                            <th class="border px-4 py-2">
                                Jumlah
                            </th>
                            <th class="border px-4 py-2">
                                Jenis
                            </th>
                        </tr>
                    </thead>

                    <tbody>

                        @foreach($transaksiTerbaru as $transaksi)

                        <tr>
                            <td class="border px-4 py-2">
                                {{ $transaksi['tanggal'] }}
                            </td>

                            <td class="border px-4 py-2">
                                {{ $transaksi['keterangan'] }}
                            </td>

                            <td class="border px-4 py-2 
                                {{ $transaksi['jenis']=='Kas Keluar' ? 'text-red-600' 
                                 : ($transaksi['jenis']=='Pembayaran Kas'? 'text-purple-600' : 'text-green-600') }}">
                                Rp {{ number_format($transaksi['jumlah'],0,',','.') }}
                            </td>

                            <td class="border px-4 py-2">

                                @if($transaksi['jenis']=='Kas Masuk')

                                <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm">
                                    Kas Masuk
                                </span>

                                @elseif($transaksi['jenis']=='Kas Keluar')

                                <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-sm">
                                    Kas Keluar
                                </span>

                                @else

                                <span class="bg-purple-100 text-purple-700 px-3 py-1 rounded-full text-sm">
                                    Pembayaran Kas
                                </span>

                                @endif

                            </td>
                        </tr>

                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
