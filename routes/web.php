<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\KasMasukController;
use App\Http\Controllers\KasKeluarController;
use App\Http\Controllers\PembayaranKasController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\RekapController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth'])
    ->name('dashboard');

// TEST MIDDLEWARE
Route::get('/bendahara', function () {
    return "Halaman Bendahara";
})->middleware(['auth', 'role:bendahara']);

Route::get('/tes-create', function () {
    return 'BERHASIL';
});

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');

    Route::get('/transaksi', [TransaksiController::class,'index'])
        ->name('transaksi.index');
    
//Anggota
    Route::get('/anggota', [AnggotaController::class, 'index'])
    ->name('anggota.index');

    Route::get('/anggota/create', [AnggotaController::class, 'create'])
        ->name('anggota.create');

    Route::post('/anggota', [AnggotaController::class, 'store'])
        ->name('anggota.store');

    Route::get('/anggota/{anggota}', [AnggotaController::class, 'show'])
        ->name('anggota.show');

    Route::get('/anggota/{anggota}/edit', [AnggotaController::class, 'edit'])
        ->name('anggota.edit');

    Route::put('/anggota/{anggota}', [AnggotaController::class, 'update'])
        ->name('anggota.update');

    Route::delete('/anggota/{anggota}', [AnggotaController::class, 'destroy'])
        ->name('anggota.destroy');


// KAS MASUK
    Route::get('/kas-masuk', [KasMasukController::class, 'index'])
        ->name('kas-masuk.index');

    Route::middleware('role:bendahara')->group(function () {

        Route::get('/kas-masuk/create', [KasMasukController::class, 'create'])
            ->name('kas-masuk.create');

        Route::post('/kas-masuk', [KasMasukController::class, 'store'])
            ->name('kas-masuk.store');

        Route::get('/kas-masuk/{id}/edit', [KasMasukController::class, 'edit'])
            ->name('kas-masuk.edit');

        Route::put('/kas-masuk/{id}', [KasMasukController::class, 'update'])
            ->name('kas-masuk.update');

        Route::delete('/kas-masuk/{id}', [KasMasukController::class, 'destroy'])
            ->name('kas-masuk.destroy');
    });

// KAS KELUAR
    Route::get('/kas-keluar', [KasKeluarController::class, 'index'])
        ->name('kas-keluar.index');

    Route::middleware('role:bendahara')->group(function () {

            Route::get('/kas-keluar/create', [KasKeluarController::class, 'create'])
                ->name('kas-keluar.create');

            Route::post('/kas-keluar', [KasKeluarController::class, 'store'])
                ->name('kas-keluar.store');

            Route::get('/kas-keluar/{id}/edit', [KasKeluarController::class, 'edit'])
                ->name('kas-keluar.edit');

            Route::put('/kas-keluar/{id}', [KasKeluarController::class, 'update'])
                ->name('kas-keluar.update');

            Route::delete('/kas-keluar/{id}', [KasKeluarController::class, 'destroy'])
                ->name('kas-keluar.destroy');
    });  
    
    Route::get('/kas-keluar/{id}', [KasKeluarController::class, 'show'])
        ->name('kas-keluar.show');

// PEMBAYARAN KAS
    Route::get('/pembayaran-kas', [PembayaranKasController::class,'index'])
        ->name('pembayaran-kas.index'); 

    Route::middleware('role:bendahara')->group(function(){

        Route::get('/pembayaran-kas/create', [PembayaranKasController::class,'create'])
            ->name('pembayaran-kas.create');

        Route::post('/pembayaran-kas', [PembayaranKasController::class,'store'])
            ->name('pembayaran-kas.store');
        
        Route::get('/pembayaran-kas/{id}/edit', [PembayaranKasController::class,'edit'])
        ->name('pembayaran-kas.edit');

        Route::put('/pembayaran-kas/{id}', [PembayaranKasController::class,'update'])
            ->name('pembayaran-kas.update');

        Route::delete('/pembayaran-kas/{id}', [PembayaranKasController::class,'destroy'])
            ->name('pembayaran-kas.destroy');
    });

    Route::get('/pembayaran-kas/{id}', [PembayaranKasController::class,'show'])
    ->name('pembayaran-kas.show');   

// REKAP KAS
    Route::get('/rekap', [RekapController::class,'index'])
        ->name('rekap.index');
    
});

require __DIR__.'/auth.php';
