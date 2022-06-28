<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sell extends Model{

    protected $primaryKey = 'id_sell';
	protected $guarded  = ['created_at', 'updated_at'];

	public function users(){

        return $this->belongsTo('App\User', 'id_karyawan', 'id');
    }

    public function products(){

        return $this->belongsTo('App\Product', 'id_produk');
    }
}
