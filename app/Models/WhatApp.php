<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WhatApp extends Model
{
    protected $table = 'whatapp'; 
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = false;

    protected $guarded = ['id']; 

    public function scopeSearch($query, $keyword)
{
    if (!$keyword) return $query;

    return $query->where(function ($q) use ($keyword) {
        $q->where('no_wa', 'like', "%{$keyword}%")
          ->orWhere('message', 'like', "%{$keyword}%")
          ->orWhere('status', 'like', "%{$keyword}%")
          ->orWhere('id_message', 'like', "%{$keyword}%");
    });
}

}
