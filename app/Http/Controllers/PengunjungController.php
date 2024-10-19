<?php

namespace App\Http\Controllers;

use App\Models\Pengunjung;
use Illuminate\Http\Request;
use App\Models\Book;

class PengunjungController extends Controller
{
    /**
     * Menampilkan daftar pengunjung
     */
    public function index()
    {
        // Mengambil semua data pengunjung
        $pengunjungs = Pengunjung::all();

        // Mengirim data pengunjung ke view 'pengunjung.index'
        return view('pages.pengunjung.index', compact('pengunjungs'));
    }

    /**
     * Menampilkan form tambah pengunjung
     */
    public function create()
    {
        $books = Book::all(); // Ambil semua data buku untuk ditampilkan di form
        return view('pages.pengunjung.create', compact('books'));
    }

    /**
     * Menyimpan data pengunjung baru
     */
    public function store(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'no_whatsapp' => 'required|string|max:20',
            'jenjang' => 'required|string|in:Siswa,Mahasiswa,Guru,Lansia',
            'kategori' => 'required|string|in:Peminjaman,Pengembalian', // Validasi kategori
            'tanggal' => 'required|date',
            'judul_buku' => 'required|string|max:255',
        ]);

        // Ambil buku berdasarkan judul
        $book = Book::where('judul', $request->judul_buku)->first();

        // Logika untuk kategori peminjaman dan pengembalian
        if ($request->kategori == 'Peminjaman') {
            if ($book && $book->stok > 0) {
                // Kurangi stok buku
                $book->stok -= 1;
                $book->save();
            } else {
                return redirect()->back()->with('error', 'Stok buku tidak mencukupi.');
            }
        } elseif ($request->kategori == 'Pengembalian') {
            if ($book) {
                // Tambah stok buku saat pengembalian
                $book->stok += 1;
                $book->save();
            }
        }

        // Simpan data pengunjung ke database
        Pengunjung::create($validatedData);

        return redirect()->route('pengunjung')->with('success', 'Transaksi berhasil diproses.');
    }



    /**
     * Menampilkan form edit pengunjung berdasarkan ID
     */
    public function edit($id)
    {
        $pengunjung = Pengunjung::findOrFail($id);
        $books = Book::all(); // Ambil semua buku untuk dropdown
        return view('pages.pengunjung.edit', compact('pengunjung', 'books'));
    }

    /**
     * Memperbarui data pengunjung yang sudah ada
     */
    public function update(Request $request, $id)
    {
        // Validasi input
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'no_whatsapp' => 'required|string|max:20',
            'jenjang' => 'required|string|in:Siswa,Mahasiswa,Guru,Lansia',
            'kategori' => 'required|string|in:Peminjaman,Pengembalian',
            'tanggal' => 'required|date',
            'judul_buku' => 'required|string|max:255',
        ]);

        $pengunjung = Pengunjung::findOrFail($id);
        $book = Book::where('judul', $request->judul_buku)->first();

        // Cek kategori
        if ($request->kategori == 'Peminjaman') {
            if ($book && $book->stok > 0) {
                $book->stok -= 1;
                $book->save();
            } else {
                return redirect()->back()->with('error', 'Stok buku tidak mencukupi.');
            }
        } elseif ($request->kategori == 'Pengembalian') {
            if ($book) {
                $book->stok += 1;
                $book->save();
            }
        }

        // Update data pengunjung
        $pengunjung->update($validatedData);

        return redirect()->route('pengunjung')->with('success', 'Data pengunjung berhasil diperbarui.');
    }



    /**
     * Menghapus data pengunjung
     */
    public function destroy($id)
    {
        // Mengambil data pengunjung berdasarkan ID
        $pengunjung = Pengunjung::findOrFail($id);

        // Menghapus data pengunjung
        $pengunjung->delete();

        // Redirect ke halaman daftar pengunjung dengan pesan sukses
        return redirect()->route('pengunjung')->with('success', 'Pengunjung berhasil dihapus.');
    }
}
