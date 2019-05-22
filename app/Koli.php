<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Koli extends Model
{
    protected $table = 'koli';
    protected $fillable = ['id_pengiriman', 'deskripsi'];

    public function pengiriman()
    {
        return $this->belongsTo('App\Pengiriman', 'id_pengiriman', 'id');
    }
}
