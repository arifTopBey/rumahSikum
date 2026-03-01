<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TanggalPendataan extends Model
{
    protected $table = 'tanggalpendataan'; // Gunakan block 1 sebagai tabel dasar
    protected $primaryKey = 'id_data_badan_usaha';
    public $incrementing = false;
    protected $keyType = 'int';
    public $timestamps = false;

    public function identitasUsaha()
    {
        return $this->belongsTo(IdentitasUsaha::class, 'id_data_badan_usaha', 'id_badan_usaha');
    }
}


