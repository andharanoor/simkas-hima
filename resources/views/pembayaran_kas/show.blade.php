<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Detail Pembayaran Kas
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow rounded-lg p-6">

                <div class="mb-4">
                    <label class="font-semibold">Nama Anggota</label>
                    <p>{{ $pembayaran->nama_anggota }}</p>
                </div>

                <div class="mb-4">
                    <label class="font-semibold">Tanggal Pembayaran</label>
                    <p>{{ $pembayaran->tanggal }}</p>
                </div>

                <div class="mb-4">
                    <label class="font-semibold">Bulan</label>
                    <p>{{ $pembayaran->bulan }}</p>
                </div>

                <div class="mb-4">
                    <label class="font-semibold">Tahun</label>
                    <p>{{ $pembayaran->tahun }}</p>
                </div>

                <div class="mb-4">
                    <label class="font-semibold">Nominal</label>
                    <p>Rp {{ number_format($pembayaran->jumlah,0,',','.') }}</p>
                </div>

                <div class="mb-4">
                    <label class="font-semibold">
                        Bukti Pembayaran
                    </label>

                    @if($pembayaran->bukti)

                        <div class="mt-3">
                            <img src="{{ asset('storage/'.$pembayaran->bukti) }}"
                                class="w-72 rounded-lg shadow">

                            <a href="{{ asset('storage/'.$pembayaran->bukti) }}"
                            target="_blank"
                            class="block mt-2 text-blue-600 hover:underline">
                                Lihat Gambar
                            </a>
                        </div>

                    @else

                        <p class="text-gray-500 mt-2">
                            Tidak ada bukti pembayaran.
                        </p>

                    @endif
                </div>

                <div class="mb-6">
                    <label class="font-semibold">Status</label>

                    <div class="mt-2">
                        @if($pembayaran->status == 'lunas')
                            <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full">
                                Lunas
                            </span>

                        @else

                            <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full">
                                Belum Lunas
                            </span>

                        @endif

                    </div>

                </div>

                <div class="flex justify-end mt-8">
                    <a href="{{ route('pembayaran-kas.index') }}"
                        class="bg-gray-500 text-white px-5 py-2 rounded-lg hover:bg-gray-600">
                        Kembali
                    </a>
                </div>

            </div>
        </div>
    </div>

</x-app-layout>
