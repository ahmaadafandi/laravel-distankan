<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\LogAktifitas;

class CrudUser extends Controller
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
            'nip'=> 'required|numeric',
            'nama' => 'required',
            'jabatan' => 'required'
        ]);

        $cekNip = User::where('nip', $request->nip)->first();
        if($cekNip){
            return redirect()->back()->with('alert',' Nip sudah ada!!');
            exit;
        }

        if($request->jabatan == "Kepala Dinas")
        {
            $cekJabatan = User::where('jabatan', $request->jabatan)->first();
            if($cekJabatan){    
                return redirect()->back()->with('alert', 'Jabatan untuk kepala dinas sudah ada');
                exit;
            }
        }elseif($request->jabatan == "Kepala Sub Bagian Program") 
        {
            $cekJabatan = User::where('jabatan', $request->jabatan)->first();
            if($cekJabatan){    
                return redirect()->back()->with('alert', 'Jabatan untuk kepala sub bagian program sudah ada');
                exit;
            }
        }else{
            
        }

        $data = new User(['nip'=>$request->nip,
            'nama' => $request->nama,
            'password'=>'-',
            'jabatan'=>$request->jabatan,
            'foto'=>'-',
            'status'=>'tidak aktif',
            'ket'=>'-',
            'waktu_login'=>'-']);

            $data->save();
            return redirect()->back()->with('alert-success','Data pegawai baru berhasil di tambahkan');    
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $this->validate($request, [
            'nama' => 'required',
            'jabatan' => 'required',
            'password' => 'required'
        ]);

        $user = User::where('nip', $request->nip)->first();

        $user->update([
            'password'=>bcrypt($request->password),
            'ket'=>'member'
        ]);

        return redirect()->back()->with('alert-success','Data user berhasil ditambahkan');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'nama' => 'required',
            'jabatan' => 'required'
        ]);

        $user = User::findOrFail($request->id);

        $cekKD = User::where('jabatan', $request->jabatan)->first();
        if($cekKD){
            return redirect()->back()->with('alert',' Kepala DInas Sudah Ada!!');
            exit;
        }

        $cekKSBP = User::where('jabatan', $request->jabatan)->first();
        if($cekKSBP){
            return redirect()->back()->with('alert',' Kepala Sub Bagian Progran Sudah Ada!!');
            exit;
        }

        $user->update([
            'nama'=>$request->nama,
            'jabatan'=>$request->jabatan
        ]);

        return redirect()->back()->with('alert-success','Data pegawai berhasil diedit!');
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
            'id' => 'required',
            'alasan' => 'required'
        ]);

        $log = new LogAktifitas([
            'user_id'=>$request->user_id,
            'aksi' => 'Menghapus Data Pegawai',
            'ket' => $request->nama,
            'alasan' => $request->alasan
        ]);

        $log->save();

        User::findOrFail($request->id)->delete();
        return redirect()->back()->with('alert-success','Data pegawai berhasil dihapus!');
    }

    public function getDataUser($nip)
    {
        $data = User::where('nip', $nip)->first();
        return $data;  
    }

    public function editStatusUser(Request $request)
    {
        $this->validate($request, [
            'nip' => 'required',
            'status' => 'required'
        ]);

        $data = User::where('nip', $request->nip)->first();

        if($request->password == ''){
            $data->update([
                'status' => $request->status
            ]);
        }else{
            $data->update([
                'password'=>bcrypt($request->password),
                'status' => $request->status
            ]);
        }

        return redirect()->back()->with('alert-success', 'Data user berhasil diedit');
    }
}
