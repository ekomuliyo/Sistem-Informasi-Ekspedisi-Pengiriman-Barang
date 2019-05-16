<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pengiriman extends Model
{
    protected $table = 'pengiriman';
    protected $fillable = [
        'id_surat', 'id_pengirim', 'id_penerima', 'metode_pembayaran', 
        'berat', 'jumlah_biaya', 'keterangan', 'status'];

    public function pelangganPengirim()
    {
        return $this->belongsTo('App\Pelanggan', 'id_pengirim', 'id');
    }

    public function pelangganPenerima()
    {
        return $this->belongsTo('App\Pelanggan', 'id_penerima', 'id');
    }

    
}
