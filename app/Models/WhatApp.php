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

}
