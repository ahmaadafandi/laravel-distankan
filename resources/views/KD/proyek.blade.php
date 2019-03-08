@extends('Home')
@section('content')

<div class="row">   
    <div class="content-fill col-lg-12">
        <table id="mytable" class="table table-bordred table-striped col-lg-12" width="100%">
            <thead>
                <th>Nama Pegawai</th>
                <th>Proyek</th>
                <th>Anggaran</th>
                <th>Tanggal</th>
                <th>Status</th>
                <th>Sisa Waktu</th>
                <th>Aksi</th>
            </thead>
            <tbody>
                @foreach($daftar_proyeks as $row)							
                <?php $anggaran=number_format($row->anggaran,2,',','.') ?>	
                <tr>
                    <td>{{ $row->user->nama }}</td>
                    <td>{{ $row->nama_proyek }}</td>
                    <td>{{ $anggaran }}</td>
                    <td>{{ date('d F Y', strtotime($row->mulai_proyek)) }}</td>
                    <td>{{ $row->status }}</td>
                    <?php 
                        $selesaiProyek = $row->selesai_proyek;
                        $today=date ("Y-m-d"); // mengambil data tgl hari ini ke dalam variabel today
                        $tgl_today = strtotime($today);  // mengubah variabel today kedalam format time yang disimpan pada variabel baru yaitu $tgl_today

                        $Time_selesaiProyek = strtotime($selesaiProyek); // mengubah variabel selesai proyek ke dalam format time yang di simpan pada variabel baru yaitu $time_selesaiProyek
                        $jeda = abs($Time_selesaiProyek - $tgl_today); // mengambil nilai jarak waktu
                        $sisaHari = floor($jeda/(60*60*24));
                    ?>
                    @if($tgl_today < $Time_selesaiProyek)
                        <td><h5><span style="color:#c20000; font-weight: bold;"><?php echo "Sisa $sisaHari Hari"; ?></span></h5></td>
                    @elseif($tgl_today > $Time_selesaiProyek)
                        <td><h5><span style="color:#c20000; font-weight: bold;"><?php echo "Terlambat $sisaHari Hari"; ?></span></h5></td>
                    @else
                        <td><h5><span style="color:#c20000; font-weight: bold;"><?php echo "Hari ini deadline proyek"; ?></span></h5></td>
                    @endif
                    <td><a href="{{ url('detail_proyek_KD',$row->id) }}" class="btn btn-success btn-xs mr-3"><i class="glyphicon glyphicon-eye-open"></i></a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="clearfix"></div>
    </div>
</div>

@endsection