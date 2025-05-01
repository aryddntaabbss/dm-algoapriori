<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengunjung;
use App\Models\Book;
use App\Models\User;
use Phpml\Association\Apriori;

class RekAprioriController extends Controller
{
    /**
     * Menampilkan halaman Apriori.
     */
    public function index()
    {
        return view('pages.rek-apriori.index');
    }

    /**
     * Memproses algoritma Apriori dan menampilkan hasil rekomendasi.
     */
    public function process(Request $request)
    {
        // Validasi input
        $request->validate([
            'min_support' => 'required|numeric|min:0.01|max:1',
            'min_confidence' => 'required|numeric|min:0.01|max:1',
        ]);

        $minSupport = (float) $request->min_support;
        $minConfidence = (float) $request->min_confidence;

        // Ambil data transaksi peminjaman buku beserta jenjang pengguna
        $transactions = Book::join('pengunjungs', 'pengunjungs.judul_buku', '=', 'books.judul')
            ->join('users', 'pengunjungs.user_id', '=', 'users.id')
            ->select('users.jenjang', 'books.kategori_buku')
            ->where('pengunjungs.kategori', 'Pinjam')
            ->get();

        // Konversi data ke format Apriori (list of transactions)
        $samples = [];
        foreach ($transactions as $t) {
            $samples[$t->jenjang][] = $t->kategori_buku;
        }

        // Cek apakah ada transaksi sebelum menjalankan Apriori
        if (empty($samples)) {
            return redirect()->route('rek-apriori')
                ->with('error', 'Data transaksi kosong! Tambahkan data peminjaman buku terlebih dahulu.')
                ->withInput();
        }

        // Konversi associative array ke indexed array
        $samples = array_values($samples);

        // Jalankan Apriori
        $aprioriResult = $this->runApriori($samples, $minSupport, $minConfidence);

        // Cek apakah ada aturan asosiasi
        if (empty($aprioriResult)) {
            return redirect()->route('rek-apriori')
                ->with('warning', 'Algoritma tidak menemukan aturan asosiasi. Coba ubah nilai Support dan Confidence.')
                ->withInput();
        }

        return view('pages.rek-apriori.index', compact('aprioriResult', 'transactions'));
    }

    /**
     * Fungsi untuk menjalankan algoritma Apriori
     */
    private function runApriori(array $samples, float $minSupport, float $minConfidence)
    {
        if (empty($samples)) {
            return [];
        }

        // Inisialisasi Apriori
        $associator = new Apriori($minSupport, $minConfidence);
        $associator->train($samples, []);

        // Ambil aturan asosiasi yang ditemukan
        return $associator->getRules();
    }
}
