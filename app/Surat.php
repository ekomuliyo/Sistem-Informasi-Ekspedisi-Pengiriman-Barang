<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Surat extends Model
{
    protected $table = 'surat';
    protected $fillable = ['nomor_surat', 'id_kurir', 'tgl_surat'];

    public function kurir()
    {
        return $this->belongsTo('App\Kurir', 'id_kurir', 'id');
    }

    public function pengiriman()
    {
        return $this->hasMany('App\Pengiriman', 'id_kurir', 'id');
    }
    
}
