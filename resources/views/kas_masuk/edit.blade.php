<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Kas Masuk
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow rounded-lg p-6 mt-6">
                <form action="{{ route('kas-masuk.update', $kasMasuk->id) }}" method="POST" enctype="multipart/form-data">

                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label>Tanggal</label>
                        <input type="date"
                               name="tanggal"
                               value="{{ old('tanggal', $kasMasuk->tanggal) }}"
                               max="{{ now()->format('Y-m-d') }}"
                               class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    </div>

                    <div class="mb-4">

                        <label>Sumber</label>

                        <select
                            name="sumber"
                            class="w-full rounded-lg border-gray-300">

                            <option value="Kas Bulanan"
                                    {{ $kasMasuk->sumber=='Kas Bulanan'?'selected':'' }}>
                                    Kas Bulanan
                            </option>
                            <option value="Iuran Anggota"
                                    {{ $kasMasuk->sumber=='Iuran Anggota'?'selected':'' }}>
                                    Iuran Anggota
                            </option>
                            <option value="Donasi"
                                    {{ $kasMasuk->sumber=='Donasi'?'selected':'' }}>
                                    Donasi
                            </option>
                            <option value="Sponsor"
                                    {{ $kasMasuk->sumber=='Sponsor'?'selected':'' }}>
                                    Sponsor
                            </option>
                            <option value="Penjualan Merchandise"
                                    {{ $kasMasuk->sumber=='Penjualan Merchandise'?'selected':'' }}>
                                    Penjualan Merchandise
                            </option>
                            <option value="Bazar"
                                    {{ $kasMasuk->sumber=='Bazar'?'selected':'' }}>
                                    Bazar
                            </option>
                            <option value="Lain-lain"
                                    {{ $kasMasuk->sumber=='Lain-lain'?'selected':'' }}>
                                    Lain-lain
                            </option>

                        </select>
                    </div>

                    <div class="mb-4">
                        <label>Nominal (Rp)</label>
                        <input type="number"
                               name="jumlah"
                               value="{{ old('jumlah',$kasMasuk->jumlah) }}"
                               class="w-full rounded-lg border-gray-300">
                    </div>

                    <div class="mb-4">
                        <label>Keterangan</label>
                        <textarea name="keterangan"
                                class="w-full rounded-lg border-gray-300">{{ old('keterangan',$kasMasuk->keterangan) }}</textarea>
                    </div>

                    <div class="mb-6">
                        <label>Bukti</label>

                        @if($kasMasuk->bukti)

                        <img src="{{ asset('storage/'.$kasMasuk->bukti) }}"
                             class="w-40 rounded mb-3">

                        @endif

                        <input type="file" 
                               name="bukti"
                               class="w-full">
                    </div>

                    <div class="flex justify-end gap-3">
                        <a href="{{ route('kas-masuk.index') }}"
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
