<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use App\Imports\BooksImport;
use Carbon\Carbon;
use App\Models\Book;
use App\Models\Pengunjung;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::all(); // Ambil semua buku
        $pengunjungs = Pengunjung::all(); // Ambil semua data peminjaman

        return view('pages.pengelolaan-buku.buku', compact('books', 'pengunjungs'));
    }

    public function create()
    {
        return view('pages.pengelolaan-buku.tambah');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'kode_buku' => 'required|string|max:255|unique:books,kode_buku',
            'judul' => 'required|string|max:255',
            'pengarang' => 'required|string|max:255',
            'kategori_buku' => 'required|string|max:255',
            'stok' => 'required|integer|min:1',
            'tahun_terbit' => 'required|integer',
        ]);

        Book::create($validatedData);

        return redirect()->route('buku')->with('success', 'Buku berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $book = Book::findOrFail($id);
        return view('pages.pengelolaan-buku.edit', compact('book'));
    }

    public function update(Request $request, Book $book)
    {
        $validatedData = $request->validate([
            'judul' => 'required|string|max:255',
            'pengarang' => 'required|string|max:255',
            'tahun_terbit' => 'required|integer',
            'kategori_buku' => 'required|string|max:255',
            'stok' => 'required|integer|min:0',
            'kode_buku' => 'required|string|max:100|unique:books,kode_buku,' . $book->id,
        ]);

        $book->update($validatedData);

        return redirect()->route('buku')->with('success', 'Buku berhasil diperbarui.');
    }

    public function import(Request $request)
    {
        $import = new BooksImport;
        Excel::import($import, $request->file('file'));

        $duplicates = $import->getDuplicateBooks();

        if (count($duplicates) > 0) {
            return redirect()->back()->with('warning', 'Buku berikut sudah ada di database: ' . implode(', ', $duplicates));
        }

        return redirect()->route('buku')->with('success', 'Buku berhasil diimport.');
    }

    public function destroy($id)
    {
        $book = Book::findOrFail($id);
        $book->delete();

        return redirect()->route('buku')->with('success', 'Buku berhasil dihapus.');
    }

    public function pinjam(Request $request)
    {
        $request->validate([
            'judul_buku' => 'required|string',
        ]);

        $user = Auth::user();

        // Cari buku berdasarkan kode_buku
        $book = Book::where('kode_buku', $request->kode_buku)->first();

        if (!$book || $book->stok <= 0) {
            return redirect()->back()->with('error', 'Buku tidak tersedia untuk dipinjam.');
        }

        // Kurangi stok buku
        $book->decrement('stok');

        // Simpan data peminjaman
        $tanggalPengembalian = Carbon::now()->addDays(7); // Batas pengembalian 7 hari
        Pengunjung::create([
            'user_id' => $user->id,
            'nama' => $user->name,
            'nomor_tlp' => $user->nomor_tlp,
            'judul_buku' => $request->judul_buku,
            'kode_buku' => $request->kode_buku,
            'tanggal_peminjaman' => now()->toDateString(),
            'tanggal_pengembalian' => $tanggalPengembalian->toDateString(),
            'kategori' => 'Pinjam',
        ]);

        // Format tanggal pengembalian
        $formattedDate = $tanggalPengembalian->isoFormat('dddd, DD/MM/YYYY');

        return redirect()->back()->with('success', 'Buku berhasil dipinjam. Harap dikembalikan sebelum ' . $formattedDate);
    }

    public function kembalikan($id)
    {
        $peminjaman = Pengunjung::findOrFail($id);

        // Cek apakah tanggal_pengembalian ada
        if (!$peminjaman->tanggal_pengembalian) {
            return redirect()->back()->with('error', 'Tanggal pengembalian tidak ditemukan untuk peminjaman ini.');
        }

        // Cari buku berdasarkan kode_buku
        $book = Book::where('kode_buku', $peminjaman->kode_buku)->first();

        if ($book) {
            // Tambah stok buku
            $book->increment('stok');
        } else {
            return redirect()->back()->with('error', 'Buku tidak ditemukan di database.');
        }

        // Format tanggal pengembalian
        $formattedDate = Carbon::parse($peminjaman->tanggal_pengembalian)->isoFormat('dddd, DD/MM/YYYY');

        // Cek apakah pengembalian terlambat
        if (now()->greaterThan($peminjaman->tanggal_pengembalian)) {
            return redirect()->back()->with('warning', 'Buku dikembalikan terlambat! Batas pengembalian adalah ' . $formattedDate);
        }

        // Update status peminjaman
        $peminjaman->update([
            'kategori' => 'Kembalikan',
        ]);

        return redirect()->back()->with('success', 'Buku berhasil dikembalikan dan stok telah diperbarui.');
    }
}
