<?php

namespace App\Models\Helpers;

use Illuminate\Database\Eloquent\Model;

class TenagaKerja_Dev extends Model
{
    protected $table = 'tenagakerja_dev'; 
    protected $primaryKey = 'id_data_badan_usaha';
    public $incrementing = false;
    protected $keyType = 'int';
    public $timestamps = false;

    protected $guarded = ['id_data_badan_usaha'];


    public function identitasUsaha()
    {
        return $this->belongsTo(IdentitasUsaha_Dev::class, 'id_data_badan_usaha', 'id_badan_usaha');
    }
}
