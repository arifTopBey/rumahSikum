<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UmkmBlock11 extends Model
{
    protected $table = 'umkm_block_11'; 
    protected $primaryKey = 'id_badan_usaha';
    public $incrementing = false;
    protected $keyType = 'int';

    public $timestamps = false;

    // protected $fillable = [
    //     'id_badan_usaha',
    //     'ada_laporan',  // 1101
    //     'omzet',        // 1102a
    //     'pendapatan_ops', // 1102b
    //     'pendapatan_non_ops', // 1102c
    //     'pendapatan_lainnya_subsidi_usaha', // 1102d
    //     'pendapatan_lainnya_subsidi_fiskal', // 1102e
    //     'pph_badan_pasal', // 1103a
    //     'pph_final_omzet', // 1103b
    // ];

     protected $guarded = [];

     public function umkm()
    {
        return $this->belongsTo(Umkm::class, 'id_badan_usaha', 'id_badan_usaha');
    }
}
