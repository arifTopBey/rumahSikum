<?php

namespace App\Models\Helpers;

use Illuminate\Database\Eloquent\Model;

class LaporanKeuangan_Dev extends Model
{
    protected $table = 'usaha_laporan_keuangan_dev';
    protected $primaryKey = 'id_badan_usaha';
    public $incrementing = false;
    protected $keyType = 'int';
    public $timestamps = false;

    public function identitasUsaha()
    {
        return $this->belongsTo(IdentitasUsaha_Dev::class, 'id_badan_usaha', 'id_badan_usaha');
    }

    public function usahaKarakteristik()
    {
        return $this->hasOne(UsahaKarakteristik_Dev::class, 'id_badan_usaha', 'id_badan_usaha');
    }

    public function identitasPengusaha()
    {
        return $this->hasOne(IdentitasPengusaha_Dev::class, 'id_badan_usaha', 'id_badan_usaha');
    }

    public function produksiDanPemasaran(){
        return $this->hasOne(ProduksiDanPemasaran_Dev::class, 'id_badan_usaha', 'id_badan_usaha');
    }

    public function skalaUsaha(){

       return $this->hasOne(SkalaUsaha_Dev::class, 'id_badan_usaha', 'id_badan_usaha');

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
