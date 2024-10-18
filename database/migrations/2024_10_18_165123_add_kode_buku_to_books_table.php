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
        Schema::table('books', function (Blueprint $table) {
            $table->string('kode_buku')->unique()->change(); // Menambahkan constraint unique
        });
    }

    public function down()
    {
        Schema::table('books', function (Blueprint $table) {
            $table->dropUnique(['kode_buku']); // Menghapus constraint unique jika di-rollback
        });
    }
};
