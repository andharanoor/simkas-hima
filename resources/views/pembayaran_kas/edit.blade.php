<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Pembayaran Kas
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

                <form action="{{ route('pembayaran-kas.update',$pembayaranKas->id) }}"
                      method="POST" enctype="multipart/form-data">

                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="block mb-2 font-semibold">
                            Anggota
                        </label>
                        <select name="anggota_id"
                                class="w-full rounded-lg border-gray-300">

                            @foreach($anggotas as $anggota)

                                <option
                                    value="{{ $anggota->id }}"
                                    {{ $anggota->id == $pembayaranKas->anggota_id ? 'selected' : '' }}>
                                    {{ $anggota->nama }}
                                </option>

                            @endforeach

                        </select>

                    </div>

                    <div class="mb-4">
                        <label class="block mb-2 font-semibold">
                            Tanggal
                        </label>

                        <input
                            type="date"
                            name="tanggal"
                            value="{{ old('tanggal',$pembayaranKas->tanggal) }}"
                            class="w-full rounded-lg border-gray-300">
                    </div>

                    <div class="mb-4">
                        <label class="block mb-2 font-semibold">
                            Bulan
                        </label>

                        <input
                            type="text"
                            name="bulan"
                            value="{{ old('bulan',$pembayaranKas->bulan) }}"
                            class="w-full rounded-lg border-gray-300">
                    </div>

                    <div class="mb-4">
                        <label class="block mb-2 font-semibold">
                            Tahun
                        </label>

                        <input
                            type="number"
                            name="tahun"
                            value="{{ old('tahun',$pembayaranKas->tahun) }}"
                            class="w-full rounded-lg border-gray-300">
                    </div>

                    <div class="mb-4">
                        <label class="block mb-2 font-semibold">
                            Nominal
                        </label>

                        <input
                            type="number"
                            name="jumlah"
                            value="{{ old('jumlah',$pembayaranKas->jumlah) }}"
                            class="w-full rounded-lg border-gray-300">
                    </div>

                    <div class="mb-6">
                        <label class="block mb-2 font-semibold">
                            Status
                        </label>

                        <select name="status" class="w-full rounded-lg border-gray-300">
                            <option value="lunas"
                                {{ $pembayaranKas->status=='lunas' ? 'selected':'' }}>
                                Lunas
                            </option>

                            <option value="belum lunas"
                                {{ $pembayaranKas->status=='belum lunas' ? 'selected':'' }}>
                                Belum Lunas
                            </option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block font-semibold mb-2">
                            Bukti Pembayaran
                        </label>

                        <input
                            type="file"
                            name="bukti"
                            class="w-full border rounded-lg p-2">

                        @error('bukti')
                            <p class="text-red-500 text-sm mt-1">
                                {{ $message }}
                            </p>
                        @enderror

                        @if($pembayaranKas->bukti)
                            <div class="mt-3">
                                <img src="{{ asset('storage/'.$pembayaranKas->bukti) }}"
                                    class="w-40 rounded shadow">
                            </div>
                        @endif
                    </div>

                    <div class="flex justify-end gap-3">
                        <a href="{{ route('pembayaran-kas.index') }}"
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