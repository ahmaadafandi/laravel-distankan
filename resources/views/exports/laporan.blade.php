<!DOCTYPE html>
<html>
    <head>
    </head>
    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">
            @foreach($daftar_proyeks_pilihan as $row)
            <div class="container">
                <div class="row">
                    <div class="col-lg-4">
                        <h5>Nama Proyek : {{ $row->nama_proyek }}</h5>
                    </div>	
                </div>
                <div class="row">
                    <div class="col-lg-4">
                        <h5><pre>Anggaran : <?php $RpanggaranProyek=number_format($row->anggaran,2,',','.'); echo "Rp $RpanggaranProyek"; ?></pre></h5>
                    </div>		
                </div>
                <div class="row">
                    <div class="col-lg-4">
                        <h5>Sisa Anggaran : <?php $RpsisaAnggranProyek=number_format($row->anggaran,2,',','.'); echo "Rp $RpsisaAnggranProyek";?></h5>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8">
                        <?php
                        $today = date('y-m-d');
                        $tgl_today = strtotime($today);

                        $Time_selesaiProyek = strtotime($row->selesai_proyek);
                        $jeda = abs($Time_selesaiProyek-$tgl_today);
                        $sisaHari = floor($jeda/(60*60*24));

                        if($row->status == 'Selesai'){ ?>
                            <h5><?php echo date('d F Y', strtotime($row->mulai_proyek)); ?> s/d <?php echo date('d F Y', strtotime($row->selesai_proyek)); ?></h5>
                        <?php }else{ 
                            if($tgl_today < $Time_selesaiProyek){ ?>
                            <h5>Waktu Pengerjaan : <?php echo date('d F Y', strtotime($row->mulai_proyek)); ?> s/d <?php echo  date('d F Y', strtotime($row->selesai_proyek)); ?><span style="color:#c20000; font-weight: bold;">(<?php echo "Sisa $sisaHari Hari"; ?>)</span></h5>
                            <?php }elseif($tgl_today > $Time_selesaiProyek){ ?>
                            <h5>Waktu Pengerjaan : <?php echo date('d F Y', strtotime($row->mulai_proyek)); ?> s/d <?php echo  date('d F Y', strtotime($row->selesai_proyek)); ?><span style="color:#c20000; font-weight: bold;">(<?php echo "Terlambat (Minus) $sisaHari Hari"; ?>)</span></h5>
                            <?php }else{ ?>
                            <h5>Waktu Pengerjaan : <?php echo date('d F Y', strtotime($row->mulai_proyek)); ?> s/d <?php echo  date('d F Y', strtotime($row->selesai_proyek)); ?><span style="color:#c20000; font-weight: bold;">(<?php echo "Hari ini deadline proyek"; ?>)</span></h5>
                            <?php } 
                        } ?>
                    </div>
                </div>
            </div>
            <br>     
            @endforeach
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <h3>Rincian Kegiatan</h3>
                    </div>
                    <br>
                    <div class="col-lg-12">
                        <?php $no = 1; ?>
                        <table id="mytable" class="table table-bordered table-striped">
                            <thead>
                                <tr>     
                                    <th>No</th>
                                    <th>Nama Kegiatan</th>
                                    <th>Unit</th>
                                    <th>Harga Satuan</th>
                                    <th>Anggaran</th>
                                    <th>Tanggal</th>
                                    <th>Gambar</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                                foreach($kegiatan_proyeks as $isi) {
                                    $harga = number_format($isi->harga,2,',','.');

                                    $anggaran=number_format($isi->anggaran,2,',','.'); 
                            ?>
                                <tr>
                                    <td>{{ $no }}</td>
                                    <td>{{ $isi->kegiatan }}</td>
                                    <td><?php echo $isi->unit; echo " ";
                                    echo $isi->satuan; ?></td>
                                    <td><?php echo "Rp $isi->harga"; echo" /"; echo $isi->satuan; ?></td>
                                    <td><?php echo "RP $anggaran" ?></td>
                                    <td><?php echo date('d F Y', strtotime($isi->created_at)); ?></td>
                                    <td>
                                        <a class="thumbnail fancybox" rel="ligthbox" href="http://localhost:8000/assets/img/{{ $isi->gambar }}">
                                            <?php echo $isi->gambar; ?>
                                        </a>         
                                    </td>
                                </tr>
                                <?php $no++; } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>