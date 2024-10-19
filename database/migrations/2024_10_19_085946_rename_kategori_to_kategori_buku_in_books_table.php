<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameKategoriToKategoriBukuInBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('books', function (Blueprint $table) {
            // Ganti nama kolom 'kategori' menjadi 'kategori_buku'
            $table->renameColumn('kategori', 'kategori_buku');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('books', function (Blueprint $table) {
            // Kembalikan nama kolom ke 'kategori'
            $table->renameColumn('kategori_buku', 'kategori');
        });
    }
}
