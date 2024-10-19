<?php

namespace App\Imports;

use App\Models\Book;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Log;

class BooksImport implements ToModel, WithHeadingRow
{
    // Variable untuk mencatat duplikat
    protected $duplicateBooks = [];

    public function model(array $row)
    {
        // Periksa apakah kode_buku sudah ada di database
        $existingBook = Book::where('kode_buku', $row['kode_buku'])->first();

        if ($existingBook) {
            // Catat buku duplikat
            $this->duplicateBooks[] = $row['kode_buku'];
            return null; // Abaikan buku yang sudah ada
        }

        // Jika tidak ada, tambahkan buku baru ke database
        return new Book([
            'kode_buku'     => $row['kode_buku'],
            'judul'         => $row['judul'],
            'pengarang'     => $row['pengarang'],
            'kategori_buku' => $row['kategori_buku'],
            'stok'          => (int) $row['stok'],
            'tahun_terbit'  => (int) $row['tahun_terbit'],
        ]);
    }

    // Method untuk mendapatkan daftar buku yang duplikat
    public function getDuplicateBooks()
    {
        return $this->duplicateBooks;
    }
}
