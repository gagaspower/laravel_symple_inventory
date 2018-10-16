<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrPembelianDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tr_pembelian_detail', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('tr_pembelian_id');
            $table->string('nama_item');
            $table->integer('stok');
            $table->integer('harga_pembelian');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tr_pembelian_detail');
    }
}
