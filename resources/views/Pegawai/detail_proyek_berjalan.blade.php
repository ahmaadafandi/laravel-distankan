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
        <div class="col-lg-12 float-right mb-3">
            <button type="button" class="btn btn-midnight pull-right" id="openSpk" data-toggle="modal" data-target="#modalTambahKegiatan" data-whatever="@fat">Tambah Kegiatan</button>
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
                    <th>Aksi</th>
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
                            <td><?php echo "Rp $harga"; echo " / "; echo $data->satuan;?></td>
                            <td><?php echo "Rp $anggaran"; ?></td>
                            <td><?php echo date('d F Y', strtotime($data->updated_at)); ?></td>
                            <td>
                                <a class="thumbnail fancybox" rel="ligthbox" href="http://localhost:8000/assets/img/{{ $data->gambar }}">
                                    <img src="http://localhost:8000/assets/img/{{ $data->gambar }}"  class="img-bukti">
                                </a>                             
                            </td>
                            <td>
                                <button type="button" class="btn btn-success btn-xs mr-3" id="btnShow" data-toggle="modal" data-target="#modalShow" data-id="{{ $data->id }}" data-kegiatan="{{$data->kegiatan}}" data-unit = "{{$data->unit}}" data-harga="{{$data->harga}}" data-satuan = "{{$data->satuan}}" data-gambar = "{{$data->gambar}}"><i class="glyphicon glyphicon-eye-open"></i></button>
                                <button type="button" class="btn btn-midnight btn-xs mr-3" id="btnEdit" data-toggle="modal" data-target="#modalEdit" data-id="{{ $data->id }}" data-kegiatan="{{$data->kegiatan}}" data-unit = "{{$data->unit}}" data-harga="{{$data->harga}}" data-satuan = "{{$data->satuan}}" data-gambar = "{{$data->gambar}}"><i class="glyphicon glyphicon-pencil"></i></button>
                                <button type="button" class="btn btn-red-flat btn-xs" id="btnDel" data-title="Delete" data-id = "{{$data->id}}" data-toggle="modal" data-target="#modalDelete" ><i class="glyphicon glyphicon-trash"></i></button>
                            </td>
                        </tr>
                        <?php $no++; } ?>
                </tbody>
            </table>
        </div>
        <div class="col-lg-12 mt-3">
            <button class="btn btn-success pull-right" data-title="Selesai" data-toggle="modal" data-target="#modalSelesai">Selesai Proyek</i></button>
        </div>	
        <div class="clearfix"></div>
    </div>
</div>

<!-- /.modal-konfirmasi apakah proyek sudah selesai atau belum  --> 
<div class="modal fade" id="modalSelesai" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                <h4 class="modal-title custom_align" id="Heading">Proyek ini telah selesai ?</h4>
            </div>
            <div class="modal-body">
                <form id="UpdateDetail" action="/proyekSelesai" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        {{ csrf_field() }}
                        <div class="alert alert-danger"><span class="glyphicon glyphicon-warning-sign"></span> Apakah Anda yakin menghapus data kegiatan ini?</div>	
                        <input type="hidden" name="proyek_id" class="form-control" id="proyek_id" value="{{ $id }}">       
                        <input type="hidden" name="user_id" class="form-control" id="user_id" value="{{ Auth::user()->id }}">       
                    </div>
                    <div class="modal-footer ">
                        <button type="submit" class="btn btn-danger btn-ok"> Selesai</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- /.modal-content --> 
    </div>
    <!-- /.modal-dialog --> 
</div>

<!-- /.modal-pengolahan/penambahan data kegiatan --> 
<div class="modal fade" id="modalTambahKegiatan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                <h4 class="modal-title custom_align" id="Heading">Tambah Kegiatan</h4>
            </div>
            <form id="createDetail" action="/DataKegiatan" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="modal-body">
                <input type="hidden" name="proyek_id" class="form-control" id="proyek_id" value="{{ $id }}">
                    <div class="form-group">
                        <label for="namaKegiatan" class="form-control-label">Nama Kegiatan:</label>
                        <input type="text" name="kegiatan" class="form-control" id="kegiatan" required>
                    </div>
                    <div class="form-group">
                        <label for="unit" class="form-control-label">Jumlah unit:</label>
                        <input type="number" name="unit" class="form-control" id="unit" required>
                    </div>
                    <div class="form-group col-6 float-left">
                        <label for="hargaSatuan" class="form-control-label">Harga Satuan:Rp. </label>
                        <input name="harga" class="form-control number" id="harga" required>
                    </div>
                    <div class="form-group col-6 float-left">
                        <label for="satuan" class="form-control-label">Satuan:(Kg Pcs, dll) </label>
                        <input type="text" name="satuan" class="form-control" id="satuan" required>
                    </div>
                    <div class="form-group">
                        <label for="gambar" class="form-control-label">Gambar:</label><br>
                        <div class="input-group col-3 float-left">
                            <img id='img-upload' class="img-upload"/>
                        </div>
                        <div class="input-group col-6  float-left">
                            <span class="input-group-btn">
                                <span class="btn btn-default btn-file">
                                    Browse… <input type="file" accept="image/*" id="imgInp" name="gambar" required>
                                </span>
                            </span>
                            <input type="text" class="form-control" readonly>
                        </div>							
                    </div>
                </div>
                <br><br><br><br><br><br><br><br><br>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-midnight">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- /.modal-edit data kegiatan --> 
