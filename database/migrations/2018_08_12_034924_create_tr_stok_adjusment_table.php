<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrStokAdjusmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tr_stok_adjusment', function (Blueprint $table) {
            $table->increments('id');
            $table->string('adjusment_code');
            $table->text('adjusment_desc');
            $table->date('adjusment_date');
            $table->char('adjusment_type',2);
            $table->integer('suplier_id');
            $table->char('status',2)->default('00');
            $table->integer('adjusment_amount');
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
        Schema::dropIfExists('tr_stok_adjusment');
    }
}
