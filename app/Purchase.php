<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model{

    protected $primaryKey = 'id_purchase';
	protected $guarded  = ['created_at', 'updated_at'];

	public function products(){

        return $this->belongsTo('App\Product', 'id_produk');
    }
    public function users(){

        return $this->belongsTo('App\User', 'id_karyawan', 'id');
    }
}
