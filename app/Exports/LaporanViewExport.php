<?php

namespace App\Exports;

use App\DaftarProyek;
use App\KegiatanProyek;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;


class LaporanViewExport implements FromView
{
    public function __construct(int $id)
    {
        $this->id = $id;
    }

    public function view(): View
    {
        return view('exports.laporan', [
            'daftar_proyeks_pilihan' => DaftarProyek::where('id', $this->id)->get(),
            'kegiatan_proyeks' => KegiatanProyek::where('proyek_id', $this->id)->get()
        ]);
    }
}