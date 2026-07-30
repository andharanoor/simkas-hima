<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Tambah Kas Keluar
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow rounded-lg p-6 mt-6">

                @if($errors->any())

                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-lg mb-5">
                    <h3 class="font-bold mb-2">
                        Terjadi kesalahan:
                    </h3>

                    <ul class="list-disc list-inside">

                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach

                    </ul>

                </div>

                @endif

                <form action="{{ route('kas-keluar.store') }}"
                      method="POST"
                      enctype="multipart/form-data">

                    @csrf
                    <div class="mb-4">
                        <label class="block mb-2 font-semibold">
                            Tanggal
                        </label>

                        <input
                            type="date"
                            name="tanggal"
                            value="{{ old('tanggal', now()->format('Y-m-d')) }}"
                            max="{{ now()->format('Y-m-d') }}"
                            class="w-full rounded-lg border-gray-300">
                    </div>

                    <div class="mb-4">
                        <label class="block mb-2 font-semibold">
                            Kategori
                        </label>

                        <select name="kategori"
                            class="w-full rounded-lg border-gray-300">

                            <option value="">-- Pilih Kategori --</option>
                            <option value="ATK">ATK</option>
                            <option value="Konsumsi">Konsumsi</option>
                            <option value="Transportasi">Transportasi</option>
                            <option value="Cetak Banner">Cetak Banner</option>
                            <option value="Dekorasi">Dekorasi</option>
                            <option value="Honor Narasumber">Honor Narasumber</option>
                            <option value="Lain-lain">Lain-lain</option>
                       </select>
                    </div>

                    <div class="mb-4">
                        <label class="block mb-2 font-semibold">
                            Nominal (Rp)
                        </label>
                            <input
                                type="number"
                                name="jumlah"
                                class="w-full rounded-lg border-gray-300">
                    </div>

                    <div class="mb-4">
                        <label class="block mb-2 font-semibold">
                            Keterangan
                        </label>

                        <textarea
                        name="keterangan"
                        class="w-full rounded-lg border-gray-300"></textarea>
                    </div>

                    <div class="mb-6">
                        <label class="block mb-2 font-semibold">
                                Bukti
                        </label>

                        <input
                            type="file"
                            name="bukti"
                            class="w-full">
                    </div>

                    <div class="flex justify-end gap-3">
                        <a
                            href="{{ route('kas-keluar.index') }}"
                            class="bg-gray-500 text-white px-5 py-2 rounded-lg">
                            Kembali
                        </a>

                        <button
                            type="submit"
                            class="bg-blue-600 text-white px-5 py-2 rounded-lg">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

