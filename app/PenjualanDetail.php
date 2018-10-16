<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PenjualanDetail extends Model
{
    protected $table = 'tr_penjualan_detail';
    protected $fillable = ['tr_penjualan_id','produk_id','jumlah','harga_jual_produk'];
    protected $primaryKey = 'id';
}
