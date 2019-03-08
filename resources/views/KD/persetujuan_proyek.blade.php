@extends('Home')
@section('content')

<div class="row">
    <div class="content-fill col-lg-12">   
        <table id="mytable" class="table table-bordred table-striped col-lg-12" width="100%">
            <thead>          
                <th>Nama Proyek</th>
                <th>Anggaran</th>
                <th>Perkiraan Mulai</th>
                <th>Perkiraan Selesai</th>
                <th>Status</th>
                <th>Aksi</th>
            </thead>
            <tbody>							
                <?php 
                // perulangan array untuk membaca seluruh data berdasarkan query di atas yaitu pada tabel daftar proyekk berdasarkan status proyek
                foreach ($daftar_proyeks as $row) { 
                    if ($row->status == "Menunggu Persetujuan") { 
                        $anggaranProyek=number_format($row->anggaran,2,',','.');  ?>	
                        <tr>
                            <td>{{ $row->nama_proyek }}</td>
                            <td><?php echo "Rp $anggaranProyek"; ?></td>
                            <td><?php echo date('d F Y', strtotime($row->mulai_proyek)); ?></td>
                            <td><?php echo date('d F Y', strtotime($row->selesai_proyek));?></td>
                            <td><?php echo $row->status; ?></td>
                            <td>
                                <a class="btn btn-midnight btn-xs" data-title="Setujui" data-toggle="modal" data-target="#setujui" data-id="{{$row->id}}"><i class="glyphicon glyphicon-ok"></i></a>

                                <a class="btn btn-red-flat btn-xs" data-title="Tolak" data-toggle="modal" data-target="#ditolak" data-id="{{$row->id}}"><i class="glyphicon glyphicon-remove"></i></a>
                            </td>                   	
                    <?php } 
                } ?>
                </tr>
            </tbody>
        </table>
        <div class="clearfix"></div>
    </div>
</div>

<!-- /.modal-konfirmasi persetujuan proyek --> 
<div class="modal fade" id="setujui" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                <h4 class="modal-title custom_align" id="Heading">Setujui proyek ini?</h4>
            </div>
            <div class="modal-body">
                <form id="UpdateDetail" action="/setujuiProyek" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        {{ csrf_field() }}
                        <div class="alert alert-info"><span class="glyphicon glyphicon-info-sign"></span> Apakah anda yakin menyetujui proyek ini?</div>
                        <input type="hidden" name="id" class="form-control" id="id">         
                    </div>
                    <div class="modal-footer ">
                        <button type="submit" class="btn btn-success btn-ok" ><span class="glyphicon glyphicon-ok-sign"></span> Ya</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Tidak</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content --> 
        </div>
        <!-- /.modal-dialog --> 
    </div>	
</div>	

<!-- /.modal-konfirmasi penolakan proyek --> 
<div class="modal fade" id="ditolak" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                <h4 class="modal-title custom_align" id="Heading">Setujui proyek ini?</h4>
            </div>
            <div class="modal-body">
                <form id="UpdateDetail" action="/ditolak" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        {{ csrf_field() }}
                        <div class="alert alert-danger"><span class="glyphicon glyphicon-warning-sign"></span> Apakah anda yakin menyetujui proyek ini?</div>
                        <input type="hidden" name="id" class="form-control" id="id">         
                    </div>
                    <div class="modal-footer ">
                        <button type="submit" class="btn btn-success btn-danger" ><span class="glyphicon glyphicon-ok-sign"></span> Ya</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Tidak</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content --> 
        </div>
        <!-- /.modal-dialog --> 
    </div>	
</div>	

<script>
$(document).ready(function () {
    // Proyek di setujui
    $('#setujui').on('show.bs.modal', function (e) {
        var id = $(e.relatedTarget).data('id')
        var modal = $(this)

        modal.find('.modal-body #id').val(id);
    });

    // proyek tidak di setujui
    $('#ditolak').on('show.bs.modal', function (e) {
        var id = $(e.relatedTarget).data('id')
        var modal = $(this)

        modal.find('.modal-body #id').val(id);
    });
});
</script>

@endsection