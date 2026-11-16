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

    public function materi(){
        return $this->hasMany(EventMaterial::class, 'event_organizer_id', 'id');
    }

    public function peserta(){
        return $this->hasMany(EventRegistration::class, 'event_organizer_id', 'id');
    }
}
