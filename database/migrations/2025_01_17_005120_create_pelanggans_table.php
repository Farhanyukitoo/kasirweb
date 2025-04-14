<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePelanggansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pelanggans', function (Blueprint $table) {
            $table->id(); // Kolom pelangganID sebagai primary key
            $table->string('namapelanggan', 100); // Kolom nama pelanggan, maksimal 100 karakter
            $table->text('Peran');
            $table->bigInteger('Nomerunik')->unique(); // Kolom nomor unik dengan tipe numerik dan unik
            $table->text('Alamat'); // Kolom alamat tipe teks
            $table->string('Nomer', 15); // Kolom nomor, maksimal 15 karakter
            $table->timestamps(); // Kolom created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pelanggans');
    }
}
