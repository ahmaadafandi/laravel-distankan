<!DOCTYPE html>
<html>
  <head>
    @include ('layout.head')  
  </head>
  <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        <!-- Sidebar Holder -->
        <nav id="sidebar" class="bg-midnightblue">
            <div class="sidebar-header text-center">
                <h3>DISTANKAN</h3>
                <strong><img class="img-responsive" src="http://localhost:8000/assets/img/logo.png"></strong>
            </div>
            <ul class="list-unstyled admin-login">
                <li class="admin-avatar mt-5 text-center">
                    @if(Auth::user()->foto == '-')
                        <img class="img-circle" src="http://localhost:8000/assets/img/Profile_Icon.jpg" id="openSpk" data-toggle="modal" data-target="#modalfoto">
                    @else
                        <img class="img-circle" src="http://localhost:8000/assets/img/{{ auth::user()->foto }}" id="openSpk" data-toggle="modal" data-target="#modalfoto">
                    @endif
                    <i class="fa fa-edit edit-photo"></i><br>
                    <span><h5>{{Auth::user()->nama}}<br> {{Auth::user()->jabatan}}</h5></span>
                </li>
            </ul>

            @if(Auth::user()->jabatan == 'Pegawai')
                @include ('layout.menuPegawai')   
            @elseif(Auth::user()->jabatan == 'Kepala Sub Bagian Program')
                @include ('layout.menuKSBP')    
            @else
                @include ('layout.menuKD')    
            @endif

        </nav>

        <!-- Page Content Holder -->
        <div id="content">
            <nav class="navbar navbar-default">
                <div class="container-fluid">

                    <div class="navbar-header">
                        <button type="button" id="sidebarCollapse" class="btn btn-default navbar-btn">
                            <i class="glyphicon glyphicon-align-left"></i>
                        </button>
                    </div>

                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav navbar-right">
                            <li><a href="/logout"><i class="fa fa-sign-out"></i> Logout</a></li>
                        </ul>
                    </div>
                </div>
            </nav>

            <!-- Menampilkan konfirmasi validasi error ketika inputan tidak sesuai -->
            @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <!-- menampilkan konfirmasi proses yang di lakukan -->
            @if(\Session::has('alert'))
                <div class="alert alert-danger">
                    <div>{{Session::get('alert')}}</div>
                </div>
            @endif
            @if(\Session::has('alert-success'))
                <div class="alert alert-success">
                    <div>{{Session::get('alert-success')}}</div>
                </div>
            @endif
          @yield('content') 
      </div>
    </div>
    @include ('layout.modalFoto')
     
    @include ('layout.script')
    <!-- scrupt tambahan  -->
    @if(Auth::user()->jabatan == 'Pegawai')
        <script type="text/javascript" src="{{ URL::asset('assets/js/js_pegawai.js') }}"></script>
    @endif
  </body>
</html>