<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UmkmBlock12 extends Model
{
    protected $table = 'umkm_block_12'; 
    protected $primaryKey = 'id_badan_usaha';
    public $incrementing = false;
    protected $keyType = 'int';


    public $timestamps = false;

    // protected $fillable = [
    //     'id_badan_usaha',
    //     'teknis_produksi', // 1201a
    //     'pemasaran_jaringan', // 1201b
    //     'pembiayaan', // 1202c
    //     'ekspor', // 1202d
    //     'digitalisasi', // 1202e
    //     'manajement', // 1202f
    //     'standarisasi', // 1202g
    //     'hak_kekayaan_intelektual', // 1202h
    //     'mitigasi_kebencanaan', // 1202i
    //     'usaha_sendiri', // 1202j
       
    // ];

     protected $guarded = [];

     public function umkm()
    {
        return $this->belongsTo(Umkm::class, 'id_badan_usaha', 'id_badan_usaha');
    }
}
