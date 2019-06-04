<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nama', 'email', 'password', 'foto', 'level'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function cabang()
    {
        return $this->hasOne('App\Cabang', 'id_user', 'id');
    }

    public function kurir()
    {
        return $this->hasOne('App\Kurir', 'id_user', 'id');
    }

    public function pelanggan()
    {
        return $this->hasOne('App\Pelanggan', 'id_user', 'id');
    }


}
