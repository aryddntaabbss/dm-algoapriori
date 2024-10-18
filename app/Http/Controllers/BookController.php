<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{
    public function index()
    {
        // Mengambil semua data buku dari database
        $books = Book::all();
        return view('pages.pengelolaan-buku.buku', compact('books'));
    }

    /**
     * Menampilkan form tambah buku
     */
    public function create()
    {
        return view('pages.pengelolaan-buku.tambah');
    }

    /**
     * Menyimpan data buku ke database
     */
    public function store(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'judul' => 'required|string|max:255',
            'pengarang' => 'required|string|max:255',
            'kategori' => 'required|string|max:255',
            'stok' => 'required|integer',
            'tahun_terbit' => 'required|integer',
        ]);

        try {
            // Simpan data ke database
            Book::create($validatedData);

            // Redirect dengan pesan sukses
            return redirect()->route('buku')->with('success', 'Buku berhasil ditambahkan.');
        } catch (\Exception $e) {
            // Jika gagal, redirect kembali dengan pesan error
            return redirect()->back()->withInput()->with('error', 'Gagal menyimpan data buku ke database. Silakan coba lagi.');
        }
    }

    /**
     * Menampilkan form edit untuk buku yang dipilih
     */
    public function edit($id)
    {
        // Mengambil data buku berdasarkan ID
        $book = Book::findOrFail($id);

        // Mengarahkan ke halaman edit dengan data buku
        return view('pages.pengelolaan-buku.edit', compact('book'));
    }

    /**
     * Mengupdate buku berdasarkan ID
     */

    public function update(Request $request, $id)
    {
        // Validasi input
        $validatedData = $request->validate([
            'judul' => 'required|string|max:255',
            'pengarang' => 'required|string|max:255',
            'kategori' => 'required|string|max:255',
            'stok' => 'required|integer',
            'tahun_terbit' => 'required|integer',
        ]);

        // Mengambil buku berdasarkan ID
        $book = Book::findOrFail($id);

        // Memperbarui data buku
        $book->update($validatedData);

        // Redirect ke halaman daftar buku dengan pesan sukses
        return redirect()->route('buku')->with('success', 'Buku berhasil diperbarui.');
    }


    /**
     * Menghapus buku berdasarkan ID
     */
    public function destroy($id)
    {
        // Mengambil buku berdasarkan ID
        $book = Book::findOrFail($id);

        // Menghapus buku dari database
        $book->delete();

        // Redirect kembali ke halaman daftar buku dengan pesan sukses
        return redirect()->route('buku')->with('success', 'Buku berhasil dihapus.');
    }
}
