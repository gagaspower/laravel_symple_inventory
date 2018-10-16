<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mutasi extends Model
{
    protected $table = 'tr_mutasi_stok';
    protected $fillable = ['mutasi_code','mutasi_tangga','mutasi_deskripsi','mutasi_warehouse_out','mutasi_warehouse_in','mutasi_total','mutasi_status'];
    protected $primaryKey = 'id';
}
