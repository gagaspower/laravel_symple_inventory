<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrPenjualanDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tr_penjualan_detail', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('tr_penjualan_id');
            $table->integer('produk_id');
            $table->integer('jumlah');
            $table->integer('harga_jual_produk');
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
        Schema::dropIfExists('tr_penjualan_detail');
    }
}
