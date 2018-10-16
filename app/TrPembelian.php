<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TrPembelian extends Model
{
    protected $table = 'tr_pembelian';
    protected $fillable = ['pembelian_code','suplier_id','reference_kode','total_harga','tgl_pembelian','user_input'];
    protected $primaryKey = 'id';
}
