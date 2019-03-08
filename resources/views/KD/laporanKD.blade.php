@extends('Home')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-lg-2">
            <h5>Select Nama Proyek:</h5>
        </div>		
        <div class="col-lg-3">
            <div class="form-group mr-3 pl-0">
                <div class="icon-addon addon-md">
                    <form action="/pilihanKD">
                        {{ csrf_field() }}
                        <!-- pilih data proyek yang akan di cetak berdasarkan nama proyek -->
                        <select class="form-control selectpicker pl-0" data-live-search="true" name="id" id="pilihan" onchange="form.submit();">
                            <option value="">-Pilih-</option>
                            @foreach ($daftar_proyeks as $data)
                            <option value="{{ $data->id }}"> {{ $data->nama_proyek }}</option> 
                            @endforeach
                        </select>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php if($laporan > 0) {?>
@foreach($daftar_proyeks_pilihan as $row)
<div class="container">
    <div class="row">
        <div class="col-lg-2">
            <h5>Nama Proyek</h5>
        </div>		
        <div class="col-lg-8">
            <h5>{{ $row->nama_proyek }}</h5>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-2">
            <h5>Anggaran</h5>
        </div>		
        <div class="col-lg-8">
            <h5><?php $RpanggaranProyek=number_format($row->anggaran,2,',','.'); echo "Rp $RpanggaranProyek"; ?></h5>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-2">
            <h5>Sisa Anggaran</h5>
        </div>
        <div class="col-lg-8">
            <h5><?php $RpsisaAnggranProyek=number_format($row->anggaran,2,',','.'); echo "Rp $RpsisaAnggranProyek";?></h5>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-2">
            <h5>Waktu Pengerjaan</h5>
        </div>
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
                <h5> <?php echo date('d F Y', strtotime($row->mulai_proyek)); ?> s/d <?php echo  date('d F Y', strtotime($row->selesai_proyek)); ?><span style="color:#c20000; font-weight: bold;">(<?php echo "Sisa $sisaHari Hari"; ?>)</span></h5>
                <?php }elseif($tgl_today > $Time_selesaiProyek){ ?>
                <h5> <?php echo date('d F Y', strtotime($row->mulai_proyek)); ?> s/d <?php echo  date('d F Y', strtotime($row->selesai_proyek)); ?><span style="color:#c20000; font-weight: bold;">(<?php echo "Terlambat (Minus) $sisaHari Hari"; ?>)</span></h5>
                <?php }else{ ?>
                <h5> <?php echo date('d F Y', strtotime($row->mulai_proyek)); ?> s/d <?php echo  date('d F Y', strtotime($row->selesai_proyek)); ?><span style="color:#c20000; font-weight: bold;">(<?php echo "Hari ini deadline proyek"; ?>)</span></h5>
                <?php } 
            } ?>
        </div>
    </div>
</div>
@endforeach
<div class="container">
    <div class="row">
        <div class="col-lg-8">
            <h3>Rincian Kegiatan</h3>
        </div>
        <div class="col-lg-12">
            <?php $no = 1; ?>
            <table id="mytable" class="table table-bordered table-striped">
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
                                    <img src="http://localhost:8000/assets/img/{{ $isi->gambar }}" class="img-bukti">
                                </a>
                                
                        </td>
                    </tr>
                    <?php $no++; } ?>
                </tbody>
            </table>
        </div>
        <div class="col-lg-12 mt-3">
            <a href="/excel_laporan/{{ $row->id }}" class="btn btn-midnight pull-right ml-3">Simpan</a>
            <a href="/pdf_laporan/{{ $row->id }}" class="btn btn-midnight pull-right">Cetak</a>
        </div>
    </div>
</div>
<?php } ?>

<!-- <script type="text/javascript">
    $(document).ready(function(){
        $('#pilihan').on('change', function(e){
            var id = e.target.value;
            $.get('{{ url('pilihan')}}/'+id, function(data){
                console.log(id);
                console.log(data);
                $('#kegiatan_proyek').empty();
                $.each(data, function(laporan, element){
                    $('#nama_proyek').append(element.nama_proyek);
                });
            });
        });
    });
</script> -->
@endsection