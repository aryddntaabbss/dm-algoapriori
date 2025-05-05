<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Pengunjung;
use App\Models\User;

class AdminHomeController extends Controller
{
    public function index()
    {
        $bookCount = Book::count();
        $pengunjungCount = User::count();
        $peminjaman = Pengunjung::with('user')->get();

        return view('admin.dashboard', compact('bookCount', 'pengunjungCount', 'peminjaman'));
    }
}
