<?php

namespace App\Models\Helpers;

use Illuminate\Database\Eloquent\Model;

class Pembinaan_Dev extends Model
{
    
    protected $table = 'usaha_pembinaan_dev'; 
    protected $primaryKey = 'id_badan_usaha';
    public $incrementing = false;
    protected $keyType = 'int';
    public $timestamps = false;


    public function identitasUsaha()
    {
        return $this->belongsTo(IdentitasUsaha_Dev::class, 'id_badan_usaha', 'id_badan_usaha');
    }
}
