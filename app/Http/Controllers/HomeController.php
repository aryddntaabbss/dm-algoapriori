<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Pengunjung;

class HomeController extends Controller
{
    public function index()
    {
        // Menghitung jumlah buku
        $bookCount = Book::count();

        // Menghitung jumlah pengunjung dengan kategori "peminjam"
        $pengunjungCount = Pengunjung::whereRaw('LOWER(kategori) = ?', ['peminjaman'])->count();

        // Mengirim data ke view
        return view('pages.dashboard', [
            'bookCount' => $bookCount,
            'pengunjungCount' => $pengunjungCount
        ]);
    }
}
