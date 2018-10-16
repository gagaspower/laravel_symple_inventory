<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Konsinyasi extends Model
{
    protected $table = 'tr_konsinyasi';
    protected $fillable = ['konsinyasi_code','konsinyasi_tanggal','konsinyasi_deskripsi','konsinyasi_suplier_id','konsinyasi_total','konsinyasi_tipe'];

    protected $primaryKey = 'id';
    
}
