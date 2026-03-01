<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IdentitasUsaha extends Model
{
    protected $table = 'identitasusaha'; // Gunakan block 1 sebagai tabel dasar
    protected $primaryKey = 'id_badan_usaha';
    public $incrementing = false;
    protected $keyType = 'int';
    public $timestamps = false;


    protected $guarded = [];

    public function tanggalPendataan()
    {
        return $this->hasOne(TanggalPendataan::class, 'id_data_badan_usaha', 'id_badan_usaha');
    }

    public function tenagaKerja()
    {
        return $this->hasOne(TenagaKerja::class, 'id_data_badan_usaha', 'id_badan_usaha');
    }

    

}
