<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    protected $table = 'master_warehouse';
    protected $fillable = ['warehouse_nama','warehouse_alamat'];
    protected $primaryKey = 'id';
    public $timestamps = false;
}
