<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventMaterial extends Model
{
    // event_materials

    protected $table = 'event_materials'; 
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = true;

    protected $guarded = ['id']; 
}
