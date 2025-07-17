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
        Schema::create('product_categories', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kategori');
        });

        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('kode_product')->unique();
            $table->string('nama_product');
            $table->integer('harga_beli');
            $table->integer('harga_jual');
            $table->integer('stock')->default(0);

            $table->foreignId('product_category_id')->constrained('product_categories')->onUpdate('cascade')->onDelete('cascade');;
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_categories');
        Schema::dropIfExists('products');
    }
};
