<?php

use App\Http\Controllers\PasienController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RiwayatMedisController;
use App\Http\Controllers\TempatBerobatController;
use App\Models\Pasien;
use App\Models\Pendaftaran;
use App\Models\TempatBerobat;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return redirect()->route('login');
});

// Cari bagian ini di web.php Anda:
Route::get('/dashboard', function () {
    return Inertia::render('Dashboard', [
        'totalPasien' => Pasien::count(),
        'totalPraktik' => TempatBerobat::count(), // Sesuaikan dengan nama Model Tempat Berobat Anda
        'totalPendaftaran' => Pendaftaran::count(), // Sesuaikan jika ini diambil dari Pendaftaran/Riwayat
        'recentRegistrations' => Pasien::latest()->take(5)->get(),
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/pasien', [PasienController::class, 'index'])->name('pasien.index');
    Route::get('/pasien/create', [PasienController::class, 'create'])->name('pasien.create');
    Route::post('/pasien', [PasienController::class, 'store'])->name('pasien.store');
    Route::delete('/pasien/{pasien}', [PasienController::class, 'destroy'])->name('pasien.destroy');
    Route::get('/pasien/{pasien}/edit', [PasienController::class, 'edit'])->name('pasien.edit');
    Route::put('/pasien/{pasien}', [PasienController::class, 'update'])->name('pasien.update');
});

Route::middleware(['auth', 'verified'])->group(function () {
    // Rute Pasien yang sudah ada...

    // Rute Master Tempat Berobat
    Route::get('/tempat-berobat', [TempatBerobatController::class, 'index'])->name('tempat.index');
    Route::get('/tempat-berobat/create', [TempatBerobatController::class, 'create'])->name('tempat.create');
    Route::post('/tempat-berobat', [TempatBerobatController::class, 'store'])->name('tempat.store');
    Route::delete('/tempat-berobat/{tempatBerobat}', [TempatBerobatController::class, 'destroy'])->name('tempat.destroy');
    Route::get('/tempat-berobat/{tempatBerobat}/edit', [TempatBerobatController::class, 'edit'])->name('tempat.edit');
    Route::put('/tempat-berobat/{tempatBerobat}', [TempatBerobatController::class, 'update'])->name('tempat.update');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/pendaftaran', [PendaftaranController::class, 'index'])->name('pendaftaran.index');
    Route::get('/pendaftaran/create', [PendaftaranController::class, 'create'])->name('pendaftaran.create');
    Route::post('/pendaftaran', [PendaftaranController::class, 'store'])->name('pendaftaran.store');
    Route::delete('/pendaftaran/{pendaftaran}', [PendaftaranController::class, 'destroy'])->name('pendaftaran.destroy');
    Route::get('/pendaftaran/{pendaftaran}/edit', [PendaftaranController::class, 'edit'])->name('pendaftaran.edit');
    Route::put('/pendaftaran/{pendaftaran}', [PendaftaranController::class, 'update'])->name('pendaftaran.update');
});
Route::middleware(['auth', 'verified'])->group(function () {
    // ... route pendaftaran atau dashboard kamu yang lain ...

    // Route untuk menampilkan daftar riwayat (Index)
    Route::get('/riwayat-medis', [RiwayatMedisController::class, 'index'])
        ->name('riwayat.index');

    // Route untuk menampilkan detail satu riwayat (Show)
    Route::get('/riwayat-medis/{id}', [RiwayatMedisController::class, 'show'])
        ->name('riwayat.show');

    // Route untuk menghapus (Destroy) jika diperlukan
    Route::delete('/riwayat-medis/{id}', [RiwayatMedisController::class, 'destroy'])
        ->name('riwayat.destroy');
});
