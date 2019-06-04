<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransaksiPengirimanSurat extends Model
{
    protected $table = 'transaksi_pengiriman_surat';
    protected $fillable = ['id_pengiriman', 'id_surat'];

    public function pengiriman()
    {
        return $this->belongsTo('App\Pengiriman', 'id_pengiriman', 'id');
    }

    public function surat()
    {
        return $this->belongsTo('App\Surat', 'id_surat', 'id');
    }
}
