@extends('Home')
@section('content')

<div class="content-fill col-lg-12">
    <br><br>
    <div class="row">
        <table id="mytable" class="table table-bordred table-striped col-lg-12" style="width: 100% !important">
            <thead>  
                <tr>
                    <th style="width: 500px;">Nama</th>
                    <th style="width: 150px;">Anggaran</th>
                    <th style="width: 120px;">Tanggal</th>
                    <th style="width: 120px;">Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($daftarproyeks as $row)							
                <?php $anggaran=number_format($row['anggaran'],2,',','.') ?>	
                <tr>
                    <td>{{ $row->nama_proyek }}</td>
                    <td>{{ $anggaran }}</td>
                    <td>{{ date('d F Y', strtotime($row->mulai_proyek)) }}</td>
                    <td>{{ $row->status }}</td>
                    <td>
                        <?php if($row->status == 'Menunggu Persetujuan'){}
                            elseif($row->status == 'Sedang Berjalan'){ ?>
                            <a href="{{ url('detail_proyek_berjalan',$row->id) }}" class="btn btn-success btn-xs mr-3"><i class="glyphicon glyphicon-eye-open"></i></a>
                        <?php }else{ ?>
                            <button type="button" class="btn btn-red-flat btn-xs" data-title="Delete" data-id = "{{ $row->id }}" data-nama_proyek = "{{ $row->nama_proyek }}"  data-toggle="modal" data-target="#modalDelete" ><i class="glyphicon glyphicon-trash"></i></button>
                        <?php } ?>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
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
                <form id="UpdateDetail" action="{{ route('Proyek.destroy', 'id_proyek')}}" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        {{ csrf_field() }} {{ method_field('DELETE') }}
                        <div class="alert alert-danger"><span class="glyphicon glyphicon-warning-sign"></span> Apakah Anda yakin menghapus data kegiatan ini?</div>	
                        
                        <input type="hidden" name="id" class="form-control" id="id">
                        <input type="hidden" name="user_id" class="form-control" id="user_id" value="{{ Auth::user()->id }}">
                        <input type="hidden" name="nama_proyek" class="form-control" id="nama_proyek">
                        <div class="row">
							<div class="col-lg-6">
								<p>Alasan Menghapus Proyek</p>
							</div>		
						</div>

						<div class="row">
							<div class="col-lg-12">
								<textarea type="text" class="form-control" name="alasan" required></textarea>
							</div>
						</div>         
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
</div>

@endsection