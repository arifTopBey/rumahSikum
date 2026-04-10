<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Acara extends Model
{
     protected $table = 'acara'; 
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = true;

    protected $guarded = ['id']; 

    public function kategori_acara()
    {
        return $this->belongsTo(KategoriAcara::class, 'kategori_acara_id', 'id');
    }

}
