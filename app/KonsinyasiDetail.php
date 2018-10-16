<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KonsinyasiDetail extends Model
{
    protected $table = 'tr_konsinyasi_detail';
    protected $fillable = ['tr_konsinyasi_id','konsinyasi_item_id','konsinyasi_item','konsinyasi_item_qty','konsinyasi_item_harga_beli','konsinyasi_harga_jual'];

    protected $primaryKey = 'id';
    public $timestamps = false;
}
