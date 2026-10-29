<?php

namespace App\Models\Helpers;

use Illuminate\Database\Eloquent\Model;

class UsahaKarakteristik_Dev extends Model
{
    // block 2
    protected $table = 'usaha_karakteristik_dev'; 
    protected $primaryKey = 'id_badan_usaha';
    public $incrementing = false;
    protected $keyType = 'int';
    public $timestamps = false;

    protected $guarded = ['id_badan_usaha'];

    public function identitasUsaha()
    {
        return $this->belongsTo(IdentitasUsaha_Dev::class, 'id_badan_usaha', 'id_badan_usaha');
    }

    public function keuangan(){
        return $this->belongsTo(LaporanKeuangan_Dev::class, 'ida_badan_usaha', 'id_badan_usaha');
    }

    public function skalaUsaha(){
        return $this->belongsTo(SkalaUsaha_Dev::class, 'id_badan_usaha', 'id_badan_usaha');
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
