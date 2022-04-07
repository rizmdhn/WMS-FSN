<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    protected $table = 'record';
    protected $primaryKey = 'id_record';
    protected $guarded  = ['created_at', 'updated_at'];
}
