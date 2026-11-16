<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfilBeranda extends Model
{
    protected $table = 'profil_beranda'; 
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = true;

    protected $guarded = ['id']; 
}
