<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Pengunjung;

class HomeController extends Controller
{
    public function index()
    {
        // Menghitung jumlah buku
        $bookCount = Book::count(); // Jumlah buku
        $peminjaman = Pengunjung::where('user_id', auth()->id())->get(); // Buku yang dipinjam oleh user yang login

        return view('pages.dashboard', compact('bookCount', 'peminjaman'));
    }
}
