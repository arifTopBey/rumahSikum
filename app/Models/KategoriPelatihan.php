<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KategoriPelatihan extends Model
{
    protected $table = 'kategori_pelatihan'; 
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = true;
    protected $guarded = [];

    public function elearning(){
        return $this->hasMany(Pelatihan::class, 'kategori_pelatihan_id', 'id');
    }
}
