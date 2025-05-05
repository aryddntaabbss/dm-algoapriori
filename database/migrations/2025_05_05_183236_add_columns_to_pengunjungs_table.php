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
            $table->string('kode_buku')->nullable();
            $table->string('judul_buku')->nullable();
            $table->date('tanggal_peminjaman')->nullable();
            $table->date('tanggal_pengembalian')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pengunjungs', function (Blueprint $table) {
            //
        });
    }
};
