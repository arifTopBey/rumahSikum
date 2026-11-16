<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KategoriEventOrganizer extends Model
{
    //kategori_event_organizers

    protected $table = 'kategori_event_organizers'; 
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = true;
    protected $guarded = ['id'];
    
}
