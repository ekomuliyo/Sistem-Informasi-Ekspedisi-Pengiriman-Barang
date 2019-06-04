<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StatusPengiriman extends Model
{
    protected $table = 'status_pengiriman';
    protected $fillable = ['id_pengiriman', 'status'];
    
    public function detail_status_pengiriman()
    {
        return $this->hasMany('App\DetailStatusPengiriman', 'id_status_pengiriman', 'id');
    }

    public function pengiriman()
    {
        return $this->belongsTo('App\Pengiriman', 'id_pengiriman', 'id');
    }

}
