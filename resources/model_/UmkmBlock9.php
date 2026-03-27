<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UmkmBlock9 extends Model
{
    protected $table = 'umkm_block_9'; 
    protected $primaryKey = 'id_badan_usaha';
    public $incrementing = false;
    protected $keyType = 'int';

    // protected $fillable = [
    //     'id_badan_usaha',
    //     'is_manual',
    //     'is_mekanik',
    //     'is_elektronik',
    //     'is_digital',
    //     'is_ai',
       
    // ];

    public $timestamps = false;

        protected $guarded = [];
     public function umkm()
    {
        return $this->belongsTo(Umkm::class, 'id_badan_usaha', 'id_badan_usaha');
    }
}
