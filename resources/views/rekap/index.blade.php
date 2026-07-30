<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Rekap Pembayaran Kas
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-center gap-4 mb-6">

                <div class="bg-blue-500 text-white p-4 rounded-lg shadow w-1/4">
                    <h3>Total Anggota</h3>
                    <p class="text-3xl font-bold"> {{ $totalAnggota }} </p>
                </div>

                <div class="bg-green-500 text-white p-4 rounded-lg shadow w-1/4">
                    <h3>Sudah Bayar</h3>
                    <p class="text-3xl font-bold"> {{ $sudahBayar }} </p>
                </div>

                <div class="bg-red-500 text-white p-4 rounded-lg shadow w-1/4">
                    <h3>Belum Bayar</h3>
                    <p class="text-3xl font-bold"> {{ $belumBayar }} </p>
                </div>

                <div class="bg-yellow-500 text-white p-4 rounded-lg shadow w-1/4">
                        <h3 class="text-sm">Total Kas</h3>
                        <p class="text-xl font-bold mt-2">
                            Rp {{ number_format($totalKas,0,',','.') }}
                        </p>
                    </div>
                </div>

                <div class="bg-white shadow rounded-lg p-6">

                    <h3 class="font-bold text-lg mb-4">
                        Data Pembayaran
                    </h3>

                    <table class="min-w-full border text-center">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="border px-4 py-2"> Nama </th>
                                <th class="border px-4 py-2"> Tanggal </th>
                                <th class="border px-4 py-2"> Bulan </th>
                                <th class="border px-4 py-2"> Jumlah </th>
                                <th class="border px-4 py-2"> Status </th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach($pembayaran as $bayar)

                            <tr>
                                <td class="border px-4 py-2"> {{ $bayar->nama_anggota }} </td>
                                <td class="border px-4 py-2"> {{ $bayar->tanggal }} </td>
                                <td class="border px-4 py-2"> {{ $bayar->bulan }} </td>
                                <td class="border px-4 py-2">
                                    Rp {{ number_format($bayar->jumlah,0,',','.') }}
                                </td>

                                <td class="border px-4 py-2">

                                    @if($bayar->status=='lunas')

                                    <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full">
                                        Lunas
                                    </span>

                                    @else

                                    <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full">
                                        Belum Lunas
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
