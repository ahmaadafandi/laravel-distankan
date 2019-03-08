<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\DaftarProyek;
use App\KegiatanProyek;

class PegawaiController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function tambahProyek(){
        $endRow = DaftarProyek::orderBy('id', 'DESC')->limit(1)->get();
        return view('pegawai.tambah_proyek', compact('endRow'));
    }

    public function proyekBerjalan($id){
        $daftarproyeks = DaftarProyek::where('user_id', $id)->get(); 
        return view('pegawai.proyek_berjalan', compact('daftarproyeks'));
    }

    public function detail_proyek_berjalan($id){
        $kegiatan_proyeks = KegiatanProyek::where('proyek_id','=',$id)->get();
        $daftar_proyeks = DaftarProyek::where('id','=',$id)->get();
        return view('pegawai.detail_proyek_berjalan', compact('kegiatan_proyeks', 'daftar_proyeks', 'id'));
    }
}
