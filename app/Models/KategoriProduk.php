<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KategoriProduk extends Model
{
    // kategori_produk

    protected $table = 'kategori_produk';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'int';
    public $timestamps = false;

    protected $guarded = ['id'];

    public function produk(){
        return $this->hasMany(VendorProduk::class, 'kategori_produk_id', 'id');
    }
}
