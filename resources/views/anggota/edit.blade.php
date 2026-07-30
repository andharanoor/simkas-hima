<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Anggota
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow rounded-lg p-6">
                <form action="{{ route('anggota.update', $anggota->id) }}" method="POST">
                @csrf
                @method('PUT')

                    <div class="mb-6">
                        <label class="block mb-2 font-semibold text-gray-700">Nama</label>
                        <input type="text"
                               name="nama"
                               class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                               value="{{ old('nama', $anggota->nama) }}">
                    </div>

                    <div class="mb-6">
                        <label class="block mb-2 font-semibold text-gray-700">Username</label>
                        <input type="text"
                               name="username"
                               class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                               value="{{ old('username', $anggota->user->username) }}">
                    </div>

                    <div class="mb-6">
                        <label class="block mb-2 font-semibold text-gray-700">
                            Password Baru
                        </label>

                        <input
                            type="password"
                            name="password"
                            placeholder="Kosongkan jika tidak ingin mengubah password"
                            class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">

                        <p class="text-sm text-gray-500 mt-1">
                            Isi hanya jika ingin mengganti password anggota.
                        </p>
                    </div>

                    <div class="mb-6">
                        <label class="block mb-2 font-semibold text-gray-700">NIM</label>
                        <input type="text"
                               name="nim"
                               class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                               value="{{ old('nim', $anggota->nim) }}">
                    </div>

                    <div class="mb-6">
                        <label class="block mb-2 font-semibold text-gray-700">Jurusan</label>
                        <input type="text"
                               name="jurusan"
                               class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                               value="{{ old('jurusan', $anggota->jurusan) }}">
                    </div>

                    <div class="mb-6">
                        <label class="block mb-2 font-semibold text-gray-700">No HP</label>
                        <input type="text"
                               name="no_hp"
                               minlength="11"
                               maxlength="13"
                               pattern="[0-9]{11,13}"
                               oninput="this.value=this.value.replace(/[^0-9]/g,'')"
                               class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                               value="{{ old('no_hp', $anggota->no_hp) }}">
                    </div>

                    <div class="mb-6">
                        <label class="block mb-2 font-semibold text-gray-700">
                            Status
                        </label>

                        <select
                            name="status"
                            class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">

                            <option value="aktif"
                                {{ $anggota->status == 'aktif' ? 'selected' : '' }}>
                                Aktif
                            </option>

                            <option value="tidak aktif"
                                {{ $anggota->status == 'tidak aktif' ? 'selected' : '' }}>
                                Tidak Aktif
                            </option>
                        </select>
                    </div>

                    <div class="flex justify-end items-center gap-3 mt-8">
                        <a href="{{ route('anggota.index') }}"
                        class="px-5 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600">
                            Kembali
                        </a>

                        <button type="submit"
                                class="px-5 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</x-app-layout>
