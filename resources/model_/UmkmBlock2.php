<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UmkmBlock2 extends Model
{
    
    protected $table = 'umkm_block_2'; 
    protected $primaryKey = 'id_badan_usaha';
    public $incrementing = false;
    public $timestamps = false;
    protected $keyType = 'int';

    // protected $fillable = [
    //     'id_badan_usaha',
    //     'kegiatan_utama',
    //     'produk_utama',
    //     'kategori_kbli',
    //     'kode_kbli',
    //     'status_badan_usaha',
    //     'nib',
    //     'npwp',
    //     'bulan_mulai',
    //     'tahun_mulai',
       
    // ];
     protected $guarded = [];
    public function umkm()
    {
        return $this->belongsTo(Umkm::class, 'id_badan_usaha', 'id_badan_usaha');
    }
}
