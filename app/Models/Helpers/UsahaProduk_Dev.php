<?php

namespace App\Models\Helpers;

use Illuminate\Database\Eloquent\Model;

class UsahaProduk_Dev extends Model
{
    protected $table = 'usaha_produk_dev'; 
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'int';
    public $timestamps = false;

}
