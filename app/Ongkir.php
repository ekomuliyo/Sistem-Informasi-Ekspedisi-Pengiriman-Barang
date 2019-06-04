<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ongkir extends Model
{
    protected $table = 'ongkir';
    protected $fillable = ['asal', 'id_kecamatan', 'estimasi', 'harga'];
    
    public function kecamatan()
    {
        return $this->belongsTo('App\Kecamatan', 'id_kecamatan', 'id');
    }
}
