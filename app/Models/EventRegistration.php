<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventRegistration extends Model
{
    //event_registrations

    protected $table = 'event_registrations'; 
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = true;

    protected $guarded = ['id']; 

    public function event(){
        return $this->belongsTo(EventOrganizer::class, 'event_organizer_id', 'id');
    }

     public function progress(){
        return $this->hasMany(EventMaterialProgress::class,'event_registration_id', 'id');
    }
     public function eventOrganizer(){
        return $this->belongsTo(EventOrganizer::class,'event_organizer_id', 'id');
    }


}
