<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pengiriman extends Model
{
    protected $table = 'pengiriman';
    protected $fillable = [
        'id_surat', 'id_pengirim', 'id_penerima', 'metode_pembayaran', 
        'berat', 'jumlah_biaya', 'keterangan', 'status'];

    public function surat()
    {
        return $this->belongsTo('App\Surat', 'id_surat', 'id');
    }

    public function pelanggan_pengirim()
    {
        return $this->belongsTo('App\Pelanggan', 'id_pengirim', 'id');
    }

    public function pelanggan_penerima()
    {
        return $this->belongsTo('App\Pelanggan', 'id_penerima', 'id');
    }

    public function status_pengiriman()
    {
        return $this->hasMany('App\StatusPengiriman', 'id_pengiriman', 'id');
    }

    public function koli()
    {
        return $this->hasMany('App\Koli', 'id_pengiriman', 'id');
    }

    
}
