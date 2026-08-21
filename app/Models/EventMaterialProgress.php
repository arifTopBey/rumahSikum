<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventMaterialProgress extends Model
{
     protected $table = 'event_material_progress'; 
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = true;

    protected $guarded = ['id']; 
}
