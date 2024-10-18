<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengunjungsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengunjungs', function (Blueprint $table) {
            $table->id();
            $table->string('nama'); // Nama pengunjung
            $table->string('no_whatsapp'); // Nomor WhatsApp pengunjung
            $table->enum('jenjang', ['Siswa', 'Mahasiswa', 'Guru', 'Lansia']); // Jenjang: Siswa, Mahasiswa, Guru, Lansia
            $table->string('kategori'); // Kategori pengunjung
            $table->date('tanggal');
            $table->timestamps(); // Timestamps created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pengunjungs');
    }
}
