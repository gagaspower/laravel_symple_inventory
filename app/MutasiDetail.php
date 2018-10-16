<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MutasiDetail extends Model
{
   protected $table = 'tr_mutasi_stok_detail';
   protected $fillable = ['mutasi_id','mutasi_item_id','mutasi_item_qty','mutasi_item_harga_beli','mutasi_item_harga_jual'];
   protected $primaryKey = 'id';
}
