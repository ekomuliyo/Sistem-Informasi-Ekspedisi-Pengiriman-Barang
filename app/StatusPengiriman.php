<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StatusPengiriman extends Model
{
    protected $table = 'status_pengiriman';
    protected $fillable = ['id_pengiriman', 'keterangan', 'id_user', 'status'];
    

    public function pengiriman()
    {
        return $this->belongsTo('App\Pengiriman', 'id_pengiriman', 'id');
    }
}
