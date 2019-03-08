<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KegiatanProyek extends Model
{
    protected $fillable = ['proyek_id', 'kegiatan', 'unit', 'satuan', 'harga', 'anggaran', 'gambar'];

    public function daftar_proyeks(){
        return $this->belongsTo(DaftarProyek::class);
    } 
}
