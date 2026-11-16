<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UmkmBlock5 extends Model
{
    protected $table = 'umkm_block_5'; 
    protected $primaryKey = 'id_badan_usaha';
    public $incrementing = false;
    protected $keyType = 'int';

    public $timestamps = false;

    // protected $fillable = [
    //     'id_badan_usaha',
    //     'tanggal_mulai',    // 1405a [cite: 7]
    //     'tanggal_selesai',  // 1405b [cite: 7]
       
    // ];
     protected $guarded = [];

     public function umkm()
    {
        return $this->belongsTo(Umkm::class, 'id_badan_usaha', 'id_badan_usaha');
    }
}
