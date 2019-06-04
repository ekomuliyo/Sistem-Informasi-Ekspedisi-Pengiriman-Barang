<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kota extends Model
{
    protected $table = 'kota';
    protected $fillable = ['kode', 'nama'];

    public function kecamatan()
    {
        return $this->hasMany('App\Kecamatan', 'id_kota', 'id');
    }
}
