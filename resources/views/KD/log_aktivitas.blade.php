@extends('Home')
@section('content')

<div class="row">  
    <div class="content-fill col-lg-12"> 
        <table id="mytable" class="table table-bordred table-striped col-lg-12" width="100%">
            <thead>
                <th>Tanggal</th>
                <th>User</th>
                <th>Aksi</th>
                <th>Keterangan</th>
                <th>Alasan</th>
            </thead>
            <tbody>
                @foreach($log_aktivitas as $row)							
                <tr>
                    <td>{{ date('d F Y', strtotime($row->created_at)) }}</td>
                    <td>{{ $row->user->nama }}</td>
                    <td>{{ $row->aksi }}</td>
                    <td>{{ $row->ket }}</td>
                    <td>{{ $row->alasan }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="clearfix"></div>
    </div>  
</div>

@endsection