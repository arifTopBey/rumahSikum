<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
     
    protected $table = 'wishlists'; 
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = true;

    protected $guarded = ['id']; 

    public function produk(){
        return $this->belongsTo(VendorProduk::class, 'produk_id', 'id');
    }
}
