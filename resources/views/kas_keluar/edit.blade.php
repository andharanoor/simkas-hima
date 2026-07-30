<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Kas Keluar
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

                <form action="{{ route('kas-keluar.update',$kasKeluar->id) }}"
                    method="POST"
                    enctype="multipart/form-data">

                    @csrf
                    @method('PUT')

                    <div class="mb-5">
                        <label class="block mb-2 font-semibold">
                            Tanggal
                        </label>

                        <input
                            type="date"
                            name="tanggal"
                            value="{{ old('tanggal',$kasKeluar->tanggal) }}"
                            max="{{ now()->format('Y-m-d') }}"
                            class="w-full rounded-lg border-gray-300">
                    </div>

                    <div class="mb-5">
                        <label class="block mb-2 font-semibold">
                            Kategori
                        </label>
                        <select
                            name="kategori"
                            class="w-full rounded-lg border-gray-300">
                            <option value="ATK"
                                {{ $kasKeluar->kategori=='ATK' ? 'selected':'' }}>
                                ATK
                            </option>
                            <option value="Konsumsi"
                                {{ $kasKeluar->kategori=='Konsumsi' ? 'selected':'' }}>
                                Konsumsi
                            </option>
                            <option value="Transportasi"
                                {{ $kasKeluar->kategori=='Transportasi' ? 'selected':'' }}>
                                Transportasi
                            </option>
                            <option value="Cetak Banner"
                                {{ $kasKeluar->kategori=='Cetak Banner' ? 'selected':'' }}>
                                Cetak Banner
                            </option>
                            <option value="Dekorasi"
                                {{ $kasKeluar->kategori=='Dekorasi' ? 'selected':'' }}>
                                Dekorasi
                            </option>
                            <option value="Honor Narasumber"
                                {{ $kasKeluar->kategori=='Honor Narasumber' ? 'selected':'' }}>
                                Honor Narasumber
                            </option>
                            <option value="Lain-lain"
                                {{ $kasKeluar->kategori=='Lain-lain' ? 'selected':'' }}>
                                Lain-lain
                            </option>
                        </select>
                    </div>

                    <div class="mb-5">
                        <label class="block mb-2 font-semibold">
                            Nominal (Rp)
                        </label>

                        <input
                            type="number"
                            name="jumlah"
                            value="{{ old('jumlah',$kasKeluar->jumlah) }}"
                            class="w-full rounded-lg border-gray-300">
                    </div>

                    <div class="mb-5">
                        <label class="block mb-2 font-semibold">
                            Keterangan
                        </label>

                        <textarea
                        name="keterangan"
                        class="w-full rounded-lg border-gray-300">{{ old('keterangan',$kasKeluar->keterangan) }}</textarea>
                    </div>

                    <div class="mb-5">

                        <label class="block mb-2 font-semibold">
                            Bukti
                        </label>

                        @if($kasKeluar->bukti)

                        <img
                            src="{{ asset('storage/'.$kasKeluar->bukti) }}"
                            class="w-40 rounded mb-3">

                        @endif

                        <input
                            type="file"
                            name="bukti">
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

