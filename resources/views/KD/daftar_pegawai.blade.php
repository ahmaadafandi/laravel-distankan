@extends('Home')
@section('content')

<div class="row">
    <div class="content-fill col-lg-12 pull-right mb-3">
        <button type="button" class="btn btn-midnight pull-right" id="openSpk" data-toggle="modal" data-target="#modalTambahData" data-whatever="@fat">Tambah Pegawai</button>
    </div>
    <div class="content-fill col-lg-12">
        <!-- table untuk menampilkan data pegawai -->
        <table id="mytable" class="table table-bordred table-striped col-lg-12" width="100%">
            <thead>
                <th>NIP</th>
                <th>Nama</th>
                <th>Jabatan</th>
                <th>Aksi</th>
            </thead>
            <tbody>							
                <?php 
            // perulangan array data pada tabel pegawai
                foreach ($user as $row) { 
                    if($row->nama=='Admin'){}else{ ?>
                    <tr>
                        <td>{{ $row->nip }}</td>
                        <td>{{ $row->nama }}</td>
                        <td>{{ $row->jabatan }}</td>
                        <?php 
                        if($row->jabatan == 'Administrator'){ ?>
						<?php }elseif($row->jabatan == 'Kepala Dinas'){
                            if(Auth::user()->jabatan == 'Administrator'){
                                ?> 
                                <td>
                                    <button type="button" class="btn btn-midnight btn-xs mr-3" id="openSpk" data-toggle="modal" data-target="#modalEdit" data-id="{{ $row->id }}" data-nip="{{ $row->nip }}" data-nama="{{ $row->nama }}" data-jabatan="{{ $row->jabatan }}"><i class="glyphicon glyphicon-pencil"></i></button>
                                    <button class="btn btn-red-flat btn-xs" data-title="Delete" data-toggle="modal" data-target="#modalDelete" data-id="{{ $row->id }}" data-nama="{{ $row->nama }}"><i class="glyphicon glyphicon-trash"></i></button>
                                </td>
                                <?php
                            }else{ ?>
                                <td>
                                    <button type="button" class="btn btn-midnight btn-xs mr-3" id="openSpk" data-toggle="modal" data-target="#modalEdit" data-id="{{ $row->id }}" data-nip="{{ $row->nip }}" data-nama="{{ $row->nama }}" data-jabatan="{{ $row->jabatan }}"><i class="glyphicon glyphicon-pencil"></i></button>
                                </td>
                            <?php } 
                        }else{ ?>
                        <td>
                            <button type="button" class="btn btn-midnight btn-xs mr-3" id="openSpk" data-toggle="modal" data-target="#modalEdit" data-id="{{ $row->id }}" data-nip="{{ $row->nip }}" data-nama="{{ $row->nama }}" data-jabatan="{{ $row->jabatan }}"><i class="glyphicon glyphicon-pencil"></i></button>
                            <button class="btn btn-red-flat btn-xs" data-title="Delete" data-toggle="modal" data-target="#modalDelete" data-id="{{ $row->id }}" data-nama="{{ $row->nama }}"><i class="glyphicon glyphicon-trash"></i></button>
                        </td>
                        <?php }
                    } 
                } ?>
            </tr>
        </tbody>
    </table>
    </div>
</div>
<div class="clearfix"></div>

<!-- /.modal-pengolaan data pegawai --> 
<div class="modal fade" id="modalTambahData" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
				<h4 class="modal-title custom_align" id="Heading">Tambah data pegawai</h4>
			</div>
			<form id="createDetail" action="{{ route('User.store') }}" method="POST" enctype="multipart/form-data">
				<div class="modal-body">
					{{ csrf_field() }}
					<div class="form-group">
						<label for="nip" class="form-control-label">NIP (Nomor Induk Pegawai):</label>
						<input type="number" name="nip" class="form-control" id="nip" required>
					</div>
					<div class="form-group">
						<label for="namapegawai" class="form-control-label">Nama Pegawai:</label>
						<input type="text" name="nama" class="form-control" id="namapegawai" required>
					</div>
					<div class="form-group">
						<label for="namapegawai" class="form-control-label">Jabatan:</label>
						<div class="form-group mr-3 pl-0">
							<div class="icon-addon addon-md">
								<select class="form-control pl-0" data-live-search="true" name="jabatan" required>
									<option value=''>-Pilih-</option>
									<option value= "Pegawai">Pegawai</option>
									<option value= "Kepala Sub Bagian Program">Kepala Sub Bagian Program</option>
									<option value= "Kepala Dinas">Kepala Dinas</option>
								</select>
							</div>
						</div>
					</div>					
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Batalkan</button>
						<button type="submit" class="btn btn-midnight">Simpan</button>
					</div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- /.modal-edit data pegawai --> 
