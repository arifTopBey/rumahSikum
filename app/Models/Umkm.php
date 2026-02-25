<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Umkm extends Model
{
    protected $table = "mitra_umkms";


    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id_badan_usaha';

    /**
     * The "type" of the primary key ID.
     *
     * @var string
     */
    protected $keyType = 'int';

    public $timestamps = true;


    protected $guarded = ['id_badan_usaha'];
}
