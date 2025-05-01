<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Pengunjung;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\BooksImport;

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

        // Perbaikan: Menggunakan langsung $book
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
        if (!auth()->check()) {
            return redirect()->back()->with('error', 'Anda harus login untuk meminjam buku.');
        }

        DB::beginTransaction();
        try {
            $book = Book::where('judul', $request->judul_buku)->firstOrFail();

            // Cek apakah stok masih tersedia sebelum meminjam
            if ($book->stok <= 0) {
                return redirect()->back()->with('error', 'Stok buku habis, tidak bisa dipinjam.');
            }

            // Kurangi stok menggunakan decrement
            $book->decrement('stok', 1);

            // Simpan data peminjaman
            Pengunjung::create([
                'user_id' => auth()->user()->id,
                'nama' => auth()->user()->name,
                'nomor_tlp' => auth()->user()->nomor_tlp ?? 'Tidak tersedia',
                'jenjang' => auth()->user()->jenjang ?? 'Tidak tersedia',
                'judul_buku' => $book->judul,
                'kode_buku' => $book->kode_buku,
                'tanggal_peminjaman' => now()->toDateString(),
                'kategori' => 'Pinjam',
            ]);

            DB::commit();
            return redirect()->back()->with('success', 'Buku berhasil dipinjam.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan saat meminjam buku.');
        }
    }


    public function kembalikan($id)
    {
        $peminjaman = Pengunjung::findOrFail($id);

        // Pastikan hanya user yang meminjam yang bisa mengembalikan
        if ($peminjaman->user_id !== auth()->user()->id) {
            return redirect()->back()->with('error', 'Anda tidak bisa mengembalikan buku ini!');
        }

        // Ambil buku berdasarkan judul
        $book = Book::where('judul', $peminjaman->judul_buku)->first();

        if ($book) {
            // Tambahkan stok buku
            $book->increment('stok', 1);
        }

        // Perbarui status menjadi dikembalikan
        $peminjaman->update([
            'tanggal_pengembalian' => now()->toDateString(),
            'kategori' => 'Kembalikan',
        ]);

        return redirect()->back()->with('success', 'Buku berhasil dikembalikan.');
    }
}
