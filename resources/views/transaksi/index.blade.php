<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-2xl">
            Riwayat Transaksi
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow rounded-lg p-6">
                <form method="GET" class="mb-3">
                    <div class="flex items-end gap-3">
                        <div>
                            <label class="block text-sm font-semibold mb-1">
                                Dari Tanggal
                            </label>

                            <input type="date"name="dari"
                                value="{{ request('dari') }}"
                                class="border rounded-lg px-3 py-2 w-48">
                        </div>

                        <div>
                            <label class="block text-sm font-semibold mb-1">
                                Sampai Tanggal
                            </label>

                            <input 
                                type="date" 
                                name="sampai"
                                value="{{ request('sampai') }}"
                                class="border rounded-lg px-3 py-2 w-48">
                        </div>

                        <button type="submit"
                            class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 inline-flex items-center">
                            Filter
                        </button>

                        <a href="{{ route('transaksi.index') }}"
                            class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 inline-flex items-center">
                            Reset
                        </a>
                    </div>
                </form>

                <table class="min-w-full border text-center">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="border px-4 py-2">Tanggal</th>
                            <th class="border px-4 py-2">Keterangan</th>
                            <th class="border px-4 py-2">Jumlah</th>
                            <th class="border px-4 py-2">Jenis</th>
                        </tr>
                    </thead>

                    <tbody>

                        @foreach($transaksi as $item)

                        <tr>
                            <td class="border px-4 py-2">
                                {{ $item['tanggal'] }}
                            </td>

                            <td class="border px-4 py-2">
                                {{ $item['keterangan'] }}
                            </td>

                             <td class="border px-4 py-2">
                                Rp {{ number_format($item['jumlah'],0,',','.') }}
                            </td>

                            <td class="border px-4 py-2">
                                {{ $item['jenis'] }}
                            </td>
                        </tr>

                        @endforeach

                    </tbody>

                </table>


            </div>

        </div>
    </div>
</x-app-layout>
