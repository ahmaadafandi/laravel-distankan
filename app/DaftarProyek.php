<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DaftarProyek extends Model
{
    protected $fillable = ['user_id', 'nomor_proyek', 'nama_proyek', 
    'mulai_proyek', 'selesai_proyek', 'anggaran', 'sisa_anggaran', 'status', 'ket'];

    public function user(){
        return $this->belongsTo(User::class);
    } 

    public function kegiatan_proyeks(){
        return $this->hasMany(KegiatanProyek::class);
    }
}
