<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Detail Kas Keluar
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow rounded-lg p-6 mt-6">
                <div class="mb-4">
                    <strong>Tanggal</strong>
                    <p>{{ $kasKeluar->tanggal }}</p>
                </div>

                <div class="mb-4">
                    <strong>Kategori</strong>
                    <p>{{ $kasKeluar->kategori }}</p>
                </div>

                <div class="mb-4">
                    <strong>Nominal</strong>
                    <p>Rp {{ number_format($kasKeluar->jumlah,0,',','.') }}</p>
                </div>

                <div class="mb-4">
                    <strong>Keterangan</strong>
                    <p>{{ $kasKeluar->keterangan ?? '-' }}</p>
                </div>

                <div class="mb-6">
                    <strong>Bukti</strong><br>

                    @if($kasKeluar->bukti)
                        <img src="{{ asset('storage/'.$kasKeluar->bukti) }}"
                             class="w-64 rounded mt-2">
                    @else
                        <p>Tidak ada bukti.</p>
                    @endif
                </div>

                <a href="{{ route('kas-keluar.index') }}"
                   class="bg-gray-500 text-white px-5 py-2 rounded-lg">
                    Kembali
                </a>
            </div>

        </div>
    </div>
</x-app-layout>
