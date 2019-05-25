<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    protected $table = 'pelanggan';
    protected $fillable = ['no_hp', 'jenis_kelamin', 'tgl_lahir', 'alamat', 'id_user'];

    public function user()
    {
        return $this->belongsTo('App\User', 'id_user', 'id');
    }

    public function pengiriman_pengirim()
    {
        return $this->hasMany('App\Pengiriman', 'id_pengirim', 'id');
    }

    public function pengiriman_penerima()
    {
        return $this->hasMany('App\Pengiriman', 'id_penerima', 'id');
    }

}
