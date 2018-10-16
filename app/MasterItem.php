<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MasterItem extends Model
{
    protected $table = 'master_item';
    protected $fillable= ['nama_item','stok','harga_pembelian','harga_jual'];
    protected $primeryKey = 'id';
}
