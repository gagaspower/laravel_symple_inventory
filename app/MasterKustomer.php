<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MasterKustomer extends Model
{
    protected $table = 'master_kustomer';
    protected $fillable = ['nama_kustomer','telp_kustomer','alamat_kustomer'];
    protected $primaryKey = 'id';
}
