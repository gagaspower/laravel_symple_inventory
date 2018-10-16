<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrStokAdjusmentDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tr_stok_adjusment_detail', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('tr_adjusment_id');
            $table->integer('produk_id');
            $table->integer('jumlah');
            $table->integer('produk_harga_beli');
            $table->integer('produk_harga_jual');
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
        Schema::dropIfExists('tr_stok_adjusment_detail');
    }
}
