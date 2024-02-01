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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_user')->references('id')->on('users');
            $table->string('nama_produk');
            $table->string('harga_total');
            $table->string('harga_discount')->nullable();
            $table->string('persen_discount')->nullable();
            $table->string('jumlah_semua_pembelian');
            $table->string('methode_pembayaran');
            $table->string('dana')->nullable();
            $table->string('bank')->nullable();
            $table->string('COD')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
