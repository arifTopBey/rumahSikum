<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UsahaKemitraan extends Model
{
    
    protected $table = 'usaha_kemitraan'; 
    protected $primaryKey = 'id_badan_usaha';
    public $incrementing = false;
    protected $keyType = 'int';
    public $timestamps = false;
}
