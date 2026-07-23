<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Tambah Anggota
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow rounded-lg p-6">
                <form action="{{ route('anggota.store') }}" method="POST">
                    @csrf

                     @if ($errors->any())
                        <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
                            <ul class="list-disc ml-5">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="mb-6">
                        <label class="block mb-2 font-semibold text-gray-700">Nama</label>
                        <input type="text"
                               name="nama"
                               class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                               value="{{ old('nama') }}">
                    </div>

                    <div class="mb-6">
                        <label class="block mb-2 font-semibold text-gray-700">Username</label>
                        <input type="text"
                               name="username"
                               class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                               value="{{ old('username') }}">
                    </div>

                    <div class="mb-6">
                        <label class="block mb-2 font-semibold text-gray-700">Password</label>
                        <input type="password"
                               name="password"
                               class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    </div>

                    <div class="mb-6">
                        <label class="block mb-2 font-semibold text-gray-700">NIM</label>
                        <input type="text"
                               name="nim"
                               class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                               value="{{ old('nim') }}">
                    </div>

                    <div class="mb-6">
                        <label class="block mb-2 font-semibold text-gray-700">Jurusan</label>
                        <input type="text"
                               name="jurusan"
                               class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                               value="{{ old('jurusan') }}">
                    </div>

                    <div class="mb-6">
                        <label class="block mb-2 font-semibold text-gray-700">No HP</label>
                        <input type="text"
                               name="no_hp"
                               class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                               value="{{ old('no_hp') }}">
                    </div>

                    <div class="mb-6">
                        <label class="block mb-2 font-semibold text-gray-700">Status</label>
                        <select name="status"
                                class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            <option value="">-- Pilih Status --</option>
                            <option value="aktif">Aktif</option>
                            <option value="tidak aktif">Tidak Aktif</option>
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
