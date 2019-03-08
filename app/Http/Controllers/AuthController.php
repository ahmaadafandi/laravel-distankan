<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

use App\User;

class AuthController extends Controller
{
    public function index(){
        return view('login');
    }

    public function loginPost(Request $request){
        $nip = $request->nip;
        // $password = $request->password;
        
        $data = User::where('nip', $nip)->first();
        // if($data){ //apakah email tersebut ada atau tidak

        //     if('aktif' == $data->status){
        //         if($password == $data->password){
        //             Session::put('id', $data->id);
        //             Session::put('nip', $nip);
        //             Session::put('nama', $data->nama);
        //             Session::put('jabatan', $data->jabatan);
        //             Session::put('status', $data->status);

        //             User::where('nip', $nip)->update(['waktu_login' => NOW()]);

        //             if($data->jabatan == "Pegawai"){
        //                 return redirect('tambahProyek');
        //             }elseif($data->jabatan == "Kepala Sub Bagian Program"){
        //                 return redirect('listProyekKSBP');
        //             }elseif($data->jabatan == "Kepala Dinas"){
        //                 return redirect('laporan_realisasi_proyek');
        //             }else {
        //                 return redirect('login')->with('alert','Jabatan Tidak Ada!!');
        //             }
        //         }
        //         else{
        //             return redirect('login')->with('alert','Password Anda Salah !');
        //         }
        //     }
        //     else{
        //         return redirect('login')->with('alert','Akun tidak aktif!');
        //     }
        // }
        // else{
        //     return redirect('login')->with('alert','Nip Anda Salah!');
        // }
        
        if(\Auth::attempt(['nip' => $request->nip, 'password' =>$request->password])){
            User::where('nip', $nip)->update(['waktu_login' => NOW()]);
            
            if('aktif' == $data->status){
                if($data->jabatan == "Administrator"){
                    return redirect('/laporan_realisasi_proyek');
                }elseif($data->jabatan == "Pegawai"){
                    return redirect('/tambahProyek');
                }elseif($data->jabatan == "Kepala Sub Bagian Program"){
                    return redirect('listProyekKSBP');
                }elseif($data->jabatan == "Kepala Dinas"){
                    return redirect('laporan_realisasi_proyek');
                }else {
                    return redirect('login')->with('alert','Jabatan Tidak Ada!!');
                }
            }else{
                \Auth::logout();
                return redirect('login')->with('alert','Akun tidak aktif!');
            }
        }else{
            return redirect('login')->with('alert','Nip atau password Anda Salah!');
        }
    }

    public function logout(){
        \Auth::logout();
        return redirect('login')->with('alert','Kamu sudah logout');
    }

    public function ubah_gambar(Request $request)
    {
        $this->validate($request, [
            'user_id' => 'required',
            'foto_profil' => 'required'
        ]);

        if($request->hasfile('foto_profil'))
        {
            $destination = "assets/img";
            $foto_profil = $request->file('foto_profil');
            $foto_profil->move($destination, $foto_profil->getClientOriginalName());

            User::where('id', $request->user_id)->update([
                'foto'=> $request->file('foto_profil')->getClientOriginalName()
            ]);

            return redirect()->back()->with('alert-success', 'Foto profil berhasil di ubah');
        }
    }
}
