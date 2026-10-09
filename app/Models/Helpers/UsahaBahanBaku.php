<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UsahaBahanBaku extends Model
{
    
    protected $table = 'usaha_bahan_baku_dev'; 
    protected $primaryKey = 'id_badan_usaha';
    public $incrementing = false;
    protected $keyType = 'int';
    public $timestamps = false;
}
