<?php

namespace App\Models\Helpers;

use Illuminate\Database\Eloquent\Model;

class GeografiUsaha_Dev extends Model
{
    protected $table = 'geografi_usaha_dev'; 
    protected $primaryKey = 'id_badan_usaha';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = true;
    protected $guarded = ['id'];


}
