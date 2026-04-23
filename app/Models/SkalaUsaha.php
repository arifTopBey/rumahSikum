<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SkalaUsaha extends Model
{
    
    protected $table = 'skala_usaha'; 
    protected $primaryKey = 'id_badan_usaha';
    public $incrementing = false;
    protected $keyType = 'int';
    public $timestamps = false;

    public function identitasUsaha(){
        return $this->belongsTo(IdentitasUsaha::class, 'id_badan_usaha', 'id_badan_usaha');
    }

     public function scopeSearch($query, array $filters){
        $query->when($filters['search'] ?? false, function($query, $search) {
            
            return $query->where(function($q) use ($search) {
                
                // Pencarian di tabel relasi (IdentitasUsaha)
                $q->orWhereHas('identitasUsaha', function($qRelasi) use ($search) {
                            $qRelasi->where('nama_lengkap_usaha', 'like', '%' . $search . '%')
                        ->orWhere('alamat_lengkap', 'like' , '%' . $search .'%')
                        ->orWhere('telpon', 'like' , '%' . $search .'%');// contoh kolom lain
                });
            });
        });
    }
}
