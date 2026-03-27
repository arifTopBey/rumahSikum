<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UmkmBlock7 extends Model
{
    protected $table = 'umkm_block_7'; 
    protected $primaryKey = 'id_badan_usaha';
    public $incrementing = false;
    protected $keyType = 'int';

    protected $casts = [
        'rincian_produk' => 'array', // Ini untuk Var 701a yang baru
    ];

    public $timestamps = false;

    // protected $fillable = [
    //     'id_badan_usaha',
    //     'rincian_produk',
    //     'nilai_penjualan_setahun',
    //     'nilai_pembelian_setahun',
    //     'pasar_rumah_tangga',
    //     'pasar_pemerintah',
    //     'is_medsos',
    //     'is_marketplace',
    //     'is_ojek_online',
    //     'is_messaging_wa',
    //     'is_digital_lainnya',
       
    // ];

     protected $guarded = [];
     public function umkm()
    {
        return $this->belongsTo(Umkm::class, 'id_badan_usaha', 'id_badan_usaha');
    }
}