<div class="modal fade" id="modalShow" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                <h4 class="modal-title custom_align" id="Heading">Tampikan Data Kegiatan</h4>
            </div>
            <form id="UpdateDetail" action="" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="namaKegiatan" class="form-control-label">Nama Kegiatan:</label>
                        <input type="text" name="kegiatan" class="form-control" id="kegiatan" readonly>
                    </div>
                    <div class="form-group">
                        <label for="unit" class="form-control-label">Jumlah unit:</label>
                        <input type="number" name="unit" class="form-control" id="unit" readonly>
                    </div>
                    <div class="form-group col-6 float-left">
                        <label for="hargaSatuan" class="form-control-label">Harga Satuan:Rp. </label>
                        <input type="number" name="harga" class="form-control number" id="harga" readonly>
                    </div>
                    <div class="form-group col-6 float-left">
                        <label for="satuan" class="form-control-label">Satuan:(Kg Pcs, dll) </label>
                        <input type="text" name="satuan" class="form-control" id="satuan" readonly>
                    </div>
                    <div class="form-group">
                        <label for="gambar" class="form-control-label">Gambar:</label><br>
                        <div class="input-group col-3 float-left">
                            <img id='img-upload' class="img-upload"/>
                        </div>							
                    </div>
                </div>
                <br><br><br><br><br><br><br>	
                <div class="modal-footer">
                    <button type="button" class="btn btn-midnight" data-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- /.modal-edit data kegiatan --> 
<div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                <h4 class="modal-title custom_align" id="Heading">Edit Data Kegiatan</h4>
            </div>
            <form id="UpdateDetail" action="{{ route('DataKegiatan.update', 'edit')}}" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                {{ csrf_field() }} {{ method_field('PUT') }}
                    <div class="form-group">
                        <input type="hidden" name="id" class="form-control" id="id">
                        <label for="namaKegiatan" class="form-control-label">Nama Kegiatan:</label>
                        <input type="text" name="kegiatan" class="form-control" id="kegiatan">
                    </div>
                    <div class="form-group">
                        <label for="unit" class="form-control-label">Jumlah unit:</label>
                        <input type="number" name="unit" class="form-control" id="unit">
                    </div>
                    <div class="form-group col-6 float-left">
                        <label for="hargaSatuan" class="form-control-label">Harga Satuan:Rp. </label>
                        <input type="number" name="harga" class="form-control number" id="harga">
                    </div>
                    <div class="form-group col-6 float-left">
                        <label for="satuan" class="form-control-label">Satuan:(Kg Pcs, dll) </label>
                        <input type="text" name="satuan" class="form-control" id="satuan">
                    </div>
                    <div class="form-group">
                        <label for="gambar" class="form-control-label">Gambar:</label><br>
                        <div class="input-group col-3 float-left">
                            <img id='img-upload2' class="img-upload"/>
                        </div>
                        <div class="input-group col-6  float-left">
                            <span class="input-group-btn">
                                <span class="btn btn-default btn-file">
                                    Browse… <input type="file" accept="image/*" id="imgInp2" name="gambar">
                                </span>
                            </span>
                            <input type="text" class="form-control" readonly>
                        </div>							
                    </div>
                </div>
                <br><br><br><br><br><br><br>	
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-midnight">Save Edit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- /.modal-konfirmasi menghapus data --> 
<div class="modal fade" id="modalDelete" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                <h4 class="modal-title custom_align" id="Heading">Hapus Data Ini?</h4>
            </div>
            <div class="modal-body">
                <form id="UpdateDetail" action="{{ route('DataKegiatan.destroy', 'id_kegiatan')}}" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        {{ csrf_field() }} {{ method_field('DELETE') }}
                        <div class="alert alert-danger"><span class="glyphicon glyphicon-warning-sign"></span> Apakah Anda yakin menghapus data kegiatan ini?</div>	
                        
                        <input type="hidden" name="id" class="form-control" id="id">         
                </div>
                <div class="modal-footer ">
                    <button type="submit" class="btn btn-danger btn-ok"> Delete</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content --> 
    </div>
    <!-- /.modal-dialog --> 
</div>

@endsection