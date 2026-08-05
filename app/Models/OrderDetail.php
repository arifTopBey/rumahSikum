<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $table = 'order_details'; 
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = true;

    protected $guarded = ['id'];

    // Relasi ke Header Order
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id', 'id');
    }

    // Relasi ke Produk
    public function produk()
    {
        return $this->belongsTo(VendorProduk::class, 'produk_id', 'id');
    }

    // Relasi ke Vendor
    public function vendor()
    {
        return $this->belongsTo(Vendor::class, 'vendor_id', 'id');
    }
}
