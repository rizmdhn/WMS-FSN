<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class gudang extends Model
{
    protected $table = "gudang";
    protected $primaryKey = 'id_gudang';
	protected $guarded  = ['created_at', 'updated_at'];
}
