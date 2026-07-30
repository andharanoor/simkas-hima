<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Tambah Pembayaran Kas
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow rounded-lg p-6">

                @if($errors->any())
                    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-lg mb-5">
                        <ul class="list-disc list-inside">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('pembayaran-kas.store') }}"
                    method="POST"
                    enctype="multipart/form-data">

                    @csrf

                    <div class="mb-4">
                        <label class="block font-semibold mb-2">
                            Anggota 
                        </label>
                        <select name="anggota_id" class="w-full rounded-lg border-gray-300">
                            <option value="">-- Pilih Anggota --</option>

                            @foreach($anggotas as $anggota)

                                <option value="{{ $anggota->id }}">
                                    {{ $anggota->nama }}
                                </option>

                            @endforeach

                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block font-semibold mb-2">
                            Tanggal
                        </label>
                        <input
                            type="date"
                            name="tanggal"
                            value="{{ now()->format('Y-m-d') }}"
                            class="w-full rounded-lg border-gray-300">
                    </div>

                    <div class="mb-4">
                        <label class="block font-semibold mb-2">
                            Bulan
                        </label>
                        <select name="bulan" class="w-full rounded-lg border-gray-300">
                            @foreach([
                            'Januari','Februari','Maret','April','Mei','Juni',
                            'Juli','Agustus','September','Oktober','November','Desember'
                            ] as $bulan)

                                <option>{{ $bulan }}</option>

                            @endforeach

                        </select>

                    </div>

                    <div class="mb-4">
                        <label class="block font-semibold mb-2">
                            Tahun
                        </label>
                        <input
                            type="number"
                            name="tahun"
                            value="{{ date('Y') }}"
                            class="w-full rounded-lg border-gray-300">

                    </div>

                    <div class="mb-4">
                        <label class="block font-semibold mb-2">
                            Nominal
                        </label>
                        <input
                            type="number"
                            name="jumlah"
                            class="w-full rounded-lg border-gray-300">
                    </div>

                    <div class="mb-5">
                        <label class="block font-semibold mb-2">
                            Status
                        </label>
                        <select name="status" class="w-full rounded-lg border-gray-300">
                            <option value="belum lunas"> Belum Lunas </option>
                            <option value="lunas"> Lunas </option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block font-semibold mb-2">
                            Bukti Pembayaran
                        </label>

                        <input
                            type="file"
                            name="bukti"
                            accept=".jpg,.jpeg,.png,.pdf"
                            class="w-full border-gray-300">
                    </div>

                    <div class="flex justify-end gap-3">
                        <a
                            href="{{ route('pembayaran-kas.index') }}"
                            class="bg-gray-500 text-white px-5 py-2 rounded-lg">
                            Kembali
                        </a>

                        <button
                            class="bg-blue-600 text-white px-5 py-2 rounded-lg">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
