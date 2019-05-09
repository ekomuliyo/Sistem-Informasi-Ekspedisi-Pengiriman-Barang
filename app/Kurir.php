<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kurir extends Model
{
    protected $table = 'kurir';
    protected $fillable = ['no_hp', 'alamat', 'nama_kendaraan', 'nomor_polisi'];

    public function user()
    {
        return $this->belongsTo('App\User', 'id_user', 'id');
    }
}
