<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VendorPayment extends Model
{
    protected $table = 'vendor_payment_methods'; 
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = true;

    protected $guarded = ['id']; 

   public function vendor(){
        return $this->belongsTo(Vendor::class, 'vendor_id', 'id');
    }

    
}
