<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\PengunjungController;
use App\Http\Controllers\RekAprioriController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\RoleMiddleware;

use App\Http\Controllers\AdminHomeController;
use App\Http\Controllers\AdminBookController;
use App\Http\Controllers\AdminPengunjungController;
use App\Http\Controllers\AdminRekAprioriController;
use App\Http\Controllers\AdminUserController;

// Route untuk halaman login
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

// // Route untuk dashboard
// Route::get('/', function () {
//     return view('pages.dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// <=================================== ADMIN PENGUNJUNG ==============================================>

Route::get('/dashboard', [HomeController::class, 'index'])
    ->middleware(['auth', 'verified', RoleMiddleware::class . ':pengunjung'])
    ->name('dashboard');

// Route untuk buku
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/buku', [BookController::class, 'index'])->name('buku');
    Route::get('/buku/create', [BookController::class, 'create'])->name('buku.create');
    Route::post('/buku', [BookController::class, 'store'])->name('buku.store');
    Route::get('/buku/{book}/edit', [BookController::class, 'edit'])->name('buku.edit');
    Route::put('/buku/{book}', [BookController::class, 'update'])->name('buku.update');
    Route::delete('/buku/{id}', [BookController::class, 'destroy'])->name('buku.destroy');
    Route::post('/buku/import', [BookController::class, 'import'])->name('buku.import');
    Route::post('/buku/pinjam', [BookController::class, 'pinjam'])->name('buku.pinjam');
    Route::put('/buku/kembalikan/{id}', [BookController::class, 'kembalikan'])->name('buku.kembalikan');
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

// Route Apriori
Route::get('/rek-apriori', [RekAprioriController::class, 'index'])->name('rek-apriori');
Route::post('/rek-apriori/process', [RekAprioriController::class, 'process'])->name('rek-apriori.process');

// Route untuk profile management
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Route untuk manajemen user
Route::middleware(['auth', 'verified', RoleMiddleware::class . ':admin'])->group(function () {
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/{users}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{users}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{users}', [UserController::class, 'destroy'])->name('users.destroy');
});

// <=================================== ADMIN ROUTE ==============================================>

Route::get('/admin/dashboard', [AdminHomeController::class, 'index'])
    ->middleware(['auth', 'verified', RoleMiddleware::class . ':admin'])
    ->name('admin.dashboard');

// Route untuk buku
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/admin/buku', [AdminBookController::class, 'index'])->name('admin.buku');
    Route::get('/admin/buku/create', [AdminBookController::class, 'create'])->name('admin.buku.create');
    Route::post('/admin/buku', [AdminBookController::class, 'store'])->name('admin.buku.store');
    Route::get('/admin/buku/{book}/edit', [AdminBookController::class, 'edit'])->name('admin.buku.edit');
    Route::put('/admin/buku/{book}', [AdminBookController::class, 'update'])->name('admin.buku.update');
    Route::delete('/admin/buku/{id}', [AdminBookController::class, 'destroy'])->name('admin.buku.destroy');
    Route::post('/admin/buku/import', [AdminBookController::class, 'import'])->name('admin.buku.import');
    Route::post('/admin/buku/pinjam', [AdminBookController::class, 'pinjam'])->name('admin.buku.pinjam');
    Route::put('/admin/buku/kembalikan/{id}', [AdminBookController::class, 'kembalikan'])->name('admin.buku.kembalikan');
});

// Route untuk pengunjung
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/admin/pengunjung', [AdminPengunjungController::class, 'index'])->name('admin.pengunjung');
    Route::get('/admin/pengunjung/create', [AdminPengunjungController::class, 'create'])->name('admin.pengunjung.create');
    Route::post('/admin/pengunjung', [AdminPengunjungController::class, 'store'])->name('admin.pengunjung.store');
    Route::get('/admin/pengunjung/{pengunjung}/edit', [AdminPengunjungController::class, 'edit'])->name('admin.pengunjung.edit');
    Route::put('/admin/pengunjung/{pengunjung}', [AdminPengunjungController::class, 'update'])->name('admin.pengunjung.update');
    Route::delete('/admin/pengunjung/{pengunjung}', [AdminPengunjungController::class, 'destroy'])->name('admin.pengunjung.destroy');
});

// Route Apriori
Route::get('/admin/rek-apriori', [AdminRekAprioriController::class, 'index'])->name('admin.rek-apriori');
Route::post('/admin/rek-apriori/process', [AdminRekAprioriController::class, 'process'])->name('admin.rek-apriori.process');

// Route untuk manajemen user
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/admin/users', [AdminUserController::class, 'index'])->name('admin.users.index');
    Route::get('/admin/users/create', [AdminUserController::class, 'create'])->name('admin.users.create');
    Route::post('/admin/users', [AdminUserController::class, 'store'])->name('admin.users.store');
    Route::get('/admin/users/{users}/edit', [AdminUserController::class, 'edit'])->name('admin.users.edit');
    Route::put('/admin/users/{users}', [AdminUserController::class, 'update'])->name('admin.users.update');
    Route::delete('/admin/users/{users}', [AdminUserController::class, 'destroy'])->name('admin.users.destroy');
});

// Include file auth routes
require __DIR__ . '/auth.php';
