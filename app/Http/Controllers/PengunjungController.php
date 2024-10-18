<?php

namespace App\Http\Controllers;

use App\Models\Pengunjung;
use Illuminate\Http\Request;

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
        // Mengarahkan ke view 'pengunjung.create'
        return view('pages.pengunjung.create');
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
            'kategori' => 'required|string|in:Peminjaman,Pengembalian',
        ]);

        // Simpan data pengunjung ke database
        Pengunjung::create($validatedData);

        // Redirect ke halaman daftar pengunjung dengan pesan sukses
        return redirect()->route('pengunjung')->with('success', 'Pengunjung berhasil ditambahkan.');
    }

    /**
     * Menampilkan form edit pengunjung berdasarkan ID
     */
    public function edit($id)
    {
        // Mengambil data pengunjung berdasarkan ID
        $pengunjung = Pengunjung::findOrFail($id);

        // Mengarahkan ke view 'pengunjung.edit' dengan data pengunjung
        return view('pages.pengunjung.edit', compact('pengunjung'));
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
        ]);

        // Mengambil data pengunjung berdasarkan ID
        $pengunjung = Pengunjung::findOrFail($id);

        // Update data pengunjung
        $pengunjung->update($validatedData);

        // Redirect ke halaman daftar pengunjung dengan pesan sukses
        return redirect()->route('pengunjung')->with('success', 'Pengunjung berhasil diperbarui.');
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
