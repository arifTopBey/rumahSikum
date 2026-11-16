<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UmkmBlock10 extends Model
{
    protected $table = 'umkm_block_10'; 
    protected $primaryKey = 'id_badan_usaha';
    public $incrementing = false;
    protected $keyType = 'int';

    // protected $fillable = [
    //     'id_badan_usaha',
    //     'data_mitra',       // 1001 [cite: 7]
       
    // ];

    public $timestamps = false;
     protected $guarded = [];

    protected $casts = [
    'data_mitra' => 'array',     
    ];
     
     public function umkm()
    {
        return $this->belongsTo(Umkm::class, 'id_badan_usaha', 'id_badan_usaha');
    }
}
