<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pelatihan extends Model
{
    protected $table = 'pealtihan'; 
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = true;

    protected $guarded = ['id']; 

    public function kategoriPelatihan()
    {
        return $this->belongsTo(KategoriPelatihan::class, 'kategori_pelatihan_id', 'id');
    }
}
