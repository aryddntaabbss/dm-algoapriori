<?php

namespace App\Http\Controllers;

use App\Models\Pengunjung;
use Illuminate\Http\Request;
use App\Models\Book;
use Illuminate\Support\Facades\Auth;

class AdminPengunjungController extends Controller
{
    /**
     * Menampilkan daftar pengunjung
     */
    public function index()
    {
        // Mengambil semua data pengunjung
        $pengunjungs = Pengunjung::all();

        // Mengirim data pengunjung ke view 'pengunjung.index'
        return view('admin.pengunjung.index', compact('pengunjungs'));
    }

    /**
     * Menampilkan form tambah pengunjung
     */
    public function create()
    {
        $books = Book::all(); // Ambil semua data buku untuk ditampilkan di form
        $peminjaman = Pengunjung::all(); // Ambil semua data peminjaman
        return view('admin.pengunjung.create', compact('books', 'peminjaman'));
    }

    /**
     * Menyimpan data pengunjung baru
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'judul_buku' => 'required|string|max:255',
            'kode_buku' => 'required|string|max:255',
        ]);

        // Pastikan user sedang login
        $user = Auth::user();

        // Pastikan user memiliki nomor telepon
        if (!$user->nomor_tlp) {
            return redirect()->back()->with('error', 'Nomor telepon tidak tersedia. Harap lengkapi profil Anda.');
        }

        // Simpan data peminjaman buku
        Pengunjung::create([
            'user_id' => $user->id,
            'nama' => $user->name,
            'nomor_tlp' => $user->nomor_tlp, // Pastikan nomor_tlp diambil dari user
            'judul_buku' => $request->judul_buku,
            'kode_buku' => $request->kode_buku,
            'tanggal_peminjaman' => now()->toDateString(),
            'kategori' => 'Pinjam',
        ]);

        return redirect()->back()->with('success', 'Buku berhasil dipinjam.');
    }

    /**
     * Menampilkan form edit pengunjung berdasarkan ID
     */
    public function edit($id)
    {
        $peminjaman = Pengunjung::findOrFail($id);
        return view('pengunjung.edit', compact('peminjaman'));
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
