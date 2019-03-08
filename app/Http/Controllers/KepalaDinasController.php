<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DaftarProyek;
use App\KegiatanProyek;
use App\User;
use App\LogAktifitas;

use App\Exports\LaporanViewExport;
use Excel;
use PDF;

class KepalaDinasController extends Controller
{
    public function laporan_realisasi_proyek(){
        $daftar_proyeks = DaftarProyek::where('status', 'Selesai')->get(); 
        return view('KD.laporan_realisasi_proyek', compact('daftar_proyeks'));
    }

    public function detail_proyek_KD($id){
        $kegiatan_proyeks = KegiatanProyek::where('proyek_id','=',$id)->get();
        $daftar_proyeks = DaftarProyek::where('id','=',$id)->get();
        return view('KD.detail_proyek_KD', compact('kegiatan_proyeks', 'daftar_proyeks'));
    }

    public function proyek(){
        $daftar_proyeks = DaftarProyek::where('status', 'Sedang Berjalan')->get(); 
        return view('KD.proyek', compact('daftar_proyeks'));
    }

    public function persetujuan_proyek(){
        $daftar_proyeks = DaftarProyek::all(); 
        return view('KD.persetujuan_proyek', compact('daftar_proyeks'));
    }

    public function daftar_pegawai(){
        $user = User::where('status', '!=', '-')->get();
        return view('KD.daftar_pegawai', compact('user'));
    }

    public function daftar_user(){
        $pilihUser = User::where('ket', '-')->get();
        $user = User::where('ket', 'member')->get();
        return view('KD.daftar_user', compact('user', 'pilihUser'));
    }

    public function laporanKD(){
        $laporan = 0;
        $daftar_proyeks = DaftarProyek::where('status', 'Selesai')->get();
        return view('KD.laporanKD', compact('daftar_proyeks', 'laporan', 'kegiatan_proyeks'));
    }

    public function Log_Aktivitas(){
        $log_aktivitas = LogAktifitas::all();
        return view('KD.log_aktivitas', compact('log_aktivitas'));
    }

    public function pilihanKD(Request $request)
    {
        $laporan = 1;
        $daftar_proyeks = DaftarProyek::where('status', 'Selesai')->get();
        $daftar_proyeks_pilihan = DaftarProyek::where('id',$request->id)->get();
        $kegiatan_proyeks = KegiatanProyek::where('proyek_id', $request->id)->get();
        return view('KD.laporanKD', compact('daftar_proyeks', 'daftar_proyeks_pilihan', 'laporan', 'kegiatan_proyeks'));
    }

    public function export_laporan($id)
    {
        return Excel::download(new LaporanViewExport($id), 'laporan.xlsx');
    }

    public function PDF_laporan($id)
    {
        $daftar_proyeks_pilihan = DaftarProyek::where('id',$id)->get();
        $kegiatan_proyeks = KegiatanProyek::where('proyek_id', $id)->get();

        $pdf = PDF::loadView('exports.laporan', compact('daftar_proyeks_pilihan', 'kegiatan_proyeks'));

        return $pdf->download('laporan.pdf');
    }

}
