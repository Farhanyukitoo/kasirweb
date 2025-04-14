<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('riwayat_penjualan', function (Blueprint $table) {
            $table->id();
            $table->string('kode_transaksi', 50)->unique();
            $table->dateTime('tanggal_transaksi');
            $table->decimal('total_harga', 15, 2);
            $table->enum('metode_pembayaran', ['Cash', 'Debit', 'Kredit', 'E-Wallet']);
            $table->enum('status', ['Selesai', 'Dibatalkan'])->default('Selesai');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('riwayat_penjualan');
    }
};
