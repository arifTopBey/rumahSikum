<?php

namespace App\Models\Helpers;

use Illuminate\Database\Eloquent\Model;

class TanggalPendataan_Dev extends Model
{
    protected $table = 'tanggalpendataan_dev'; // block 11
    protected $primaryKey = 'id_data_badan_usaha';
    public $incrementing = false;
    protected $keyType = 'int';
    public $timestamps = false;

    public function identitasUsaha()
    {
        return $this->belongsTo(IdentitasUsaha_Dev::class, 'id_data_badan_usaha', 'id_badan_usaha');
    }
}


