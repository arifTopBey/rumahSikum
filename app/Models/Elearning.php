<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Elearning extends Model
{
    protected $table = 'elearning'; 
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = true;

    protected $guarded = ['id']; 

    public function kategoriElearning(){
        return $this->belongsTo(KategoriElearning::class, 'kategori_elearning_id', 'id');
    }

}
