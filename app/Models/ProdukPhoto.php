<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProdukPhoto extends Model
{
    protected $table = 'photos_produks'; 
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = true;

    protected $guarded = ['id']; 

    public function vendorProduks(){
        return $this->belongsTo(VendorProduk::class, 'produk_id', 'id');
    }
}
