<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kecamatan extends Model
{
    protected $table = 'kecamatan';
    protected $fillable = ['id_kota', 'nama'];

    public function ongkir()
    {
        return $this->hasMany('App\Ongkir', 'id_kecamatan', 'id');
    }

    public function pengiriman_kecamatan_pengirim()
    {
        return $this->hasMany('App\Pengiriman', 'id_kecamatan_pengirim', 'id');
    }

    public function pengiriman_kecamatan_penerima()
    {
        return $this->hasMany('App\Pengiriman', 'id_kecamatan_penerima', 'id');
    }

    public function kota()
    {
        return $this->belongsTo('App\Kota', 'id_kota', 'id');
    }

    public function pelanggan()
    {
        return $this->hasOne('App\Pelanggan', 'id_kecamatan', 'id');
    }
}
