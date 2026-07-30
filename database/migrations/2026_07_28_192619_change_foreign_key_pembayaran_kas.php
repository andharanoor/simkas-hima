<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pembayaran_kas', function (Blueprint $table) {

            // Hapus foreign key lama
            $table->dropForeign(['anggota_id']);

            // Ubah kolom agar boleh NULL
            $table->foreignId('anggota_id')
                ->nullable()
                ->change();

            // Buat foreign key baru
            $table->foreign('anggota_id')
                ->references('id')
                ->on('anggotas')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('pembayaran_kas', function (Blueprint $table) {

            $table->dropForeign(['anggota_id']);

            $table->foreignId('anggota_id')
                ->nullable(false)
                ->change();

            $table->foreign('anggota_id')
                ->references('id')
                ->on('anggotas')
                ->restrictOnDelete();
        });
    }
};
