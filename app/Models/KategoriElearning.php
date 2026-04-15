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
}
