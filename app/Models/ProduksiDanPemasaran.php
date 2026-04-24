<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProduksiDanPemasaran extends Model
{
    protected $table = 'usaha_produksi_pemasaran'; // Gunakan block 1 sebagai tabel dasar
    protected $primaryKey = 'id_badan_usaha';
    public $incrementing = false;
    protected $keyType = 'int';
    public $timestamps = false;

    public function identitasUsaha()
    {
        return $this->belongsTo(IdentitasUsaha::class, 'id_badan_usaha', 'id_badan_usaha');
    }

    public function skalaUsaha(){

       return $this->belongsTo(SkalaUsaha::class, 'id_badan_usaha', 'id_badan_usaha');

    }
}
