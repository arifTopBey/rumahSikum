<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Keranjang extends Model
{
    protected $table = 'carts';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'int';
    public $timestamps = false;

    protected $guarded = ['id'];

     public function produk(){
        return $this->belongsTo(VendorProduk::class, 'produk_id', 'id');
    }

    // public function vendor(){
    //     return $this->belongsTo(Vendor::class, 'vendor_id', 'id');
    // }
}