<div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
				<h4 class="modal-title custom_align" id="Heading">Edit data pegawai</h4>
			</div>
			<form id="createDetail" action="{{ route('User.update', 'id') }}" method="POST">				
				<div class="modal-body">
					{{ csrf_field() }} {{ method_field('PUT') }}
					<input type="hidden" name="id" id="id">
					<div class="form-group">
						<label for="nip" class="form-control-label">NIP (Nomor Induk Pegawai):</label>
						<input type="number" name="nip" class="form-control" id="nip" readonly>
					</div>
					<div class="form-group">
						<label for="namapegawai" class="form-control-label">Nama Pegawai:</label>
						<input type="text" name="nama" class="form-control" id="nama" required>
					</div>
					<div class="form-group">
						<label for="namapegawai" class="form-control-label">Jabatan:</label>
						<div class="form-group mr-3 pl-0">
							<div class="icon-addon addon-md">
								<select class="form-control pl-0" data-live-search="true" name="jabatan" id="jabatan" required>
									<option value=''>-Pilih-</option>
									<option value= "Pegawai">Pegawai</option>
									<option value= "Kepala Sub Bagian Program">Kepala Sub Bagian Program</option>
									<option value= "Kepala Dinas">Kepala Dinas</option>
								</select>
							</div>
						</div>
					</div>					
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Batalkan</button>
						<button type="submit" class="btn btn-midnight">Simpan Edit</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- /.modal-menghapus data --> 
<div class="modal fade" id="modalDelete" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
				<h4 class="modal-title custom_align" id="Heading">Hapus Pegawai Ini?</h4>
			</div>
			<div class="modal-body">
				<form action="{{ route('User.destroy', 'id') }}" method="POST" enctype="multipart/form-data">
					{{ csrf_field() }} {{ method_field('DELETE') }}
					<div class="alert alert-danger"><span class="glyphicon glyphicon-warning-sign"></span> Apakah Anda yakin menghapus pegawai ini?</div>
						<input type="hidden" name="id" id="id">
						<input type="hidden" name="user_id" id="user_id" value = "{{ auth::user()->id }}">
						<input type="hidden" name="nama" id="nama">
						<div class="row">
							<div class="col-lg-6">
								<p>Alasan Menghapus Data Pegawai</p>
							</div>		
						</div>

						<div class="row">
							<div class="col-lg-12">
								<textarea type="text" class="form-control" name="alasan" required></textarea>
							</div>
						</div>  
					<div class="modal-footer ">
						<button type="submit" class="btn btn-danger btn-ok" ><span class="glyphicon glyphicon-ok-sign"></span> Ya</button>
						<button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Tidak</button>
					</div>
				</form>
			</div>
		</div>
		<!-- /.modal-content --> 
	</div>
	<!-- /.modal-dialog --> 
</div>

<script>
	//Hapus Data
	$(document).ready(function () {
		$('#modalDelete').on('show.bs.modal', function (e) {
			var id = $(e.relatedTarget).data('id')
			var nama = $(e.relatedTarget).data('nama')
			var modal = $(this)

			modal.find('.modal-body #id').val(id);
			modal.find('.modal-body #nama').val(nama);
		});

		$('#modalEdit').on('show.bs.modal', function (e) {
			var id = $(e.relatedTarget).data('id')
			var nip = $(e.relatedTarget).data('nip')
			var nama = $(e.relatedTarget).data('nama')
			var jabatan = $(e.relatedTarget).data('jabatan')
			var modal = $(this)

			modal.find('.modal-body #id').val(id);
			modal.find('.modal-body #nip').val(nip);
			modal.find('.modal-body #nama').val(nama);
			modal.find('.modal-body #jabatan').val(jabatan);
		});
	});
</script>

@endsection