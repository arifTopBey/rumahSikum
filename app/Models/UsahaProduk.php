<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UsahaProduk extends Model
{
    protected $table = 'usaha_produk'; // Gunakan block 1 sebagai tabel dasar
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'int';
    public $timestamps = false;

}
