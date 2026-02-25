<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MitraUmkm extends Model
{


    // Nama tabel jika tidak mengikuti aturan plural Laravel
    protected $table = 'umkm_mitra';


    protected $fillable = [
        'id_badan_usaha',
        'nama_mitra',
        'alamat_mitra',
        'hp_mitra',
        'update_at',
        'created_at'
    ];


    public $timestamps = true;

}
