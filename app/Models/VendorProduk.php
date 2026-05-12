<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VendorProduk extends Model
{
    protected $table = 'produks'; 
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = true;

    protected $guarded = ['id']; 

     public function produkPhoto(){
        return $this->hasMany(ProdukPhoto::class, 'produk_id', 'id');
    }

    public function vendor(){
        return $this->belongsTo(Vendor::class, 'vendor_id', 'id');
    }

    public function kategori(){
        return $this->belongsTo(KategoriProduk::class, 'kategori_produk_id', 'id');
    }
}

