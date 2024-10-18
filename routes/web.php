<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\PengunjungController;

// Route untuk halaman login
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

// Route untuk dashboard
Route::get('/', function () {
    return view('pages.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Route untuk buku
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/buku', [BookController::class, 'index'])->name('buku');
    Route::get('/buku/create', [BookController::class, 'create'])->name('buku.create');
    Route::post('/buku', [BookController::class, 'store'])->name('buku.store');
    Route::get('/buku/{book}/edit', [BookController::class, 'edit'])->name('buku.edit');
    Route::put('/buku/{book}', [BookController::class, 'update'])->name('buku.update');
    Route::delete('/buku/{id}', [BookController::class, 'destroy'])->name('buku.destroy');
});

// Route untuk pengunjung
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/pengunjung', [PengunjungController::class, 'index'])->name('pengunjung');
    Route::get('/pengunjung/create', [PengunjungController::class, 'create'])->name('pengunjung.create');
    Route::post('/pengunjung', [PengunjungController::class, 'store'])->name('pengunjung.store');
    Route::get('/pengunjung/{pengunjung}/edit', [PengunjungController::class, 'edit'])->name('pengunjung.edit');
    Route::put('/pengunjung/{pengunjung}', [PengunjungController::class, 'update'])->name('pengunjung.update');
    Route::delete('/pengunjung/{pengunjung}', [PengunjungController::class, 'destroy'])->name('pengunjung.destroy');
});

// Route untuk profile management
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Include file auth routes
require __DIR__ . '/auth.php';
