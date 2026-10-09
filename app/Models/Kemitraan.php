<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kemitraan extends Model
{
    
    protected $table = 'usaha_kemitraan'; 
    protected $primaryKey = 'id_badan_usaha';
    public $incrementing = false;
    protected $keyType = 'int';
    public $timestamps = false;


    public function identitasUsaha()
    {
        return $this->belongsTo(IdentitasUsaha::class, 'id_badan_usaha', 'id_badan_usaha');
    }
}
