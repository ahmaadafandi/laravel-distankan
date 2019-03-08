<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LogAktifitas extends Model
{
    protected $fillable = ['user_id', 'aksi', 'ket', 'alasan'];

    public function user(){
        return $this->belongsTo(User::class);
    } 
}
