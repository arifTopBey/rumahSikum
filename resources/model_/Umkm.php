<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Umkm extends Model
{
    protected $table = 'umkm_block_1'; // Gunakan block 1 sebagai tabel dasar
    protected $primaryKey = 'id_badan_usaha';
    public $incrementing = false;
    protected $keyType = 'int';
    public $timestamps = false;

    // protected $fillable = [
    //     'id_badan_usaha',
    //     'provinsi',
    //     'kabupaten',
    //     'kecamatan',
    //     'kelurahan',
    //     'nama_usaha',
    //     'tempat_usaha',
    //     'alamat',
    //     'telepon',
    // ];
    protected $guarded = []; // Atau gunakan $fillable jika ingin menentukan kolom yang bisa diisi

    // Relasi ke block 2
    public function block2(){
        return $this->hasOne(UmkmBlock2::class, 'id_badan_usaha', 'id_badan_usaha');
    }
    public function block3(){
        return $this->hasOne(UmkmBlock3::class, 'id_badan_usaha', 'id_badan_usaha');
    }
    public function block4(){
        return $this->hasOne(UmkmBlock4::class, 'id_badan_usaha', 'id_badan_usaha');
    }
    public function block5(){
        return $this->hasOne(UmkmBlock5::class, 'id_badan_usaha', 'id_badan_usaha');
    }
    public function block6(){
        return $this->hasOne(UmkmBlock6::class, 'id_badan_usaha', 'id_badan_usaha');
    }
    public function block7(){
        return $this->hasOne(UmkmBlock7::class, 'id_badan_usaha', 'id_badan_usaha');
    }
    public function block8(){
        return $this->hasOne(UmkmBlock8::class, 'id_badan_usaha', 'id_badan_usaha');
    }
    public function block9(){
        return $this->hasOne(UmkmBlock9::class, 'id_badan_usaha', 'id_badan_usaha');
    }
    public function block10(){
        return $this->hasOne(UmkmBlock10::class, 'id_badan_usaha', 'id_badan_usaha');
    }
    public function block11(){
        return $this->hasOne(UmkmBlock11::class, 'id_badan_usaha', 'id_badan_usaha');
    }
    public function block12(){
        return $this->hasOne(UmkmBlock12::class, 'id_badan_usaha', 'id_badan_usaha');
    }
   
}
