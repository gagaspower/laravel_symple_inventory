<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdjusmentTempTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adjusment_temp', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('produk_id');
            $table->integer('produk_qty');
            $table->integer('produk_price');
            $table->integer('produk_price_sale');
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
        Schema::dropIfExists('adjusment_temp');
    }
}
