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
        'nip', 'nama', 'jabatan', 'password', 'foto', 'status', 'ket', 'waktu_login',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function daftar_proyeks(){
        return $this->hasMany(DaftarProyek::class);
    }

    public function log_aktivitas(){
        return $this->hasMany(LogAktifitas::class);
    }
}
