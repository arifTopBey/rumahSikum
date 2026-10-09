<?php

namespace App\Models\Helpers;


use Illuminate\Database\Eloquent\Model;

class IdentitasUsaha_Dev extends Model
{
    protected $table = 'identitasusaha_dev'; // 
    protected $primaryKey = 'id_badan_usaha';
    public $incrementing = false;
    protected $keyType = 'int';
    public $timestamps = false;


    protected $guarded = [];

    public function tanggalPendataan()
    {
        return $this->hasOne(TanggalPendataan_Dev::class, 'id_data_badan_usaha', 'id_badan_usaha');
    }

    public function usahaPerizinan(){
        return $this->hasOne(UsahaPerizinan_Dev::class, 'id_badan_usaha', 'id_badan_usaha');
    }

      public function usahaBahanBaku(){
        return $this->hasOne(UsahaBahanBaku_Dev::class, 'id_badan_usaha', 'id_badan_usaha');
    }

    public function usahaProduksiPemasaran()
    {
        return $this->hasOne(ProduksiDanPemasaran_Dev::class, 'id_badan_usaha', 'id_badan_usaha');
    }

    public function tenagaKerja()
    {
        return $this->hasOne(TenagaKerja_Dev::class, 'id_data_badan_usaha', 'id_badan_usaha');
    }

    public function laporanKeuangan()
    {
        return $this->hasOne(LaporanKeuangan_Dev::class, 'id_badan_usaha', 'id_badan_usaha');
    }
    public function usahaKarakteristik()
    {
        return $this->hasOne(UsahaKarakteristik_Dev::class, 'id_badan_usaha', 'id_badan_usaha');
    }
    public function identitasPengusaha()
    {
        return $this->hasOne(IdentitasPengusaha_Dev::class, 'id_badan_usaha', 'id_badan_usaha');
    }

    public function usahaProsesProduksi(){

        return $this->hasOne(UsahaProsesProduksi_Dev::class, 'id_badan_usaha', 'id_badan_usaha');

    }

     public function pembinaan(){
        return $this->hasOne(Pembinaan_Dev::class, 'id_badan_usaha', 'id_badan_usaha');
    }

    public function skalaUsaha(){
        return $this->hasOne(SkalaUsaha_Dev::class, 'id_badan_usaha', 'id_badan_usaha');
    }

     public function kemitraan(){
        return $this->hasOne(Kemitraan_Dev::class, 'id_badan_usaha', 'id_badan_usaha');
    }

    

    public function scopeSearch($query, array $filters){
        $query->when($filters['search'] ?? false, function($query, $search){
            return  $query->where('nama_lengkap_usaha', 'like', '%' . $search . '%')
                ->orWhere('alamat_lengkap', 'like' , '%' . $search .'%')
                ->orWhere('telpon', 'like' , '%' . $search .'%');
        });
    }

    

}
