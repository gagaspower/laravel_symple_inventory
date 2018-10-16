<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TrPembelianDetail extends Model
{
    protected $table = 'tr_pembelian_detail';
    protected $fillable = ['tr_pembelian_id','nama_item','stok','harga_pembelian'];
    protected $primaryKey = 'id';
}
