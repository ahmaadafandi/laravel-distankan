@extends('Home')
@section('content')

<?php foreach($endRow as $end) {$endId = $end->id;} ?>
<form method="POST" action="{{ route('Proyek.store')}}">
{{ csrf_field() }} {{ method_field('POST') }}
<input type="hidden" name="user_id" class="form-control" id="user_id" value="{{Auth::user()->id}}">
    <div class="content-fill col-lg-12">
        <div class="row">
            <div class="col-lg-2">
                <p>Nomor Proyek</p>
            </div>		
            <div class="col-lg-2">
                <div class="form-group mr-3 pl-0">
                    <input type="text" class="form-control" name="nomor_proyek" value="NP0{{ $endId }}" readonly/>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-2">
                <p>Nama Proyek</p>
            </div>		
            <div class="col-lg-5">
                <div class="form-group mr-3 pl-0">
                    <input type="text" class="form-control" name="nama_proyek" required/>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-2">
                <p>Anggaran</p>
            </div>		
            <div class="col-lg-3">
                <div class="form-group mr-3">
                    <input class="form-control number" id="anggaranProyek" name="anggaran" required/>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-2">
                <p>Tanggal Mulai</p>
            </div>		
            <div class="col-lg-2">
                <div class="form-group mr-3 pl-0">
                    <div class="icon-addon addon-md">
                        <input class="form-control" type="text" name="mulai_proyek" required>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-2">
                <p>Tanggal Selesai</p>
            </div>		
            <div class="col-lg-2">
                <div class="form-group mr-3 pl-0">
                    <div class="icon-addon addon-md">
                        <input class="form-control" type="text" name="selesai_proyek" required>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-7">
                <input type="submit" class="btn btn-midnight float-right" value="Tambah Proyek">
            </div>	
        </div>
        <br>
    </div>
</form>
@endsection
