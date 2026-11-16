<?php

namespace App\Models\Helpers;

use Illuminate\Database\Eloquent\Model;

class Usaha_Penghargaan_Dev extends Model
{
    protected $table = 'usaha_penghargaan'; 
    protected $primaryKey = 'id_badan_usaha';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = true;
    protected $guarded = ['id'];

}
