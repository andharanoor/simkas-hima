<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Detail Anggota
        </h2>
    </x-slot>


    <div class="py-6">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow rounded-lg p-6">
                <div class="mb-4">
                    <label class="font-semibold"> Nama </label>
                    <p> {{ $anggota->nama }} </p>
                </div>

                <div class="mb-4">
                    <label class="font-semibold"> Username </label>
                    <p> {{ $anggota->user->username }} </p>
                </div>

                <div class="mb-4">
                    <label class="font-semibold"> NIM </label>
                    <p> {{ $anggota->nim }} </p>
                </div>

                <div class="mb-4">
                    <label class="font-semibold"> Jurusan </label>

                    <p> {{ $anggota->jurusan }} </p>
                </div>

                <div class="mb-4">
                    <label class="font-semibold"> No HP </label>
                    <p> {{ $anggota->no_hp }} </p>
                </div>

                <div class="mb-4">
                    <label class="font-semibold"> Status </label>
                    <p> {{ $anggota->status }} </p>
                </div>

                <div class="mt-8">
                    <h3 class="text-lg font-bold mb-4">
                        Riwayat Pembayaran Kas
                    </h3>

                    <table class="min-w-full border text-center">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="border px-4 py-2"> Tanggal </th>
                                <th class="border px-4 py-2"> Bulan </th>
                                <th class="border px-4 py-2"> Tahun </th>
                                <th class="border px-4 py-2"> Jumlah </th>
                                <th class="border px-4 py-2"> Status </th>
                            </tr>
                        </thead>

                        <tbody>

                        @forelse($anggota->pembayaranKas as $bayar)

                            <tr>
                                <td class="border px-4 py-2"> {{ $bayar->tanggal }} </td>
                                <td class="border px-4 py-2"> {{ $bayar->bulan }} </td>
                                <td class="border px-4 py-2"> {{ $bayar->tahun }} </td>
                                <td class="border px-4 py-2">  Rp {{ number_format($bayar->jumlah,0,',','.') }} </td>
                                <td class="border px-4 py-2">
                                        @if($bayar->status == 'lunas')

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

                        @empty

                            <tr>
                                <td colspan="5" class="border px-4 py-3">
                                    Belum ada pembayaran
                                </td>
                            </tr>

                        @endforelse

                        </tbody>
                        
                    </table>

                    <div class="flex justify-end mt-6">
                        <a href="{{ route('anggota.index') }}"
                            class="bg-gray-500 text-white px-5 py-2 rounded-lg">
                            Kembali
                        </a>
                    </div>
                    
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
