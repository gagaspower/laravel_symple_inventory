<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrPenjualanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tr_penjualan', function (Blueprint $table) {
            $table->increments('id');
            $table->string('penjualan_code');
            $table->integer('kustomer_id');
            $table->date('tgl_penjualan');
            $table->text('deskripsi_penjualan');
            $table->integer('diskon_penjualan');
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
        Schema::dropIfExists('tr_penjualan');
    }
}
