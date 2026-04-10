<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KategoriAcara extends Model
{
    protected $table = 'kategori_acara'; 
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = true;
    protected $guarded = ['id'];
    
    public function acara()
    {
        return $this->hasMany(Acara::class, 'kategori_acara_id', 'id');
    }
}
