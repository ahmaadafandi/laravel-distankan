@extends('Home')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <h2>Detail Proyek</h2>
        </div>  
    </div>
</div>

<div class="container">
    @foreach ($daftar_proyeks as $row)   
    <div class="row">
        <div class="col-lg-2">
            <h5>Nama Proyek:</h5>
        </div>		
        <div class="col-lg-8">
            <h5>{{ $row->nama_proyek }}</h5>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-2">
            <h5>Anggaran:</h5>
        </div>		
        <div class="col-lg-8">
            <h5><?php $RpanggaranProyek=number_format($row->anggaran,2,',','.'); echo "Rp $RpanggaranProyek"; ?></h5>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-2">
            <h5>Sisa Anggaran:</h5>
        </div>		
        <div class="col-lg-8">
            <h5><?php $RpsisaAnggaranProyek=number_format($row->sisa_anggaran,2,',','.'); echo "Rp $RpsisaAnggaranProyek"; ?></h5>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-2">
            <h5>Waktu Pengerjaan:</h5>
        </div>		
        <div class="col-lg-8">
            <?php 
            $today=date ("Y-m-d"); // mengambil data tgl hari ini ke dalam variabel today
            $tgl_today = strtotime($today); // mengubah variabel today kedalam format time yang disimpan pada variabel baru yaitu $tgl_today

            $Time_selesaiProyek = strtotime($row->selesai_proyek); // mengubah variabel $selesaiProyek ke dalam format time yang di simpan pada variabel baru yaitu $time_selesaiProyek
            $jeda = abs($Time_selesaiProyek - $tgl_today); // mengambil nilai jarak waktu
            $sisaHari = floor($jeda/(60*60*24));

            // jika status proyek selesai maka hanya menampilkan rentang waktu proyek tanpa menampilkan sisa hari pengerjaan proyek
            if($row->status == 'Selesai'){
                ?>
                <h5> <?php echo date('d F Y', strtotime($row->mulai_proyek)); ?> s/d <?php echo  date('d F Y', strtotime($row->selesai_proyek)); ?></h5>
                <?php }else{ 
                    if($tgl_today < $Time_selesaiProyek){ ?>
                    <h5> <?php echo date('d F Y', strtotime($row->mulai_proyek)); ?> s/d <?php echo  date('d F Y', strtotime($row->selesai_proyek)); ?><span style="color:#c20000; font-weight: bold;">(<?php echo "Sisa $sisaHari Hari"; ?>)</span></h5>
                    <?php }elseif($tgl_today > $Time_selesaiProyek){ ?>
                    <h5> <?php echo date('d F Y', strtotime($row->mulai_proyek)); ?> s/d <?php echo  date('d F Y', strtotime($row->selesai_proyek)); ?><span style="color:#c20000; font-weight: bold;">(<?php echo "Terlambat (Minus) $sisaHari Hari"; ?>)</span></h5>
                    <?php }else{ ?>
                    <h5> <?php echo date('d F Y', strtotime($row->mulai_proyek)); ?> s/d <?php echo  date('d F Y', strtotime($row->selesai_proyek)); ?><span style="color:#c20000; font-weight: bold;">(<?php echo "Hari ini deadline proyek"; ?>)</span></h5>
                    <?php } 
                } ?>
        </div>
    </div>
    @endforeach
    <div class="row"> 
        <div class="col-lg-12">
            <h3>Rincian Kegiatan</h3>
        </div>
        <?php $no = 1; ?>
        <div class="col-lg-12">		  
            <table id="mytable" class="table table-bordred table-striped">
                <thead>
                    <th>No</th>
                    <th>Nama Kegiatan</th>
                    <th>Unit</th>
                    <th>Harga Satuan</th>
                    <th>Anggaran</th>
                    <th>Tanggal</th>
                    <th>Gambar</th>
                </thead>
                <tbody>
                    <?php 
                // perulangan array untuk membaca seluruh data berdasarkan query di atas yaitu pada tabel kegiatan proyek
                    foreach ($kegiatan_proyeks as $data) { 
                        $harga=number_format($data->harga,2,',','.'); 	
                        $anggaran=number_format($data->anggaran,2,',','.'); ?>	
                        <tr>
                            <td>{{ $no }}</td>
                            <td>{{ $data->kegiatan }}</td>
                            <td><?php echo $data->unit; echo " "; echo $data->satuan;?></td>
                            <td><?php echo "Rp $data->harga"; echo " / "; echo $data->satuan;?></td>
                            <td><?php echo "Rp $anggaran"; ?></td>
                            <td><?php echo date('d F Y', strtotime($data->created_at)); ?></td>
                            <td>
                                <a class="thumbnail fancybox" rel="ligthbox" href="http://localhost:8000/assets/img/{{ $data->gambar }}">
                                    <img src="http://localhost:8000/assets/img/{{ $data->gambar }}" class="img-bukti">
                                </a>
                                
                            </td>
                        </tr>
                        <?php $no++; } ?>
                </tbody>
            </table>
        </div> 	
        <div class="clearfix"></div>
    </div>
</div>

@endsection