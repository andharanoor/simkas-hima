<x-app-layout>

    <div class="p-6">

        <h1 class="text-2xl font-bold">
            Dashboard Anggota
        </h1>

        <p class="mt-2">
            Selamat datang, {{ auth()->user()->nama }}
        </p>

        <div class="mt-5">
            <p>
                Role: {{ auth()->user()->role }}
            </p>
        </div>

    </div>

</x-app-layout>
