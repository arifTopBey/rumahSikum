<?php

namespace App\Models\Helpers;

use Illuminate\Database\Eloquent\Model;

class Kemitraan_Dev extends Model
{
    
    protected $table = 'usaha_kemitraan_dev'; 
    protected $primaryKey = 'id_badan_usaha';
    public $incrementing = false;
    protected $keyType = 'int';
    public $timestamps = false;
    protected $guarded = ['id'];
    // protected $guarded = ['id_badan_usaha'];


    public function identitasUsaha()
    {
        return $this->belongsTo(IdentitasUsaha_Dev::class, 'id_badan_usaha', 'id_badan_usaha');
    }
}
