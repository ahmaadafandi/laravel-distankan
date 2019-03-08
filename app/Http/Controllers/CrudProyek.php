<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\DaftarProyek;
use App\User;
use App\LogAktifitas;

class CrudProyek extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {       
        $this->validate($request, [
            'nomor_proyek'=> 'required',
            'nama_proyek' => 'required',
            'anggaran' => 'required',
            'mulai_proyek' => 'required',
            'selesai_proyek' => 'required'
        ]);

        $ang = $request->anggaran;
        $anggaran = str_replace( '.', '', $ang );
        
        $cek = DaftarProyek::where('nama_proyek', $request->nama_proyek)->first();
        if($cek){
            return redirect()->back()->with('alert','Proyek tersebut sudah ada!!');
            exit;
        }

        $data = new DaftarProyek(['user_id'=>$request->user_id,
            'nomor_proyek' => $request->nomor_proyek,
            'nama_proyek'=>$request->nama_proyek,
            'mulai_proyek'=>$request->mulai_proyek,
            'selesai_proyek'=>$request->selesai_proyek,
            'anggaran'=>$anggaran,
            'sisa_anggaran'=>$anggaran,
            'status'=> 'Menunggu Persetujuan',
            'ket' => '']);

        $log = new LogAktifitas(['user_id'=>$request->user_id,
            'aksi' => 'Menambah Proyek',
            'ket' => $request->nama_proyek,
            'alasan' => ''
        ]);

        $log->save();
        $data->save();
        return redirect()->back()->with('alert-success','Proyek baru berhasil di tambahkan, silahkan tunggu konfirmasi pengesahan dari kepala dinas');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $this->validate($request, [
            'user_id' => 'required',
            'alasan' => 'required'
        ]);

        $log = new LogAktifitas ([
            'user_id'=>$request->user_id,
            'aksi' => 'Menghapus Proyek',
            'ket' => $request->nama_proyek,
            'alasan' => $request->alasan
        ]);

        $log->save();

        DaftarProyek::findOrFail($request->id)->delete();
        return redirect()->back()->with('alert-success','Data proyek berhasil dihapus!');
    }

    public function proyekSelesai(Request $request) 
    {
        $id = $request->proyek_id;
        $user_id = $request->user_id;
        DaftarProyek::where('id', $id)->update(['status' => 'Selesai']);
        return redirect(route('pegawai.proyekBerjalan', ['id' => $user_id]));
    }

    public function setujuiProyek(Request $request) 
    {
        $id = $request->id;
        DaftarProyek::where('id', $id)->update(['status' => 'Sedang Berjalan']);
        return redirect()->back()->with('alert-success','Proyek telah disetujui!');
    }

    public function ditolak(Request $request) 
    {
        $id = $request->id;
        DaftarProyek::where('id', $id)->update(['status' => 'Ditolak']);
        return redirect()->back()->with('alert-success','Proyek telah ditolak!');
    }
}
