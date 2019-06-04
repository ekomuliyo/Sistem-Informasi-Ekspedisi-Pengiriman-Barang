<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailStatusPengiriman extends Model
{
    protected $table = 'detail_status_pengiriman';
    protected $fillable = ['id_status_pengiriman', 'keterangan', 'id_user'];

    public function status_pengiriman()
    {
        return $this->belongsTo('App\StatusPengiriman', 'id_status_pengiriman', 'id');
    }
}
