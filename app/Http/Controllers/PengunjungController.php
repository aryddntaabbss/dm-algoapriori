<?php

namespace App\Http\Controllers;

use App\Models\Pengunjung;
use Illuminate\Http\Request;
use App\Models\Book;
use Illuminate\Support\Facades\Auth;

class PengunjungController extends Controller
{
    /**
     * Menampilkan daftar pengunjung
     */
    public function index()
    {
        $pengunjungs = Pengunjung::all(); // Ambil semua data pengunjung
        return view('pages.pengunjung.index', compact('pengunjungs'));
    }

    /**
     * Menampilkan form tambah pengunjung
     */
    public function create()
    {
        $books = Book::all();
        return view('pages.pengunjung.create', compact('books'));
    }

    /**
     * Menyimpan data pengunjung baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'kode_buku' => 'required|string',
            'judul_buku' => 'required|string',
        ]);

        $user = auth()->user();

        Pengunjung::create([
            'user_id' => $user->id,
            'nama' => $user->name,
            'nomor_tlp' => $user->nomor_tlp,
            'jenjang' => $user->jenjang,
            'judul_buku' => $request->judul_buku,
            'kode_buku' => $request->kode_buku,
            'tanggal_peminjaman' => now()->toDateString(),
            'tanggal_pengembalian' => now()->addDays(7)->toDateString(),
            'kategori' => 'Pinjam',
        ]);

        return redirect()->route('pengunjung.index')->with('success', 'Buku berhasil dipinjam.');
    }

    /**
     * Menampilkan form edit pengunjung berdasarkan ID
     */
    public function edit($id)
    {
        $peminjaman = Pengunjung::findOrFail($id);
        return view('pages.pengunjung.edit', compact('peminjaman'));
    }

    /**
     * Memperbarui data pengunjung yang sudah ada
     */
    public function update(Request $request, $id)
    {
        $peminjaman = Pengunjung::findOrFail($id);
        $peminjaman->update([
            'kategori' => 'Kembalikan',
            'tanggal_pengembalian' => now()->toDateString(),
        ]);

        return redirect()->route('pengunjung.index')->with('success', 'Buku berhasil dikembalikan.');
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
        return redirect()->route('pengunjung.index')->with('success', 'Pengunjung berhasil dihapus.');
    }
}
