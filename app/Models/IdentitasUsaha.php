<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IdentitasUsaha extends Model
{
    protected $table = 'identitasusaha'; // Gunakan block 1 sebagai tabel dasar
    protected $primaryKey = 'id_badan_usaha';
    public $incrementing = false;
    protected $keyType = 'int';
    public $timestamps = false;


    protected $guarded = [];

    public function tanggalPendataan()
    {
        return $this->hasOne(TanggalPendataan::class, 'id_data_badan_usaha', 'id_badan_usaha');
    }

    public function usahaPerizinan(){
        return $this->hasOne(UsahaPerizinan::class, 'id_badan_usaha', 'id_badan_usaha');
    }

    public function usahaProduksiPemasaran()
    {
        return $this->hasOne(ProduksiDanPemasaran::class, 'id_badan_usaha', 'id_badan_usaha');
    }

    public function tenagaKerja()
    {
        return $this->hasOne(TenagaKerja::class, 'id_data_badan_usaha', 'id_badan_usaha');
    }

    public function laporanKeuangan()
    {
        return $this->hasOne(LaporanKeuangan::class, 'id_badan_usaha', 'id_badan_usaha');
    }
    public function usahaKarakteristik()
    {
        return $this->hasOne(UsahaKarakteristik::class, 'id_badan_usaha', 'id_badan_usaha');
    }

    public function scopeSearch($query, array $filters){
        $query->when($filters['search'] ?? false, function($query, $search){
            return  $query->where('nama_lengkap_usaha', 'like', '%' . $search . '%')
                ->orWhere('alamat_lengkap', 'like' , '%' . $search .'%')
                ->orWhere('telpon', 'like' , '%' . $search .'%');
        });
    }

    

}
