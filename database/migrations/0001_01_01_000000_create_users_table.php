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
         Schema::create('users', function (Blueprint $table){
            $table->id();
            $table->string('username')->unique();
            $table->string('name');
            $table->string('email_verified_at')->nullable();
            $table->string('password');
            $table->enum('roles', ['Admin', 'Kasir', 'Pembelian']);
            $table->remembertoken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void

    {
        Schema::DropIfExists('users');
    }
};