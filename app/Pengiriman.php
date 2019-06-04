<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pengiriman extends Model
{
    protected $table = 'pengiriman';
    protected $fillable = ['no_resi', 'nama_pengirim', 'no_hp_pengirim', 'id_kecamatan_pengirim', 'alamat_pengirim',
                                    'nama_penerima', 'no_hp_penerima', 'id_kecamatan_penerima', 'alamat_penerima', 'metode_pembayaran', 
                                    'berat', 'jumlah_biaya', 'status_valid', 'status_surat', 'id_user'];


    public function kecamatan_pengirim()
    {
        return $this->belongsTo('App\Kecamatan', 'id_kecamatan_pengirim', 'id');
    }

    public function kecamatan_penerima()
    {
        return $this->belongsTo('App\Kecamatan', 'id_kecamatan_penerima', 'id');
    }

    public function status_pengiriman()
    {
        return $this->hasMany('App\StatusPengiriman', 'id_pengiriman', 'id');
    }

    public function koli()
    {
        return $this->hasMany('App\Koli', 'id_pengiriman', 'id');
    }

    public function transaksi_pengiriman()
    {
        return $this->hasMany('App\TransaksiPengirimanSurat', 'id_pengiriman', 'id');
    }

}
