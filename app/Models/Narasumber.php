<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Narasumber extends Model
{
    //event_narasumber

    protected $table = 'event_narasumber'; 
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = true;

    protected $guarded = ['id']; 
}
