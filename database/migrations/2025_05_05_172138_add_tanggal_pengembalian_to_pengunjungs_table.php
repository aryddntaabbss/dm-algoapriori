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
            $table->date('tanggal_pengembalian')->nullable()->after('tanggal_peminjaman');
        });
    }

    public function down()
    {
        Schema::table('pengunjungs', function (Blueprint $table) {
            $table->dropColumn('tanggal_pengembalian');
        });
    }
};
