<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
   
    protected $table = 'orders'; 
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = true;

    protected $guarded = ['id'];

    // Relasi ke User (Pembeli)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    // Relasi ke Detail Pesanan
    public function details()
    {
        return $this->hasMany(OrderDetail::class, 'order_id', 'id');
    }
}
