<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PopupBanner extends Model
{
    //popup_banners

    protected $table = 'popup_banners'; 
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = true;

    protected $guarded = ['id']; 

}
