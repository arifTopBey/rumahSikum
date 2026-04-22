<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KategoriElearning extends Model
{
     protected $table = 'kategori_elearning'; 
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = true;
    protected $guarded = [];

    public function elearning(){
        return $this->hasMany(Elearning::class, 'kategori_elearning_id', 'id');
    }
}
