<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('laporan_stok', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('products')->onUpdate('cascade')->onDelete('cascade');
            $table->string('referensi');
            $table->enum('tipe_pergerakan', ['Keluar', 'Masuk']);
            $table->date('tanggal_transaksi');
            $table->integer('stok_awal');
            $table->integer('qty');
            $table->integer('stok_akhir');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporan_stok');
    }
};
