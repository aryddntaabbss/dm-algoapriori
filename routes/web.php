<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;

// Route untuk halaman login
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

// Route untuk dashboard
Route::get('/', function () {
    return view('pages.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Route untuk buku dengan menggunakan controller
Route::get('/buku', [BookController::class, 'index'])->middleware(['auth', 'verified'])->name('buku');
Route::get('/buku/create', [BookController::class, 'create'])->middleware(['auth', 'verified'])->name('buku.create');
Route::post('/buku', [BookController::class, 'store'])->middleware(['auth', 'verified'])->name('buku.store');
Route::get('/buku/{book}/edit', [BookController::class, 'edit'])->middleware(['auth', 'verified'])->name('buku.edit');
Route::put('/buku/{book}', [BookController::class, 'update'])->name('buku.update'); // Route untuk mengupdate buku
Route::delete('/buku/{id}', [BookController::class, 'destroy'])->name('buku.destroy'); // Route untuk hapus buku

// Route untuk profile management
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Include file auth routes
require __DIR__ . '/auth.php';
