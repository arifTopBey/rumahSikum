<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kupon extends Model
{
    protected $table = 'kupons'; 
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = true;

    protected $guarded = ['id']; 
}
