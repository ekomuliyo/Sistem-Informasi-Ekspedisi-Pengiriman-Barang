<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    protected $table = 'pelanggan';
    protected $fillable = ['no_hp', 'jenis_kelamin', 'tgl_lahir', 'id_kecamatan', 'alamat', 'id_user'];

    public function user()
    {
        return $this->belongsTo('App\User', 'id_user', 'id');
    }

    public function kecamatan()
    {
        return $this->belongsTo('App\Kecamatan', 'id_kecamatan', 'id');
    }

}
