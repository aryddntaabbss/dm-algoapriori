<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('pengunjungs', function (Blueprint $table) {
            $table->string('judul_buku')->nullable(); // Menambahkan kolom judul_buku
        });
    }

    public function down()
    {
        Schema::table('pengunjungs', function (Blueprint $table) {
            $table->dropColumn('judul_buku'); // Menghapus kolom judul_buku jika di-rollback
        });
    }
};
