<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use App\DaftarProyek;
use App\KegiatanProyek;

class KSBPController extends Controller
{
    public function list_proyek_KSBP(){
        $daftarproyeks = DaftarProyek::all(); 
        return view('KSBP.list_proyek_KSBP', compact('daftarproyeks'));
    }

    public function laporan(){
        $laporan = 0;
        $daftar_proyeks = DaftarProyek::where('status', 'Selesai')->get();
        return view('KSBP.laporan', compact('daftar_proyeks', 'laporan', 'kegiatan_proyeks'));
        
    }

    public function detail_proyek_KSBP($id){
        $kegiatan_proyeks = KegiatanProyek::where('proyek_id','=',$id)->get();
        $daftar_proyeks = DaftarProyek::where('id','=',$id)->get();
        return view('KSBP.detail_proyek_KSBP', compact('kegiatan_proyeks', 'daftar_proyeks'));
    }

    public function pilihan(Request $request){
        $laporan = 1;
        $daftar_proyeks = DaftarProyek::where('status', 'Selesai')->get();
        $daftar_proyeks_pilihan = DaftarProyek::where('id',$request->id)->get();
        $kegiatan_proyeks = KegiatanProyek::where('proyek_id', $request->id)->get();
        return view('KSBP.laporan', compact('daftar_proyeks', 'daftar_proyeks_pilihan', 'laporan', 'kegiatan_proyeks'));   
    }
}
