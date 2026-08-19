<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventOrganizer extends Model
{
    protected $table = 'events_organizers'; 
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = true;

    protected $guarded = ['id']; 

    public function kategoriEventOrganizer(){
        return $this->belongsTo(KategoriEventOrganizer::class, 'kategori_organizer_id', 'id');
    }
}
