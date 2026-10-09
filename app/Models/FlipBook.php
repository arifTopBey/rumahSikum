<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FlipBook extends Model
{
    protected $table = 'flipbook'; 
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = false;

    protected $guarded = ['id'];
}
