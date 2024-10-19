<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengunjung;
use App\Models\Book;
use Phpml\Association\Apriori;

class RekAprioriController extends Controller
{
    /**
     * Menampilkan halaman untuk memproses Apriori.
     */
    public function index()
    {
        // Awalnya halaman hanya menampilkan form, belum ada hasil
        return view('pages.rek-apriori.index');
    }

    /**
     * Memproses algoritma Apriori dan menampilkan hasil rekomendasi.
     */
    public function process(Request $request)
    {
        // Ambil input dari form
        $minSupport = $request->input('min_support', 0.3);
        $minConfidence = $request->input('min_confidence', 0.5);

        // Ambil data transaksi peminjam (kategori Peminjaman) beserta jenjang dan judul buku
        $transactions = Pengunjung::where('kategori', 'Peminjaman')
            ->join('books', 'pengunjungs.judul_buku', '=', 'books.judul')
            ->select('pengunjungs.id', 'pengunjungs.jenjang', 'books.kategori_buku')
            ->get();

        // Proses data menggunakan algoritma Apriori dengan support dan confidence dari input
        $aprioriResult = $this->runApriori($transactions, $minSupport, $minConfidence);

        // Kirim hasil ke halaman result (tetap pada halaman yang sama)
        return view('pages.rek-apriori.index', compact('aprioriResult', 'transactions'));
    }

    private function runApriori($transactions, $minSupport, $minConfidence)
    {
        // Data yang digunakan untuk Apriori
        $samples = [];
        foreach ($transactions as $transaction) {
            $samples[] = [$transaction->jenjang, $transaction->kategori_buku];
        }

        // Inisialisasi Apriori dengan support dan confidence yang diterima dari input
        $associator = new Apriori($minSupport, $minConfidence);

        // Training data transaksi
        $associator->train($samples, []);

        // Ambil aturan asosiasi
        $rules = $associator->getRules();

        // Return hasil aturan asosiasi
        return $rules;
    }
}
