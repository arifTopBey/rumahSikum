<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UmkmBlock3 extends Model
{
    protected $table = 'umkm_block_3'; 
    protected $primaryKey = 'id_badan_usaha';
    public $incrementing = false;
    protected $keyType = 'int';

    public $timestamps = false;


   

    // protected $fillable = [
    //     'id_badan_usaha',
    //     'nama_pengusaha',
    //     'status_pengusaha',
    //     'nik_pengusaha',
    //     'provinsi_pengusaha',
    //     'kabupaten_kota_pengusaha',
    //     'kecamatan_pengusaha',
    //     'kelurahan_pengusaha',
    //     'wa_pengusaha',
       
    // ];

     protected $guarded = [];

     public function umkm()
    {
        return $this->belongsTo(Umkm::class, 'id_badan_usaha', 'id_badan_usaha');
    }
}
