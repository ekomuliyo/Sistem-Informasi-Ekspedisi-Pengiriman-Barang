<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cabang extends Model
{
    protected $table = "cabang";
    protected $fillable = ['alamat', 'no_hp', 'id_user'];

    public function user()
    {
        return $this->belongsTo('App\User', 'id_user', 'id');
    }

}
