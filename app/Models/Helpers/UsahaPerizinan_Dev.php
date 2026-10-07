<?php

namespace App\Models\Helpers;

use Illuminate\Database\Eloquent\Model;

class UsahaPerizinan_Dev extends Model
{
    protected $table = 'usaha_perizinan_dev'; 
    protected $primaryKey = 'id_badan_usaha';
    public $incrementing = false;
    protected $keyType = 'int';
    public $timestamps = false;

    public function identitasUsaha()
    {
        return $this->belongsTo(IdentitasUsaha_Dev::class, 'id_badan_usaha', 'id_badan_usaha');
    }
    public function laporanKeuangan(){
         return $this->belongsTo(LaporanKeuangan_Dev::class, 'id_badan_usaha', 'id_badan_usaha');
    }
    public function skalaUsaha(){
         return $this->belongsTo(SkalaUsaha_Dev::class, 'id_badan_usaha', 'id_badan_usaha');
    }
}
