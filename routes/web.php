<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AnggotaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth'])
    ->name('dashboard');

// TEST MIDDLEWARE ROLE
Route::get('/bendahara', function () {
    return "Halaman Bendahara";
})->middleware(['auth', 'role:bendahara']);

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');

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
    
});

require __DIR__.'/auth.php';
