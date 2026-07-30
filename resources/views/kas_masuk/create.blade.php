<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Tambah Kas Masuk
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow rounded-lg p-6 mt-6">
                <form action="{{ route('kas-masuk.store') }}" method="POST" enctype="multipart/form-data">

                    @csrf

                    @if ($errors->any())
                        <div class="mb-4 rounded-lg bg-red-100 border border-red-400 text-red-700 px-4 py-3">
                            <ul class="list-disc pl-5">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="mb-4">
                        <label>Tanggal</label>
                        <input type="date"
                               name="tanggal"
                               value="{{ old('tanggal', now()->format('Y-m-d')) }}"
                               max="{{ now()->format('Y-m-d') }}"
                               class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    </div>

                    <div class="mb-4">
                        <label class="block mb-2 font-semibold text-gray-700">
                               Sumber
                        </label>

                        <select
                            name="sumber"
                            class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">

                            <option value="">-- Pilih Sumber --</option>
                            <option value="Kas Bulanan">Kas Bulanan</option>
                            <option value="Iuran Anggota">Iuran Anggota</option>
                            <option value="Donasi">Donasi</option>
                            <option value="Sponsor">Sponsor</option>
                            <option value="Penjualan Merchandise">Penjualan Merchandise</option>
                            <option value="Bazar">Bazar</option>
                            <option value="Lain-lain">Lain-lain</option>

                        </select>
                    </div>

                    <div class="mb-4">
                        <label>Jumlah</label>
                        <input type="number"
                               name="jumlah"
                               class="w-full rounded-lg border-gray-300">
                    </div>
                    
                    <div class="mb-4">
                        <label>Keterangan</label>
                        <textarea 
                                name="keterangan"
                                class="w-full rounded-lg border-gray-300"></textarea>
                    </div>

                    <div class="mb-6">
                        <label>Bukti</label>
                        <input type="file"
                               name="bukti"
                               class="w-full">
                    </div>

                    <div class="flex justify-end gap-3">
                        <a href="{{ route('kas-masuk.index') }}" class="bg-gray-500 text-white px-5 py-2 rounded-lg">
                            Kembali
                        </a>

                        <button
                            type="submit" class="bg-blue-600 text-white px-5 py-2 rounded-lg">
                            Simpan
                        </button>

                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

