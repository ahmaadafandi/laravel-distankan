@extends('Home')
@section('content')

<div class="row">    
    <div class="content-fill col-lg-12 pull-right mb-3">
        <button type="button" class="btn btn-midnight pull-right" id="openSpk" data-toggle="modal" data-target="#modalTambahData" data-whatever="@fat">Tambah User</button>
    </div>	
    <div class="content-fill col-lg-12">
        <!-- Table menampilkan data user --> 
        <table id="mytable" class="table table-bordred table-striped col-lg-12" width="100%">
            <thead>
                <th>NIP</th>
                <th>Nama</th>
                <th>Hak Akses</th>
                <th>Status</th>
                <th>Login Terakhir</th>
                <th>Aksi</th>
            </thead>
            <tbody>							
            <?php 
                // perulangan array berdasarkan query di atas yaitu pada tabel pegawai
                foreach ($user as $row) { ?>
                    <tr>
                        <td>{{ $row->nip }}</td>
                        <td>{{ $row->nama }}</td>
                        <td>{{ $row->jabatan }}</td>
                        <td>{{ $row->status}}</td>
                        <td>{{ $row->waktu_login}}</td>
                        <?php
                        if (($row->jabatan == 'Administrator')) {
                                ?> <td></td> <?php 
                        }else{
                        ?>
                        <td>
                            <button type="button" class="btn btn-midnight btn-xs mr-3" id="openSpk" data-toggle="modal" data-target="#modalEditUser" data-nip="{{ $row->nip }}" data-nama="{{ $row->nama }}" data-jabatan="{{ $row->jabatan }}" data-status="{{ $row->status }}" data-password="{{ $row->password }}"><i class="glyphicon glyphicon-pencil"></i></button>
                        </td>
                        <?php }
                    } ?>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<!-- /.modal-pengelolaan data user --> 
<div class="modal fade" id="modalTambahData" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Kelola User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="createDetail" action="{{ route('User.edit', 'id', 'edit') }}" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }} {{ method_field('GET') }}
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama" class="form-control-label">NIP:</label>
                        <div class="form-group mr-3 pl-0">
                            <div class="icon-addon addon-md">
                                <select class="form-control selectpicker pl-0" data-live-search="true" name="nip" onchange="cek_database()" id="nipPilihan">
                                <option value=''>-Pilih-</option>
                                    <?php // perulangan array berdasarkan query di atas yaitu pada tabel pegawai
                                    foreach ($pilihUser as $data) { ?>
                                        <option data-tokens="{{ $data->nip }}" value= "{{ $data->nip }}">{{ $data->nip }}</option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="nama" class="form-control-label">Nama:</label>
                        <input type="text" name="nama" class="form-control" id="nama" readonly="readonly">
                    </div>
                    
                    <div class="form-group">
                        <label for="jabatanUser" class="form-control-label">Jabatan:</label>
                        <input type="text" id="jabatan" name="jabatan" class="form-control" readonly="readonly">
                    </div>	
                    <div class="form-group">
                        <label for="password" class="form-control-label">Password:</label>
                        <div class="row">
                            
                            <input type="password" name="password" class="form-control col-10 pwd" id="password" style="margin-left: 15px;">   
                            <span class="input-group-btn">
                                <button class="btn btn-default reveal" type="button"><i class="glyphicon glyphicon-eye-open"></i></button>
                            </span> 
                                
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

<!-- /.modal-edit data user --> 
<div class="modal fade" id="modalEditUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="createDetail" action="{{ route('User.editStatus') }}" method="POST">
                {{ csrf_field() }}
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nip" class="form-control-label">Nip:</label>
                        <input type="text" name="nip" class="form-control" id="nip" readonly="readonly">
                    </div>

                    <div class="form-group">
                        <label for="nama" class="form-control-label">Nama:</label>
                        <input type="text" name="nama" class="form-control" id="nama" readonly="readonly">
                    </div>
                    
                    <div class="form-group">
                        <label for="jabatanUser" class="form-control-label">Jabatan:</label>
                        <input type="text" id="jabatan" name="jabatan" class="form-control" readonly="readonly">
                    </div>	
                    <div class="form-group">
                        <label for="password" class="form-control-label">Ubah Password:</label>
                        <div class="row">
                            
                            <input type="password" name="password" class="form-control col-10 pwd" id="password" style="margin-left: 15px;">   
                            <span class="input-group-btn">
                                <button class="btn btn-default reveal" type="button"><i class="glyphicon glyphicon-eye-open"></i></button>
                            </span> 
                                
                        </div>    
                    </div>

                    <div class="form-group">
                        <label for="status" class="form-control-label">Status</label>
                        <select class="form-control pl-0" data-live-search="true" name="status" id="status" required>
                            <option value="">-pilih-</option>  
                            <option value="aktif">Aktif</option>  
                            <option value="tidak aktif">Tidak Aktif</option>  
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batalkan</button>
                    <button type="submit" class="btn btn-midnight">Simpan Edit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- /.js pengecekan data berdasarkan pemilihan nip pada penambahan user --> 
<script type="text/javascript">
function cek_database(){
    var nipPilihan = $("#nipPilihan").val();
        
    // menggunakan fungsi ajax untuk pengambilan data
    $.ajax({
        url: '/getDataUser/' + nipPilihan,
        method: 'get',
        success: function (data) {
            $('.modal-body #nama').val(data.nama);
            $('.modal-body #jabatan').val(data.jabatan);
        }
    });
}
    
$(document).ready(function() {

    $('#modalEditUser').on('show.bs.modal', function (e) {
        var nip = $(e.relatedTarget).data('nip')
        var nama = $(e.relatedTarget).data('nama')
        var jabatan = $(e.relatedTarget).data('jabatan')
        var status = $(e.relatedTarget).data('status')
        var modal = $(this)


        modal.find('.modal-body #nip').val(nip);
        modal.find('.modal-body #nama').val(nama);
        modal.find('.modal-body #jabatan').val(jabatan);
        modal.find('.modal-body #status').val(status);
    })
})
</script>

@endsection