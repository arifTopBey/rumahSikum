<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UmkmBlock4 extends Model
{
    protected $table = 'umkm_block_4'; 
    protected $primaryKey = 'id_badan_usaha';
    public $incrementing = false;
    protected $keyType = 'int';

    public $timestamps = false;

    // protected $fillable = [
    //     'id_badan_usaha',
    //     'izin_pirt',          // 401b [cite: 3]
    //     'izin_bpom',          // 401c [cite: 3]
    //     'izin_tdp',           // 401j [cite: 3]
    //     'sertifikat_halal',   // 402b [cite: 3]
       
    // ];

     protected $guarded = [];

    
     public function umkm()
    {
        return $this->belongsTo(Umkm::class, 'id_badan_usaha', 'id_badan_usaha');
    }
}
