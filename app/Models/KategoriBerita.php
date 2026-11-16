<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KategoriBerita extends Model
{
    
    protected $table = 'kategori_berita'; // Gunakan block 1 sebagai tabel dasar
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = true;
    protected $guarded = [];
    
    public function berita()
    {
        return $this->hasMany(Berita::class, 'kategori_id', 'id');
    }

}
