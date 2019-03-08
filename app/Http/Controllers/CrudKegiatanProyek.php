<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\KegiatanProyek;

class CrudKegiatanProyek extends Controller
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
            'kegiatan' => 'required',
            'unit' => 'required',
            'harga' => 'required',
            'satuan' => 'required',
            'gambar' => 'required'
        ]);

        $unit = $request->unit;
        $h = $request->harga;
        $harga = str_replace( '.', '', $h );
        $anggaran = $unit * $harga;

        if($request->hasfile('gambar'))
        {
            $destination = "assets/img";
            $gambar = $request->file('gambar');
            $gambar->move($destination, $gambar->getClientOriginalName());

            $data = new KegiatanProyek(['proyek_id'=>$request->proyek_id,
            'kegiatan'=>$request->kegiatan,
            'unit'=>$request->unit,
            'harga'=>$harga,
            'satuan'=>$request->satuan,
            'anggaran'=>$anggaran,
            'gambar'=> $request->file('gambar')->getClientOriginalName()]);

            $data->save();
            return redirect()->back()->with('alert-success','Data kegiatan berhasil disimpan!');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $kegiatan_proyeks = KegiatanProyek::all();
        return view('edit.edit_kegiatan', compact('kegiatan_proyeks'));
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
            'kegiatan' => 'required',
            'unit' => 'required',
            'harga' => 'required',
            'satuan' => 'required'
        ]);

        $kegiatan_proyeks = KegiatanProyek::findOrFail($request->id);

        $kegiatan = $request->kegiatan;
        $unit = $request->unit;
        $satuan = $request->satuan;
        $h = $request->harga;
        $harga = str_replace( '.', '', $h );
        $anggaran = $unit * $harga;

        if($request->hasfile('gambar'))
        {
            $destination = "assets/img";
            $gambar = $request->file('gambar');
            $gambar->move($destination, $gambar->getClientOriginalName());

            $kegiatan_proyeks->update([
                'kegiatan'=>$request->kegiatan,
                'unit'=>$request->unit,
                'harga'=>$harga,
                'satuan'=>$request->satuan,
                'anggaran'=>$anggaran,
                'gambar'=>$request->file('gambar')->getClientOriginalName()
            ]);

            $kegiatan_proyeks->update();
        } else{

            $kegiatan_proyeks->update([
                'kegiatan'=>$request->kegiatan,
                'unit'=>$request->unit,
                'harga'=>$harga,
                'satuan'=>$request->satuan,
                'anggaran'=>$anggaran,
            ]);

        }

        return redirect()->back()->with('alert-success','Data kegiatan berhasil diedit!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        KegiatanProyek::findOrFail($request->id)->delete();
        return redirect()->back()->with('alert-success','Data kegiatan berhasil dihapus!');
    }

    public function getDataKegiatan($id)
    {
        $data = KegiatanProyek::findOrFail($id);
        return $data;   
    }
}
