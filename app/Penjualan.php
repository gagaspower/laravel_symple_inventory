<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    protected $table = 'tr_penjualan';
    protected $fillable = ['penjualan_code','kustomer_id','tgl_penjualan','deskripsi_penjualan','total_penjualan'];
    protected $primaryKey = 'id';
}
