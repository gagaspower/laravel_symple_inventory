<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MasterSuplier extends Model
{
    protected $table = 'master_suplier';
    protected $fillable = ['nama_suplier','telp_suplier','alamat_suplier'];
    protected $primaryKey = 'id';
}
