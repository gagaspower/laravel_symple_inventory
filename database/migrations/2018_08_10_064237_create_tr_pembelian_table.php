<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrPembelianTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tr_pembelian', function (Blueprint $table) {
            $table->increments('id');
            $table->string('pembelian_code');
            $table->integer('suplier_id');
            $table->string('reference_kode');
            $table->string('total_harga');
            $table->date('tgl_pembelian');
            $table->string('user_input');
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
        Schema::dropIfExists('tr_pembelian');
    }
}
