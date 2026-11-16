<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UmkmBlock6 extends Model
{
    protected $table = 'umkm_block_6'; 
    protected $primaryKey = 'id_badan_usaha';
    public $incrementing = false;
    protected $keyType = 'int';

    public $timestamps = false;

    
    // protected $fillable = [
    //     'id_badan_usaha',
    //     'nilai_bahan_baku', // 601d [cite: 7]
    //     'usaha_mikro',  // 602a [cite: 4]
    //     'usaha_kecil',  // 602b [cite: 4]
    //     'usaha_menengah', // 602c [cite: 4]
    //     'usaha_besar',  // 602d [cite: 4]
    //     'koperasi',  // 602e [cite: 4]
       
    // ];

     protected $guarded = [];
    
     public function umkm()
    {
        return $this->belongsTo(Umkm::class, 'id_badan_usaha', 'id_badan_usaha');
    }
}
