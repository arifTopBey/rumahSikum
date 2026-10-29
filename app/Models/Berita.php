<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    protected $table = 'berita'; 
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = true;

    protected $guarded = ['id']; 

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id'); 
    }
    
    public function kategori()
    {
        return $this->belongsTo(KategoriBerita::class, 'kategori_id', 'id');
    }
}
