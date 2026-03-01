<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UmkmBlock8 extends Model
{
    protected $table = 'umkm_block_8'; 
    protected $primaryKey = 'id_badan_usaha';
    public $incrementing = false;
    protected $keyType = 'int';

    public $timestamps = false;

    // protected $fillable = [
    //     'id_badan_usaha',
    //     'total_naker',   // 8011 (di PDF) / 801i (di JSON) 
    //     'total_upah',   // 803i
       
    // ];

     protected $guarded = [];


     public function umkm()
    {
        return $this->belongsTo(Umkm::class, 'id_badan_usaha', 'id_badan_usaha');
    }
}
